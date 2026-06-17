<?php
namespace App\Http\Controllers\Web\Admin;
use App\Http\Controllers\Controller;
use App\Services\AlternativeService;
use App\Services\CriteriaService;
use App\Services\spk\CalculationService;
use App\Services\spk\WeightService;
use Illuminate\Http\Request;

class RecomendationResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(
        protected CriteriaService $criteriaService,
        protected AlternativeService $alternativeService,
        protected WeightService      $weightService,
        protected CalculationService $calculationService,
    ) {}
    public function index()
    {
        $columns = [
            'harga',
            'jarak_tempuh',
            'waktu_pengisian',
            'kapasitas_baterai',
            'daya_maksimum'
        ];

        $menuTabs = [
            'ew' => [
                'title' => 'Metode Equal Weight (EW)',
                'desc' => 'Metode Equal Weight memberikan bobot yang sama untuk setiap kriteria.',
                'color' => 'blue',
                'formula' => 'w_j = 1/n',
            ],
            'rs' => [
                'title' => 'Metode Rank Sum (RS)',
                'desc' => 'Metode Rank Sum memberikan bobot berdasarkan ranking kriteria.',
                'color' => 'green',
                'formula' => 'w_j = (n - r_j + 1) / Σ(n - r_k + 1)',
            ],
            'rr' => [
                'title' => 'Metode Rank Reciprocal (RR)',
                'desc' => 'Metode Rank Reciprocal memberikan bobot berbanding terbalik.',
                'color' => 'purple',
                'formula' => 'w_j = (1/r_j) / Σ(1/r_k)',
            ],
            'roc' => [
                'title' => 'Metode ROC',
                'desc' => 'Metode ROC menggunakan pendekatan centroid.',
                'color' => 'orange',
                'formula' => 'w_j = (1/n) × Σ(1/k)',
            ],
            'compare' => [
                'title' => 'Result Comparation',
                'desc' => 'Perbandingan hasil perangkingan dari 4 metode.',
                'color' => 'orange',
                'formula' => '-',
            ],

        ];
        // data
        $criterias = $this->criteriaService->getCollection();
        $alternatives = $this->alternativeService->getCollection();
        // bobot
        $weights   = $this->weightService->getAllMethods($criterias);
        $result = $this->calculationService->calculate(
            $alternatives,
            $columns,
            $criterias,
            $weights // 🔥 kirim bobot ke service
        );
        // per metode
        return view('pages.recomendation-result.recomendation-result-page', [
            'title' => 'Hasil Rekomendasi',
            'alternatives' => $alternatives,
            'criterias' => $criterias,
            'columns' => $columns,
            'menuTabs' => $menuTabs,
            'weights' => $weights,
            'methods' => $result['methods'],
            'comparisonData' => $result['comparison'],
        ]);
    }
}
