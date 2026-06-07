<?php

namespace App\Repositories\Interfaces;

interface UniversityRepositoryInterface
{
    public function all();
    public function paginate($limit = 10);
    public function findById($id);
    public function findBySlug($slug);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}