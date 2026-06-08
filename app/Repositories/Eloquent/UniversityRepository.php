<?php

namespace App\Repositories\Eloquent;

use App\Models\University;
use App\Repositories\Interfaces\UniversityRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UniversityRepository implements UniversityRepositoryInterface
{
    public function paginate(int $perPage = 15)
    {
        return University::latest()
            ->paginate($perPage);
    }

    public function findById(int $id): University
    {
        return University::findOrFail($id);
    }

    public function create(
        array $data,
        Request $request
    ): University {

        return DB::transaction(function () use ($data, $request) {

            $data['slug'] = $this->generateUniqueSlug(
                $data['name']
            );

            if ($request->hasFile('logo')) {
                $data['logo'] = $this->uploadFile(
                    $request->file('logo'),
                    'uploads/universities/logos'
                );
            }

            if ($request->hasFile('banner')) {
                $data['banner'] = $this->uploadFile(
                    $request->file('banner'),
                    'uploads/universities/banners'
                );
            }

            return University::create($data);
        });
    }

    public function update(
        University $university,
        array $data,
        Request $request
    ): University {

        return DB::transaction(function () use (
            $university,
            $data,
            $request
        ) {

            if (
                isset($data['name']) &&
                $university->name !== $data['name']
            ) {
                $data['slug'] = $this->generateUniqueSlug(
                    $data['name'],
                    $university->id
                );
            }

            if ($request->hasFile('logo')) {
                $data['logo'] = $this->uploadFile(
                    $request->file('logo'),
                    'uploads/universities/logos'
                );
            }

            if ($request->hasFile('banner')) {
                $data['banner'] = $this->uploadFile(
                    $request->file('banner'),
                    'uploads/universities/banners'
                );
            }

            $university->update($data);

            return $university->fresh();
        });
    }

    public function delete(
        University $university
    ): bool {
        return $university->delete();
    }

    private function generateUniqueSlug(
        string $name,
        ?int $ignoreId = null
    ): string {

        $slug = Str::slug($name);

        $query = University::where(
            'slug',
            'LIKE',
            "{$slug}%"
        );

        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        $count = $query->count();

        return $count
            ? "{$slug}-" . ($count + 1)
            : $slug;
    }

    private function uploadFile(
        $file,
        string $path
    ): string {

        $destinationPath = public_path($path);

        if (! file_exists($destinationPath)) {
            mkdir($destinationPath, 0775, true);
        }

        $fileName = time()
            . '_'
            . uniqid()
            . '.'
            . $file->getClientOriginalExtension();

        $file->move(
            $destinationPath,
            $fileName
        );

        return $path . '/' . $fileName;
    }
}