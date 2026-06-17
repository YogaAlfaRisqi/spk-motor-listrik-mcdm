<?php

namespace App\Services\SPK;

class CalculationService
{
    public function calculate($alternatives, $columns, $criterias, $weights)
    {
        $normalized = $this->normalize($alternatives, $columns);

        $results = [];

        foreach ($weights as $key => $weight) {

            // 🔥 FIX: mapping bobot sesuai kolom (PENTING BANGET)
            $weightByColumn = [];

            foreach ($criterias as $i => $c) {
                $col = $columns[$i] ?? null;

                if (!$col) continue;

                $w = collect($weight)->firstWhere('id_kriteria', $c->id_kriteria);

                $weightByColumn[$col] = $w['bobot'] ?? 0;
            }

            // 🔥 pakai weight hasil mapping
            $weighted = $this->weighted($normalized, $weightByColumn);
            $ideal = $this->ideal($weighted, $columns, $criterias);
            $ranking = $this->ranking($weighted, $ideal);

            $results[$key] = [
                'weights' => $weight, // tetap original (biar tabel bobot aman)
                'normalized' => $normalized,
                'weighted' => $weighted,
                'ideal' => $ideal,
                'ranking' => $ranking,
            ];
        }

        return [
            'methods' => $results,
            'comparison' => $this->comparison($results),
        ];
    }

    /**
     * ✅ NORMALISASI (VECTOR NORMALIZATION)
     */
    private function normalize($alternatives, $columns)
    {
        $divider = [];

        foreach ($columns as $col) {
            $sumSquares = collect($alternatives)
                ->pluck($col)
                ->map(fn($v) => pow($v, 2))
                ->sum();

            $divider[$col] = $sumSquares > 0 ? sqrt($sumSquares) : 1;
        }

        return collect($alternatives)->map(function ($a) use ($columns, $divider) {

            $values = [];

            foreach ($columns as $col) {
                $val = $a->$col ?? 0;

                $values[$col] = $divider[$col] != 0
                    ? $val / $divider[$col]
                    : 0;
            }

            return [
                'nama_motor' => $a->nama_motor,
                'values' => $values
            ];
        })->toArray();
    }

    /**
     * ✅ PEMBOBOTAN (SESUAI EXCEL)
     */
    private function weighted($normalized, $weights)
    {
        return collect($normalized)->map(function ($row) use ($weights) {

            $values = [];

            foreach ($row['values'] as $col => $val) {
                $values[$col] = $val * ($weights[$col] ?? 0);
            }

            return [
                'nama_motor' => $row['nama_motor'],
                'values' => $values
            ];
        })->toArray();
    }

    /**
     * ✅ SOLUSI IDEAL
     */
    private function ideal($weighted, $columns, $criterias)
    {
        $positive = [];
        $negative = [];

        foreach ($columns as $i => $col) {
            $values = array_column(array_column($weighted, 'values'), $col);
            $type = $criterias[$i]->tipe ?? 'benefit';

            $positive[$col] = $type === 'benefit'
                ? max($values)
                : min($values);

            $negative[$col] = $type === 'benefit'
                ? min($values)
                : max($values);
        }

        return [
            'positive' => $positive,
            'negative' => $negative,
        ];
    }

    /**
     * ✅ RANKING
     */
    private function ranking($weighted, $ideal)
    {
        $results = [];

        foreach ($weighted as $index => $row) {

            $dPlus = 0;
            $dMinus = 0;

            foreach ($row['values'] as $col => $val) {
                $dPlus += pow($val - $ideal['positive'][$col], 2);
                $dMinus += pow($val - $ideal['negative'][$col], 2);
            }

            $dPlus = sqrt($dPlus);
            $dMinus = sqrt($dMinus);

            $score = ($dPlus + $dMinus) != 0
                ? $dMinus / ($dPlus + $dMinus)
                : 0;

            $results[] = [
                'index' => $index, // 🔥 penting
                'nama_motor' => $row['nama_motor'],
                'd_plus' => $dPlus,
                'd_minus' => $dMinus,
                'score' => $score
            ];
        }

        // 🔥 SORT BERDASARKAN SCORE
        $sorted = collect($results)
            ->sortByDesc('score')
            ->values();

        // 🔥 MAP RANK BERDASARKAN INDEX (BUKAN NAMA)
        $rankMap = [];
        foreach ($sorted as $i => $row) {
            $rankMap[$row['index']] = $i + 1;
        }

        // 🔥 ASSIGN RANK KE DATA ASLI
        foreach ($results as &$row) {
            $row['rank'] = $rankMap[$row['index']] ?? null;
        }

        return $results;
    }

    /**
     * ✅ COMPARISON
     */
    private function comparison($results)
    {
        $methods = array_keys($results); // 🔥 ambil semua metode (ew, rs, dll)

        return collect($results[$methods[0]]['ranking'])->map(function ($row) use ($results, $methods) {

            $item = [
                'name' => $row['nama_motor'],
            ];

            foreach ($methods as $method) {
                $item[$method] = $this->rank(
                    $results[$method]['ranking'],
                    $row['nama_motor']
                );
            }

            return $item;
        })->toArray();
    }

    private function rank($ranking, $name)
    {
        return collect($ranking)
            ->firstWhere('nama_motor', $name)['rank'] ?? null;
    }
}
