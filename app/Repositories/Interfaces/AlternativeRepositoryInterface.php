<?php

namespace App\Repositories\Interfaces;

use App\Models\MotorListrik;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface AlternativeRepositoryInterface
{
    public function getAll(?string $search = null, int $perPage = 5): LengthAwarePaginator;

    public function getCollection(?string $search = null): Collection;

    public function findById(int $id_motor): ?MotorListrik;

    public function store(array $data): MotorListrik;

    public function update(int $id_motor, array $data): MotorListrik;

    public function delete(int $id_motor): bool;
}