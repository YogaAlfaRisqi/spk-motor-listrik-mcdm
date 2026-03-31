<?php

namespace App\Services;

use App\Repositories\Interfaces\CriteriaRepositoryInterface;


class CriteriaService
{
    protected $criteriaRepository;

    public function __construct(CriteriaRepositoryInterface $criteriaRepository)
    {
        $this->criteriaRepository = $criteriaRepository;
    }

    public function getAll()
    {
        return $this->criteriaRepository->getAll();
    }

    public function getById(int $id)
    {
        return $this->criteriaRepository->findById($id);
    }

    public function create(array $data)
    {
        return $this->criteriaRepository->store($data);
    }

    public function update(int $id, array $data)
    {
        return $this->criteriaRepository->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->criteriaRepository->delete($id);
    }
}