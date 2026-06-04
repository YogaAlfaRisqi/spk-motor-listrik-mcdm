<?php

namespace App\Repositories;

use App\Models\Criteria;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Interfaces\CriteriaRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Override;

class CriteriaRepository implements CriteriaRepositoryInterface
{
    public function getAll(?string $search = null, int $perPage = 5): LengthAwarePaginator
    {
        $query = Criteria::query();

        if ($search !== null && $search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('nama_kriteria', 'like', "%{$search}%")
                  ->orWhere('kode_kriteria', 'like', "%{$search}%");
            });
        }

        return $query->orderBy('kode_kriteria')
            ->paginate($perPage)
            ->withQueryString();
    }

    public function getCollection(?string $search = null): Collection
    {
        return Criteria::orderBy('kode_kriteria')->get();
    }

    public function findById(int $id): ?Criteria
    {
        return Criteria::find($id);
    }

    public function store(array $data): Criteria
    {
        return Criteria::create($data);
    }

    public function update(int $id, array $data): Criteria
    {
        $criteria = Criteria::findOrFail($id);

        $criteria->update($data);

        return $criteria->refresh();
    }

    public function delete(int $id): bool
    {
        $criteria = Criteria::findOrFail($id);

        return $criteria->delete();
    }
}