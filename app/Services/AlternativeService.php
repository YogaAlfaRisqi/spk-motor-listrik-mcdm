<?php

namespace App\Services;

use App\Repositories\Interfaces\AlternativeRepositoryInterface;

class AlternativeService
{
    protected $alternativeRepository;

    public function __construct(AlternativeRepositoryInterface $alternativeRepository)
    {
        $this->alternativeRepository = $alternativeRepository;
    }

    public function getAll(?string $search = null, int $perPage = 5)
    {
        return $this->alternativeRepository->getAll($search, $perPage);
    }

    public function getCollection()
    {
        return $this->alternativeRepository->getCollection();
    }

    public function getById($id)
    {
        return $this->alternativeRepository->findById($id);
    }
    public function store(array $data)
    {
        return $this->alternativeRepository->store($data);
    }
    public function update($id, array $data)
    {
        return $this->alternativeRepository->update($id, $data);
    }
    public function delete($id)
    {
        return $this->alternativeRepository->delete($id);
    }
}