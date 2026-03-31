<?php

namespace App\Repositories;

use App\Models\Alternative;
use App\Repositories\Interfaces\AlternativeRepositoryInterface;
use Ramsey\Collection\Collection;

class AlternativeRepository implements AlternativeRepositoryInterface
{
    public function getAll(): Collection
    {
        // todo: To get all alternatives data from database
        return Alternative::orderBy('kode_alternatif')->get();
    }

    public function findById(int $id)
    {
        // todo: To find alternative by ID from database
        return Alternative::find($id);
    }

    public function store(array $data)
    {
        // todo: To store new alternative data in the database
        return Alternative::create($data);
    }

    public function update(int $id, array $data)
    {
        // todo: To update alternative data by ID in the database
        $alternative = Alternative::findOrFail($id);
        $alternative->update($data);
        return $alternative->refresh();
    }

    public function delete(int $id)
    {
        // todo: To delete alternative by ID from database
        $alternative = Alternative::findOrFail($id);
        return $alternative->delete();
    }

}