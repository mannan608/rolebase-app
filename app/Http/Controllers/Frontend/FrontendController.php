<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Traits\CourseTrait;
use App\Traits\RouteDiscoveryTrait;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    use CourseTrait, RouteDiscoveryTrait;

    public function landingPage()
    {
        // Get only the first 3 courses for the landing page
        $courses = $this->getCourses()->take(3);

        
        return view('frontend.pages.home', [
            'title' => 'Specter Training Center', 
            'courses' => $courses
        ]);
    }

    public function aboutPage()
    {
        return view('frontend.pages.about', ['title' => 'About Us']);
    }

    public function contactPage()
    {
        return view('frontend.pages.contact', ['title' => 'Contact Us']);
    }

    public function qualificationsPage(Request $request)
    {
        // Fetch all courses globally via the service
        $allCourses = $this->getCourses();
        $courses = $allCourses;

        // Industry filter
        if ($request->filled('industry')) {
            $industry = strtolower($request->industry);
            $courses = $courses->filter(function ($course) use ($industry) {
                return strtolower($course['industry'] ?? '') === $industry;
            });
        }

        // Level filter
        if ($request->filled('level')) {
            $level = strtolower($request->level);
            $courses = $courses->filter(function ($course) use ($level) {
                return strtolower($course['level'] ?? '') === $level;
            });
        }

        // Search logic
        if ($request->filled('search')) {
            $search = strtolower(trim($request->search));
            $courses = $courses->filter(function ($course) use ($search) {
                return str_contains(strtolower($course['title'] ?? ''), $search) ||
                       str_contains(strtolower($course['code'] ?? ''), $search) ||
                       str_contains(strtolower($course['industry'] ?? ''), $search) ||
                       str_contains(strtolower($course['level'] ?? ''), $search) ||
                       str_contains(strtolower($course['description'] ?? ''), $search);
            });
        }

        // Reset keys for clean JSON/Array output
        $courses = $courses->values();

        // Handle AJAX requests (for live filtering)
        if ($request->ajax()) {
            return response()->json([
                'html' => view('frontend.pages.partials.qualification-cards', [
                    'courses' => $courses,
                ])->render(),
                'count' => $courses->count(),
            ]);
        }

        return view('frontend.pages.qualifications', [
            'title' => 'Qualifications',
            'courses' => $courses,
            'industries' => $allCourses->pluck('industry')->unique()->sort()->values(),
            'levels' => $allCourses->pluck('level')->unique()->sort()->values(),
        ]);
    }

    // Legal pages
    public function privacyPolicy()
    {
        return view('frontend.pages.legal.privacy-policy', ['title' => 'Privacy Policy']);
    }

    public function termsOfService()
    {
        return view('frontend.pages.legal.terms-of-service', ['title' => 'Terms of Service']);
    }

    public function accreditations()
    {
        return view('frontend.pages.legal.accreditations', ['title' => 'Accreditations']);
    }

    public function cookiePolicy()
    {
        return view('frontend.pages.legal.cookie-policy', ['title' => 'Cookie Policy']);
    }
 
}