<?php

namespace App\Repositories\Interfaces;

use App\Models\Criteria;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface CriteriaRepositoryInterface
{
    public function getAll(?string $search = null, int $perPage = 5): LengthAwarePaginator;

    public function getCollection(?string $search = null): Collection;

    public function findById(int $id): ?Criteria;

    public function store(array $data): Criteria;

    public function update(int $id, array $data): Criteria;

    public function delete(int $id): bool;
}