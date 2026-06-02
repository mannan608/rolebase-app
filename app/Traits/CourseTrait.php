<?php

namespace App\Traits;

use Illuminate\Support\Collection;

trait CourseTrait
{
    /**
     * Fetch all courses from the JSON file globally.
     */
    public function getCourses(): Collection
    {
        $path = public_path('/courses.json');

        if (!file_exists($path)) {
            return collect();
        }

        $data = json_decode(file_get_contents($path), true);
        
        return collect($data['courses'] ?? []);
    }
}