<?php

namespace App\Repositories;

use App\Models\Criteria;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Interfaces\CriteriaRepositoryInterface;

class CriteriaRepository implements CriteriaRepositoryInterface
{
    public function getAll(): Collection
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