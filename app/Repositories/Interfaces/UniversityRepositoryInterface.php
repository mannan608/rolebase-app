<?php

namespace App\Repositories\Interfaces;

use App\Models\University;
use Illuminate\Http\Request;

interface UniversityRepositoryInterface
{
    public function paginate(int $perPage = 15);

    public function findById(int $id): University;

    public function create(array $data, Request $request): University;

    public function update(University $university,array $data,Request $request): University;

    public function delete(
        University $university
    ): bool;
}