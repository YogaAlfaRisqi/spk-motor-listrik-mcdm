<?php

namespace App\Services\SPK;

use Illuminate\Support\Collection;

class AnalisisService
{
    public function __construct(
        protected WeightService $weightService,
        protected CalculationService $calculationService,
    ) {}

    /**
     * @param Collection $alternatives koleksi MotorListrik (sudah difilter selectedIds)
     * @param Collection $criterias    koleksi kriteria (dari CriteriaService)
     * @param array      $columns      nama kolom alternatif yang dipakai sebagai kriteria
     *
     * @return array{methods: array, comparison: array}
     */
    public function analyze(Collection $alternatives, Collection $criterias, array $columns): array
    {
        $weights = $this->weightService->getAllMethods($criterias);

        return $this->calculationService->calculate(
            $alternatives,
            $columns,
            $criterias,
            $weights
        );
    }

    /**
     * Alasan keunggulan/kekurangan satu alternatif pada satu metode,
     * dibandingkan dengan rata-rata nilai mentah (raw) seluruh alternatif.
     *
     * @param array      $methodResult hasil $result['methods'][$key] dari CalculationService
     * @param int        $index        index alternatif (sesuai 'index' pada ranking)
     * @param Collection $alternatives koleksi alternatif asli (untuk ambil nilai mentah)
     * @param Collection $criterias    koleksi kriteria (untuk tipe, label, unit)
     * @param array      $columns      nama kolom alternatif
     */
    public function getAlasan(
        array $methodResult,
        int $index,
        Collection $alternatives,
        Collection $criterias,
        array $columns
    ): array {
        $alternativesArr = $alternatives->values()->all();
        $current = $alternativesArr[$index] ?? null;

        if (!$current) {
            return ['unggul' => [], 'lemah' => []];
        }

        $alasan = ['unggul' => [], 'lemah' => []];

        foreach ($columns as $i => $col) {
            $criteria = $criterias[$i] ?? null;
            if (!$criteria) continue;

            $allValues = collect($alternativesArr)
                ->map(fn($a) => (float) ($a->$col ?? 0));

            $avg   = $allValues->avg();
            $value = (float) ($current->$col ?? 0);

            $type = $criteria->tipe ?? 'benefit';

            $isBetter = $type === 'benefit' ? $value > $avg : $value < $avg;
            $isWorse  = $type === 'benefit' ? $value < $avg : $value > $avg;

            $item = [
                'label' => $criteria->nama_kriteria ?? $criteria->kode_kriteria ?? $col,
                'value' => $value,
                'unit'  => $criteria->satuan ?? '',
            ];

            if ($isBetter) {
                $alasan['unggul'][] = $item;
            } elseif ($isWorse) {
                $alasan['lemah'][] = $item;
            }
        }

        return $alasan;
    }
}