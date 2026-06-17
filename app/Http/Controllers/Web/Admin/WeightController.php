<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Services\AlternativeService;
use App\Services\CriteriaService;
use App\Services\spk\WeightService;
use Illuminate\Http\Request;

class WeightController extends Controller
{
    public function __construct(
        protected CriteriaService    $criteriaService,
        protected AlternativeService $alternativeService,
        protected WeightService      $weightService,
    ) {}

    public function index()
    {
        $menuTabs = [
            'ew' => [
                'title'   => 'Equal Weight (EW)',
                'desc'    => 'Setiap kriteria mendapat bobot yang sama rata.',
                'color'   => 'blue',
                'formula' => 'w_j = 1/n',
            ],
            'rs' => [
                'title'   => 'Rank Sum (RS)',
                'desc'    => 'Bobot dihitung berdasarkan jumlah ranking kriteria.',
                'color'   => 'green',
                'formula' => 'w_j = (n - r_j + 1) / Σ(n - r_k + 1)',
            ],
            'rr' => [
                'title'   => 'Rank Reciprocal (RR)',
                'desc'    => 'Bobot berbanding terbalik dengan peringkat kriteria.',
                'color'   => 'purple',
                'formula' => 'w_j = (1/r_j) / Σ(1/r_k)',
            ],
            'roc' => [
                'title'   => 'Rank Order Centroid (ROC)',
                'desc'    => 'Bobot menggunakan pendekatan centroid.',
                'color'   => 'orange',
                'formula' => 'w_j = (1/n) × Σ_{k=r_j}^{n} (1/k)',
            ],
            'compare' => [
                'title'   => 'Perbandingan Metode',
                'desc'    => 'Perbandingan hasil 4 metode pembobotan',
                'color'   => 'orange',
                'formula' => '-',
            ],
        ];

        $criterias = $this->criteriaService->getCollection();
        $weights   = $this->weightService->getAllMethods($criterias);

        return view('pages.weight.weight-page', [
            'title'        => 'Bobot Kriteria',
            'criterias'    => $criterias,
            'alternatives' => $this->alternativeService->getAll(),
            'menuTabs'     => $menuTabs,
            'weights'      => $weights,
        ]);
    }

}