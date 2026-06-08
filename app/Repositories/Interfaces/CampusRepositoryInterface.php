<?php

namespace App\Repositories\Interfaces;

use App\Models\Campus;

interface CampusRepositoryInterface
{
    public function paginate(int $perPage = 15);

    public function universities();

    public function findById(int $id): Campus;

    public function create(array $data): Campus;

    public function update(Campus $campus, array $data): Campus;

    public function delete(Campus $campus): bool;
}