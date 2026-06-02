<?php

namespace App\SEO\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\CourseTrait;
use App\Traits\RouteDiscoveryTrait;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
        use CourseTrait, RouteDiscoveryTrait;


    public function generate()
    {
        $sitemap = Sitemap::create();

        $routes = $this->getRouteList();

        foreach ($routes as $url => $title) {

            // Full URL
            $fullUrl = str_starts_with($url, 'http')
                ? $url
                : url($url);

            $sitemap->add(
                Url::create($fullUrl)
                    ->setPriority(0.8)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            );
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));

        return response()->json([
            'message' => 'Sitemap generated successfully.'
        ]);
    }
}
