<?php

namespace App\Repositories\Eloquent;

use App\Models\Campus;
use App\Models\University;
use App\Repositories\Interfaces\CampusRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CampusRepository implements CampusRepositoryInterface
{
    public function paginate(int $perPage = 15)
    {
        return Campus::with('university')
            ->latest()
            ->paginate($perPage);
    }

    public function universities()
    {
        return University::query()
            ->orderBy('name')
            ->get(['id', 'name']);
    }

    public function findById(int $id): Campus
    {
        return Campus::with('university')
            ->findOrFail($id);
    }

    public function create(array $data): Campus
    {
        return DB::transaction(function () use ($data) {

            $data['slug'] = $this->generateUniqueSlug(
                $data['name']
            );

            return Campus::create($data);
        });
    }

    public function update(
        Campus $campus,
        array $data
    ): Campus {
        return DB::transaction(function () use ($campus, $data) {

            if (
                isset($data['name']) &&
                $campus->name !== $data['name']
            ) {
                $data['slug'] = $this->generateUniqueSlug(
                    $data['name'],
                    $campus->id
                );
            }

            $campus->update($data);

            return $campus->fresh();
        });
    }

    public function delete(Campus $campus): bool
    {
        return DB::transaction(function () use ($campus) {
            return $campus->delete();
        });
    }

    private function generateUniqueSlug(
        string $name,
        ?int $ignoreId = null
    ): string {
        $slug = Str::slug($name);

        $query = Campus::query()
            ->where('slug', 'LIKE', "{$slug}%");

        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        $count = $query->count();

        return $count
            ? "{$slug}-" . ($count + 1)
            : $slug;
    }
}