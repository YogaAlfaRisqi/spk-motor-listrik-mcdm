<?php

namespace App\Repositories\Interfaces;

use App\Models\MotorListrik;
use Illuminate\Database\Eloquent\Collection;

interface AlternativeRepositoryInterface
{
    public function getAll(): Collection;

    public function findById(int $id_motor): ?MotorListrik;

    public function store(array $data): MotorListrik;

    public function update(int $id_motor, array $data): MotorListrik;

    public function delete(int $id_motor): bool;
}