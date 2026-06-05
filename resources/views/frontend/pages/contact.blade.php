@extends('frontend.layouts.app')

@section('content')
<!-- Breadcrumb -->
<section class="relative bg-cover bg-center bg-no-repeat"
    style="background-image: url('{{ asset('frontend-img/breadcrumb.jpg') }}')">

    <div class="absolute inset-0 bg-black/60"></div>

    <div class="relative max-w-7xl mx-auto px-5 md:px-8 py-16 sm:py-20 lg:py-28">
        
       <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white text-center">
            Contact Us
        </h1>

    </div>
</section>
@endsection