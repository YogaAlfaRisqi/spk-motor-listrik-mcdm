<?php

namespace App\Livewire;

use App\Models\MotorListrik;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;

#[Layout('livewire.layouts.motor')]
class AnalisisPage extends Component
{
    public array $selectedIds = [];

    public array $weights = [
        'harga'              => 0.30,
        'jarak_tempuh'       => 0.25,
        'waktu_pengisian'    => 0.15,
        'kapasitas_baterai'  => 0.15,
        'daya_maksimum'      => 0.15,
    ];

    public array $criteriaType = [
        'harga'              => 'cost',
        'jarak_tempuh'       => 'benefit',
        'waktu_pengisian'    => 'cost',
        'kapasitas_baterai'  => 'benefit',
        'daya_maksimum'      => 'benefit',
    ];

    public array $criteriaLabel = [
        'harga'              => 'Harga',
        'jarak_tempuh'       => 'Jarak Tempuh',
        'waktu_pengisian'    => 'Waktu Pengisian',
        'kapasitas_baterai'  => 'Kapasitas Baterai',
        'daya_maksimum'      => 'Daya Maksimum',
    ];

    public array $criteriaUnit = [
        'harga'              => 'Rp',
        'jarak_tempuh'       => 'km',
        'waktu_pengisian'    => 'jam',
        'kapasitas_baterai'  => 'Ah',
        'daya_maksimum'      => 'W',
    ];

    public function mount()
    {
        // Menerima format: /motor/compare?ids[]=1&ids[]=2&ids[]=3
        $ids = request()->query('ids', []);

        // Fallback jika dikirim sebagai string "1,2,3"
        if (is_string($ids)) {
            $ids = explode(',', $ids);
        }

        $this->selectedIds = array_values(array_filter(array_map('intval', (array) $ids)));
    }

    #[Computed]
    public function motors()
    {
        if (empty($this->selectedIds)) {
            return collect();
        }

        return MotorListrik::whereIn('id_motor', $this->selectedIds)
            ->get()
            ->sortBy(fn($motor) => array_search($motor->id_motor, $this->selectedIds))
            ->values();
    }

    #[Computed]
    public function topsisResult()
    {
        $motors = $this->motors;

        if ($motors->isEmpty()) {
            return null;
        }

        $criteria = array_keys($this->weights);

        // 1. Matrix keputusan
        $matrix = [];
        foreach ($motors as $motor) {
            $row = [];
            foreach ($criteria as $c) {
                $row[$c] = (float) $motor->{$c};
            }
            $matrix[$motor->id_motor] = $row;
        }

        // 2. Normalisasi (vector normalization)
        $sumSquares = [];
        foreach ($criteria as $c) {
            $sumSquares[$c] = sqrt(array_sum(array_map(
                fn($row) => $row[$c] ** 2,
                $matrix
            )));
        }

        $normalized = [];
        foreach ($matrix as $id => $row) {
            foreach ($criteria as $c) {
                $normalized[$id][$c] = $sumSquares[$c] > 0
                    ? $row[$c] / $sumSquares[$c]
                    : 0;
            }
        }

        // 3. Matrix terbobot
        $weighted = [];
        foreach ($normalized as $id => $row) {
            foreach ($criteria as $c) {
                $weighted[$id][$c] = $row[$c] * $this->weights[$c];
            }
        }

        // 4. Solusi ideal positif & negatif
        $idealPositive = [];
        $idealNegative = [];
        foreach ($criteria as $c) {
            $values = array_map(fn($row) => $row[$c], $weighted);

            if ($this->criteriaType[$c] === 'benefit') {
                $idealPositive[$c] = max($values);
                $idealNegative[$c] = min($values);
            } else {
                $idealPositive[$c] = min($values);
                $idealNegative[$c] = max($values);
            }
        }

        // 5. Jarak & skor preferensi
        $results = [];
        foreach ($weighted as $id => $row) {
            $dPositive = 0;
            $dNegative = 0;

            foreach ($criteria as $c) {
                $dPositive += ($row[$c] - $idealPositive[$c]) ** 2;
                $dNegative += ($row[$c] - $idealNegative[$c]) ** 2;
            }

            $dPositive = sqrt($dPositive);
            $dNegative = sqrt($dNegative);

            $score = ($dPositive + $dNegative) > 0
                ? $dNegative / ($dPositive + $dNegative)
                : 0;

            $results[$id] = [
                'd_positive' => $dPositive,
                'd_negative' => $dNegative,
                'score'      => $score,
                'normalized' => $normalized[$id],
                'weighted'   => $weighted[$id],
                'raw'        => $matrix[$id],
            ];
        }

        // 6. Ranking (descending)
        $ranked = collect($results)
            ->sortByDesc('score')
            ->keys()
            ->values()
            ->toArray();

        return [
            'criteria'       => $criteria,
            'results'        => $results,
            'ranked_ids'     => $ranked,
            'ideal_positive' => $idealPositive,
            'ideal_negative' => $idealNegative,
        ];
    }

    public function getAlasan(int $idMotor): array
    {
        $topsis = $this->topsisResult;
        if (!$topsis) return [];

        $motorResult = $topsis['results'][$idMotor];
        $allResults = $topsis['results'];

        $alasan = ['unggul' => [], 'lemah' => []];

        foreach ($topsis['criteria'] as $c) {
            $allValues = array_map(fn($r) => $r['raw'][$c], $allResults);
            $avg = array_sum($allValues) / count($allValues);
            $value = $motorResult['raw'][$c];

            $isBetter = $this->criteriaType[$c] === 'benefit'
                ? $value > $avg
                : $value < $avg;

            $isWorse = $this->criteriaType[$c] === 'benefit'
                ? $value < $avg
                : $value > $avg;

            if ($isBetter) {
                $alasan['unggul'][] = [
                    'label' => $this->criteriaLabel[$c],
                    'value' => $value,
                    'unit'  => $this->criteriaUnit[$c],
                ];
            } elseif ($isWorse) {
                $alasan['lemah'][] = [
                    'label' => $this->criteriaLabel[$c],
                    'value' => $value,
                    'unit'  => $this->criteriaUnit[$c],
                ];
            }
        }

        return $alasan;
    }

    public function removeMotor(int $idMotor)
    {
        $this->selectedIds = array_values(array_filter(
            $this->selectedIds,
            fn($id) => $id !== $idMotor
        ));
    }


    public function render()
    {
        return view('livewire.pages.analisis.hasil-analisis');
    }
}
