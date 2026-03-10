<?php

namespace App\Repositories\Interfaces;

use App\Models\Criteria;
use Illuminate\Database\Eloquent\Collection;

interface CriteriaRepositoryInterface
{
    public function getAll(): Collection;

    public function findById(int $id): ?Criteria;

    public function store(array $data): Criteria;

    public function update(int $id, array $data): Criteria;

    public function delete(int $id): bool;
}