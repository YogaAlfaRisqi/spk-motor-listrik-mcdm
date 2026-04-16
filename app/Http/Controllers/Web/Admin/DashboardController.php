<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Services\AlternativeService;
use App\Services\CriteriaService;
use App\Services\SPK\CalculationService;
use App\Services\SPK\WeightService;
use App\Models\User;

class DashboardController extends Controller
{
    public function __construct(
        protected CriteriaService $criteriaService,
        protected AlternativeService $alternativeService,
        protected WeightService $weightService,
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

        // 🔥 ambil data
        $criterias = $this->criteriaService->getAll();
        $alternatives = $this->alternativeService->getAll();

        // 🔥 KPI (SUMMARY)
        $totalKriteria   = $criterias->count();
        $totalAlternatif = $alternatives->count();
        $totalUser       = User::count();

        // 🔥 bobot
        $weights = $this->weightService->getAllMethods($criterias);

        // 🔥 hitung SPK
        $result = $this->calculationService->calculate(
            $alternatives,
            $columns,
            $criterias,
            $weights
        );

        return view('pages.dashboard.welcome-page', [
            'title'            => 'Dashboard',
            'criterias'        => $criterias,
            'alternatives'     =>$alternatives,
            'weights'          =>$weights,
            'comparisonData'   => $result['comparison'] ?? [],

            // ✅ kirim ke view (KPI)
            'totalKriteria'    => $totalKriteria,
            'totalAlternatif'  => $totalAlternatif,
            'totalUser'        => $totalUser,
        ]);
    }
}