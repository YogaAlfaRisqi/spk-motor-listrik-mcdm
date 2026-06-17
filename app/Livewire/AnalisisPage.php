<?php

namespace App\Livewire;

use App\Models\MotorListrik;
use App\Services\CriteriaService;
use App\Services\spk\WeightService;
use App\Services\spk\CalculationService;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;

#[Layout('livewire.layouts.motor')]
class AnalisisPage extends Component
{
    // ─── State ───────────────────────────────────────────────────────────────
    public array  $selectedIds = [];
    public string $activeTab   = 'ew';

    // ─── Constants ───────────────────────────────────────────────────────────
    protected array $columns = [
        'harga',
        'jarak_tempuh',
        'waktu_pengisian',
        'kapasitas_baterai',
        'daya_maksimum',
    ];

    protected array $menuTabs = [
        'ew' => [
            'title'   => 'Metode Equal Weight (EW)',
            'desc'    => 'Metode Equal Weight memberikan bobot yang sama untuk setiap kriteria.',
            'color'   => 'blue',
            'formula' => 'w_j = 1/n',
        ],
        'rs' => [
            'title'   => 'Metode Rank Sum (RS)',
            'desc'    => 'Metode Rank Sum memberikan bobot berdasarkan ranking kriteria.',
            'color'   => 'green',
            'formula' => 'w_j = (n - r_j + 1) / Σ(n - r_k + 1)',
        ],
        'rr' => [
            'title'   => 'Metode Rank Reciprocal (RR)',
            'desc'    => 'Metode Rank Reciprocal memberikan bobot berbanding terbalik.',
            'color'   => 'purple',
            'formula' => 'w_j = (1/r_j) / Σ(1/r_k)',
        ],
        'roc' => [
            'title'   => 'Metode ROC',
            'desc'    => 'Metode ROC menggunakan pendekatan centroid.',
            'color'   => 'orange',
            'formula' => 'w_j = (1/n) × Σ(1/k)',
        ],
        'compare' => [
            'title'   => 'Result Comparation',
            'desc'    => 'Perbandingan peringkat antar metode pembobotan.',
            'color'   => 'orange',
            'formula' => '-',
        ],
    ];

    // ─── Lifecycle ───────────────────────────────────────────────────────────
    public function mount(): void
    {
        // 1) ambil dari query string  ?ids=1,2,3  atau  ?ids[]=1&ids[]=2
        $ids = request()->query('ids', []);
        if (is_string($ids) && $ids !== '') {
            $ids = explode(',', $ids);
        }
        $fromQuery = array_values(
            array_filter(array_map('intval', (array) $ids))
        );
        // 2) Fallback ke session yang di-set oleh MotorPage
        if (empty($fromQuery)) {
            $fromQuery = session('analisis_selected_ids', []);
        }
        $this->selectedIds = $fromQuery;
    }

    #[On('motor-selected')]
    public function handleMotorSelected(array $ids): void
    {
        $this->selectedIds = array_values(
            array_filter(array_map('intval', $ids))
        );

        // Simpan ke session sebagai backup lintas navigasi
        session(['analisis_selected_ids' => $this->selectedIds]);
    }

    public function setActiveTab(string $tab): void
    {
        if (array_key_exists($tab, $this->menuTabs)) {
            $this->activeTab = $tab;
        }
    }

    public function removeMotor(int $idMotor): void
    {
        $this->selectedIds = array_values(
            array_filter($this->selectedIds, fn($id) => $id !== $idMotor)
        );

        // Sync session
        session(['analisis_selected_ids' => $this->selectedIds]);

        // Reset computed cache Livewire
        unset($this->motors, $this->analysis);
    }

    #[Computed]
    public function motors()
    {
        if (empty($this->selectedIds)) {
            return collect();
        }

        return MotorListrik::whereIn('id_motor', $this->selectedIds)
            ->get()
            ->sortBy(fn($m) => array_search($m->id_motor, $this->selectedIds))
            ->values();
    }

    #[Computed]
    public function criterias()
    {
        return app(CriteriaService::class)->getCollection();
    }

    #[Computed]
    public function columns(): array
    {
        return $this->columns;
    }

    #[Computed]
    public function menuTabs(): array
    {
        return $this->menuTabs;
    }

    #[Computed]
    public function analysis(): ?array
    {
        if ($this->motors->count() < 2) {
            return null;
        }

        $criterias = $this->criterias;

        // 1. Hitung bobot semua metode (EW, RS, RR, ROC)
        $weights = app(WeightService::class)->getAllMethods($criterias);

        // 2. Jalankan TOPSIS dengan bobot di atas
        //    CalculationService::calculate() mengembalikan:
        //    [
        //      'methods'    => [ 'ew' => [...], 'rs' => [...], ... ],
        //      'comparison' => [ [...], ... ],
        //    ]
        return app(CalculationService::class)->calculate(
            $this->motors,   // koleksi motor yang dipilih (bukan semua)
            $this->columns,
            $criterias,
            $weights
        );
    }

    /**
     * Alias agar blade bisa akses $weights terpisah (untuk tabel bobot).
     */
    #[Computed]
    public function weights(): ?array
    {
        if (! $this->analysis) {
            return null;
        }

        // Ekstrak bobot dari masing-masing metode hasil kalkulasi
        // Struktur: methods.ew.weights, methods.rs.weights, dst.
        $result = [];
        foreach (['ew', 'rs', 'rr', 'roc'] as $key) {
            $result[$key] = $this->analysis['methods'][$key]['weights'] ?? [];
        }

        return $result;
    }

    // ─── Render ──────────────────────────────────────────────────────────────

    public function render()
    {
        return view('livewire.pages.analisis.hasil-analisis');
    }
}
