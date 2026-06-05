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


 
}