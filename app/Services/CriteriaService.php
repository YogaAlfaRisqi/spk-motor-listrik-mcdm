<?php

namespace App\Services;

use App\Models\Criteria;
use App\Repositories\Interfaces\CriteriaRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CriteriaService
{
    public function __construct(
        protected CriteriaRepositoryInterface $criteriaRepository
    ) {}

    public function getAll(?string $search = null, int $perPage = 5): LengthAwarePaginator
    {
        return $this->criteriaRepository->getAll($search, $perPage);
    }

    // Untuk kebutuhan collection murni (Dashboard, SPK calculation, dll)
    public function getCollection(?string $search = null): Collection
    {
        return $this->criteriaRepository->getCollection($search);
    }


    public function getById(int $id): ?Criteria
    {
        return $this->criteriaRepository->findById($id);
    }

    public function store(array $data): Criteria
    {
        return $this->criteriaRepository->store($data);
    }

    public function update(int $id, array $data): Criteria
    {
        return $this->criteriaRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->criteriaRepository->delete($id);
    }
}