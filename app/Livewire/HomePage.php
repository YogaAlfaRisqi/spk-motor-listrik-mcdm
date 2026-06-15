<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Services\CriteriaService;
use App\Services\AlternativeService;
use App\Services\spk\WeightService;
use App\Services\spk\CalculationService;

#[Layout('livewire.layouts.guest')]
class HomePage extends Component
{
    public string $currentPage = '/';

    public function navigate($page)
    {
        $this->currentPage = $page;
    }

    public function render(
        CriteriaService $criteriaService,
        AlternativeService $alternativeService,
        WeightService $weightService,
        CalculationService $calculationService
    ) {

        $columns = [
            'harga',
            'jarak_tempuh',
            'waktu_pengisian',
            'kapasitas_baterai',
            'daya_maksimum'
        ];

        $criterias = $criteriaService->getCollection();
        $alternatives = $alternativeService->getCollection();

        $weights = $weightService->getAllMethods($criterias);

        $result = $calculationService->calculate(
            $alternatives,
            $columns,
            $criterias,
            $weights
        );

        return view('livewire.pages.landing-page.home-page', [
            'rankingROC' => collect($result['methods']['roc']['ranking'] ?? [])
                ->sortByDesc('score')
                ->take(5)
                ->values()
        ]);
    }
}
