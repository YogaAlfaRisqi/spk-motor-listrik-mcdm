<?php

namespace App\Repositories;

use App\Models\MotorListrik;
use App\Repositories\Interfaces\AlternativeRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class AlternativeRepository implements AlternativeRepositoryInterface
{   
    
    public function getAll(?string $search = null, int $perPage = 5): LengthAwarePaginator
    {
        $query = MotorListrik::query();

        if ($search !== null && $search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('nama_motor', 'like', "%{$search}%")
                  ->orWhere('id_motor', 'like', "%{$search}%");
            });
        }

        return $query->orderBy('id_motor')
            ->paginate($perPage)
            ->withQueryString();
    }
    

    public function getCollection(?string $search = null): Collection
    {
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
        $data['created_by'] = Auth::id() ?? 1;
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