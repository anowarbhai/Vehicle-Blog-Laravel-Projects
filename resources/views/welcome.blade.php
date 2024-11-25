@extends('layouts.myapp')
@section('title', getSiteSettings()->meta_title)
@section('description', getSiteSettings()->meta_desc)
@section('keywords', getSiteSettings()->meta_keyword)

@section('content')
<!-- ======================= Blog Start  ============================ -->
<div class="blog_section bg-white overflow-hidden pt-4 pb-4">
        <div class="container">
        <div class="row g-4">
            <div class="col-xl-3 order-xl-2">
                @include('layouts.partials.sidebar')
            </div>
            <div class="col-xl-9 order-xl-1">
                <div class="blog_wrapper">
                    <div class="row gy-4">
                        @foreach ($blogs as $post)
                            <div class="col-md-6">
                                <div class="blog_post p-3 p-lg-4 card h-100 bg-transparent shadow-sm border-opacity-10">
                                    <div class="blog_img mb-4 position-relative">
                                        <a href="{{ route('blogs.details', $post->slug) }}"> <!-- Use route to generate dynamic links -->
                                            <img class="img-fluid rounded z-3" src="{{ asset($post->image) }}" alt="{{ $post->title }}">
                                        </a>
                                    </div>
                                    <div class="short_info d-sm-flex align-items-center mb-3">
                                        <div class="mb-2 mb-sm-0 me-3">
                                            <div class="d-flex align-items-center">
                                                <div class="icon me-1">
                                                    <img src="assets/images/tag.svg" alt="Tag">
                                                </div>
                                                <div class="date"><span>{{ $post->category->title }}</span></div> <!-- Display category title -->
                                            </div>
                                        </div>
                                        <div class="mb-2 mb-sm-0 me-3">
                                            <div class="d-flex align-items-center">
                                                <div class="icon me-1">
                                                    <img src="assets/images/calendar.svg" alt="Date">
                                                </div>
                                                <div class="date"><span>{{ $post->created_at->format('d M, Y') }}</span></div> <!-- Display formatted date -->
                                            </div>
                                        </div>
                                        <div class="">
                                            <div class="d-flex align-items-center">
                                                <div class="icon me-1">
                                                    <img src="assets/images/eye.svg" alt="View">
                                                </div>
                                                <div class="date"><span>{{ $post->view }}</span></div> <!-- Display view count -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="blog_content card-body p-0">
                                        <h3 class="mb-3">
                                            <a href="{{ route('blogs.details', $post->slug) }}">{{ $post->title }}</a> <!-- Dynamic post title -->
                                        </h3>
                                        <div class="blog_desc mb-2">
                                            {!! Str::limit($post->description, 100) !!} <!-- Display a truncated description -->
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="card-footer mt-2 bg-transparent border-0 blog_content p-0">
                                        <a class="learn_more" href="{{ route('blogs.details', $post->slug) }}">Read More</a> <!-- Dynamic link -->
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="btn-readmore mt-5 text-center">
                        <a class="readmoreanhr btn btn-primary" href="{{ route('blogs.index') }}">See More Post</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- ======================= Blog End  ============================ -->
@endsection