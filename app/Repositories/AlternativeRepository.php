<?php

namespace App\Repositories;

use App\Models\MotorListrik;
use App\Repositories\Interfaces\AlternativeRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class AlternativeRepository implements AlternativeRepositoryInterface
{
    public function getAll(): Collection    
    {
        // todo: To get all alternatives data from database
        return MotorListrik::orderBy('id_motor')->get();
    }

    public function findById(int $id_motor): ?MotorListrik
    {
        // todo: To find alternative by ID from database
        return MotorListrik::find($id_motor);
    }

    public function store(array $data): MotorListrik
    {
        // todo: To store new alternative data in the database
        return MotorListrik::create($data);
    }

    public function update(int $id_motor, array $data): MotorListrik
    {
        // todo: To update alternative data by ID in the database
        $alternative = MotorListrik::findOrFail($id_motor);
        $alternative->update($data);
        return $alternative->refresh();
    }

    public function delete(int $id_motor): bool
    {
        // todo: To delete alternative by ID from database
        $alternative = MotorListrik::findOrFail($id_motor);
        return $alternative->delete();
    }

}