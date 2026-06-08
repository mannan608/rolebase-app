<?php

namespace App\Repositories\Eloquent;

use App\Models\University;
use App\Repositories\Interfaces\CampusRepositoryInterface;

class CampusRepository implements CampusRepositoryInterface
{
    public function all()
    {
        return University::latest()->get();
    }

    public function paginate($limit = 10)
    {
        return University::latest()->paginate($limit);
    }

    public function findById($id)
    {
        return University::findOrFail($id);
    }

    public function findBySlug($slug)
    {
        return University::where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();
    }

    public function create(array $data)
    {
        return University::create($data);
    }

    public function update($id, array $data)
    {
        $university = $this->findById($id);

        $university->update($data);

        return $university;
    }

    public function delete($id)
    {
        return University::destroy($id);
    }
}