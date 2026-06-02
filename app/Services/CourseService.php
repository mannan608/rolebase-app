<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;

class CourseService
{
    /**
     * Fetch all courses from the JSON file.
     *
     * @return \Illuminate\Support\Collection
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

    public function getRouteList(): array
    {
        $routeList = [];

        // 1. Define routes you want to SKIP/HIDE from the SEO dropdown
        $excludedRoutes = [
            'courses.apply', 
            'download.brochure', 
            'sanctum.*', 
            'ignition.*',
            'courses.show' // We skip the raw route because we'll add the slugs manually
        ];

        // 2. Get all named routes from Laravel
        $allRoutes = Route::getRoutes();

        foreach ($allRoutes as $route) {
            $name = $route->getName();

            // Only include GET routes that have a name and aren't in our skip list
            if ($name && in_array('GET', $route->methods()) && !$this->shouldSkip($name, $excludedRoutes)) {
                $routeList[$name] = ucwords(str_replace(['-', '.', '_'], ' ', $name));
            }
        }

        // 3. Add dynamic course routes from JSON
        $courses = $this->getCourses();
        foreach ($courses as $course) {
            // Using a unique identifier format: "type:identifier"
            $key = 'course:' . $course['slug'];
            $routeList[$key] = 'Course: ' . $course['title'];
        }

        return $routeList;
    }

    /**
     * Helper to check if a route should be skipped (supports wildcards)
     */
    private function shouldSkip($name, $excludedRoutes): bool
    {
        foreach ($excludedRoutes as $excluded) {
            if (fnmatch($excluded, $name)) {
                return true;
            }
        }
        return false;
    }
}