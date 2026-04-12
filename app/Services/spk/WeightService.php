<?php

namespace App\Services\spk;

use Illuminate\Support\Collection;

class WeightService
{
    private function validateRanks(Collection $criterias): void
    {
        foreach ($criterias as $c) {
            if (is_null($c->peringkat) || $c->peringkat <= 0) {
                throw new \Exception("Peringkat tidak valid pada kriteria: {$c->kode_kriteria}");
            }
        }
    }

    /**
     * keyBy string primary key agar lookup di Blade selalu cocok
     * Otomatis deteksi nama primary key: id_kriteria atau id
     */
    private function keyById(Collection $result, string $pkField): Collection
    {
        return $result->keyBy(fn ($item) => (string) $item[$pkField]);
    }

    public function equalWeight(Collection $criterias): Collection
    {
        $pk    = $criterias->first()->getKeyName(); // ambil nama PK dari model
        $n     = $criterias->count();
        $bobot = $n > 0 ? 1 / $n : 0;

        return $this->keyById(
            $criterias->map(fn ($c) => [
                $pk     => $c->getKey(),
                'bobot' => $bobot,
            ]),
            $pk
        );
    }

    public function rankSum(Collection $criterias): Collection
    {
        $this->validateRanks($criterias);

        $pk          = $criterias->first()->getKeyName();
        $n           = $criterias->count();
        $denominator = ($n * ($n + 1)) / 2;

        return $this->keyById(
            $criterias->map(fn ($c) => [
                $pk     => $c->getKey(),
                'bobot' => $denominator > 0 ? ($n - $c->peringkat + 1) / $denominator : 0,
            ]),
            $pk
        );
    }

    public function rankReciprocal(Collection $criterias): Collection
    {
        $this->validateRanks($criterias);

        $pk          = $criterias->first()->getKeyName();
        $denominator = $criterias->sum(fn ($c) => 1 / $c->peringkat);

        return $this->keyById(
            $criterias->map(function ($c) use ($pk, $denominator) {
                $reciprocal = 1 / $c->peringkat;

                return [
                    $pk          => $c->getKey(),
                    'reciprocal' => $reciprocal,
                    'bobot'      => $denominator > 0 ? $reciprocal / $denominator : 0,
                ];
            }),
            $pk
        );
    }

    public function roc(Collection $criterias): Collection
    {
        $this->validateRanks($criterias);

        $pk = $criterias->first()->getKeyName();
        $n  = $criterias->count();

        return $this->keyById(
            $criterias->map(function ($c) use ($pk, $n) {
                $sumTerm = 0;

                for ($k = max(1, (int) $c->peringkat); $k <= $n; $k++) {
                    $sumTerm += 1 / $k;
                }

                return [
                    $pk        => $c->getKey(),
                    'sum_term' => $sumTerm,
                    'bobot'    => $n > 0 ? (1 / $n) * $sumTerm : 0,
                ];
            }),
            $pk
        );
    }

    /**
     * Terima $criterias dari luar (dari controller via CriteriaService)
     * agar collection yang dipakai kalkulasi == collection yang dikirim ke view
     *
     * @return array{ew: Collection, rs: Collection, rr: Collection, roc: Collection}
     */
    public function getAllMethods(Collection $criterias): array
    {
        return [
            'ew'  => $this->equalWeight($criterias),
            'rs'  => $this->rankSum($criterias),
            'rr'  => $this->rankReciprocal($criterias),
            'roc' => $this->roc($criterias),
        ];
    }
}