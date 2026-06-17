<?php

namespace App\Repositories;

use App\Models\MotorListrik;
use App\Repositories\Interfaces\AlternativeRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AlternativeRepository implements AlternativeRepositoryInterface
{
    protected string $imageFolder = 'motor_listrik';
    protected string $imageDisk = 'public';

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
        return MotorListrik::find($id_motor);
    }

    public function store(array $data): MotorListrik
    {
        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $data['image'] = $this->uploadImage($data['image']);
        }

        $data['created_by'] = Auth::id() ?? 1;

        return MotorListrik::create($data);
    }

    public function update(int $id_motor, array $data): MotorListrik
    {
        $alternative = MotorListrik::findOrFail($id_motor);

        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $this->deleteImage($alternative->image);
            $data['image'] = $this->uploadImage($data['image']);
        }

        $alternative->update($data);
        return $alternative->refresh();
    }

    public function delete(int $id_motor): bool
    {
        $alternative = MotorListrik::findOrFail($id_motor);

        $this->deleteImage($alternative->image);

        return $alternative->delete();
    }

    protected function uploadImage(UploadedFile $file): string
    {
        return $file->store($this->imageFolder, $this->imageDisk);
    }

    protected function deleteImage(?string $path): void
    {
        if ($path && Storage::disk($this->imageDisk)->exists($path)) {
            Storage::disk($this->imageDisk)->delete($path);
        }
    }
}