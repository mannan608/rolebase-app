@php
    use App\SEO\Models\SeoMeta;
    $routeName = request()->route()?->getName();
    $currentUri = request()->getRequestUri();
    $lastSegment = request()->segment(count(request()->segments()));

 
    $seo = SeoMeta::query()
        ->whereIn('path', array_filter([$routeName, $currentUri]))
        ->where('is_active', true)
        ->first();


    $siteName = config('app.name');
    $siteUrl = rtrim(config('app.url') ?: url('/'), '/');

    $pageTitle = $seo?->meta_title;

    if (!$pageTitle) {
        $pageTitle = $routeName
            ? str($routeName)->replace('.', ' ')->title()
            : ($lastSegment
                ? str($lastSegment)->replace('-', ' ')->title()
                : $siteName);
    }

    $fullTitle = "{$pageTitle} | {$siteName}";
    $defaultImage = asset('images/og-default.jpg');

    $ogImage = !empty($seo?->og_image)
        ? asset($seo->og_image)
        : $defaultImage;

    $twitterImage = !empty($seo?->twitter_image)
        ? asset($seo->twitter_image)
        : $ogImage;
@endphp

<title>{{ $fullTitle }}</title>

<link rel="icon" href="{{ asset('favicon.ico') }}">

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

{{-- Basic SEO --}}
<meta name="description"
    content="{{ $seo?->meta_description ?: $siteName }}">

<meta name="keywords"
    content="{{ $seo?->meta_keywords ?: 'education,college,training,courses' }}">

<meta name="robots"
    content="{{ $seo?->robots ?: 'index,follow' }}">

<link rel="canonical"
    href="{{ $seo?->canonical_url ?: url()->current() }}">

{{-- Open Graph --}}
<meta property="og:title"
    content="{{ $seo?->og_title ?: $fullTitle }}">

<meta property="og:description"
    content="{{ $seo?->og_description ?: ($seo?->meta_description ?: $siteName) }}">

<meta property="og:image"
    content="{{ $ogImage }}">

<meta property="og:image:secure_url"
    content="{{ $ogImage }}">

<meta property="og:image:width"
    content="1200">

<meta property="og:image:height"
    content="630">

<meta property="og:image:type"
    content="image/png">

<meta property="og:url"
    content="{{ url()->current() }}">

<meta property="og:type"
    content="{{ $seo?->og_type ?: 'website' }}">

<meta property="og:site_name"
    content="{{ $siteName }}">

{{-- Twitter --}}
<meta name="twitter:card"
    content="summary_large_image">

<meta name="twitter:title"
    content="{{ $seo?->twitter_title ?: $fullTitle }}">

<meta name="twitter:description"
    content="{{ $seo?->twitter_description ?: ($seo?->meta_description ?: $siteName) }}">

<meta name="twitter:image"
    content="{{ $twitterImage }}">

{{-- Header Scripts --}}
@if (!empty($seo?->header_scripts))
    @foreach ($seo->header_scripts as $script)
        {!! $script !!}
    @endforeach
@endif

{{-- Schema Markup --}}
@if (!empty($seo?->schema_markup))
    {!! $seo->schema_markup !!}
@endif

{{-- Footer Scripts --}}
@if (!empty($seo?->footer_scripts))
    @foreach ($seo->footer_scripts as $script)
        {!! $script !!}
    @endforeach
@endif