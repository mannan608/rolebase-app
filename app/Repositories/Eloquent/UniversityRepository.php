<?php

namespace App\Repositories;

use App\Models\University;
use App\Repositories\Interfaces\UniversityRepositoryInterface;

class UniversityRepository implements UniversityRepositoryInterface
{
    public function getAll(array $filters = [])
    {
        return University::query()
            ->when(
                $filters['search'] ?? null,
                fn ($q, $search) =>
                $q->where('name', 'like', "%{$search}%")
            )
            ->when(
                $filters['status'] ?? null,
                fn ($q, $status) =>
                $q->where('status', $status)
            )
            ->latest()
            ->paginate(20);
    }

    public function find(int $id)
    {
        return University::findOrFail($id);
    }

    public function create(array $data)
    {
        return University::create($data);
    }

    public function update(int $id, array $data)
    {
        $university = $this->find($id);

        $university->update($data);

        return $university;
    }

    public function delete(int $id)
    {
        return $this->find($id)->delete();
    }
}