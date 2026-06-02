<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\CourseService; 

class CourseController extends Controller
{
    protected $courseService;

    /**
     * Inject the CourseService.
     */
    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

   public function courseDetails($slug)
{
    // Fetch all courses
    $courses = collect($this->courseService->getCourses());

    // Find current course
    $course = $courses->firstWhere('slug', $slug);

    // 404 if not found
    if (!$course) {
        abort(404);
    }

    // Related industry courses
    $relatedCourses = $courses->filter(function ($item) use ($course) {

        // same industry
        $sameIndustry = $item['industry'] === $course['industry'];

        // exclude current course
        $notCurrentCourse = $item['slug'] !== $course['slug'];

        return $sameIndustry && $notCurrentCourse;
    })->values();

    // View path
    $view = 'frontend.pages.courses.' . $slug;

    // Check blade exists
    if (!view()->exists($view)) {
        abort(404, 'Course page template not found');
    }

    return view($view, [
        'course' => $course,
        'courses' => $relatedCourses,
        'title' => $course['title']
    ]);
}

    }