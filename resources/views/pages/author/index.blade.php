@extends('layouts.header',[
    'title' => $author->name ?? 'Author',
    'meta_description' => '',
    'meta_keywords' => '',
    'faqs' => null
])

@push('style')
    <!-- SPECIFIC CSS -->
    <link href="{{ asset("frontend/css/bootstrap_customized.min.css") }}" rel="stylesheet">
    <link href="{{ asset("frontend/css/style.css") }}" rel="stylesheet">
    <link href="{{ asset('css/detail-page.css') }}" rel="stylesheet">

    <style>
        .profile-image {
            width: 300px;
            height: 300px;
        }

        .holder {
            position: absolute;
            bottom: 0px;
        }

        .score_in {
            text-align: left !important;
        }

    </style>

    <style>
        .show {
            display: block !important;
        }

        .overlay__inner {
            position: fixed;
            top: 50%;
            left: 50%;
            /* bring your own prefixes */
            transform: translate(-50%, -50%);

            display: none;
            background-color: #ffffff7d;
            z-index: 99999;

            width: 100vw;
            height: 100vh;

        }


        .overlay__content {
            left: 50%;
            position: absolute;
            top: 50%;
            transform: translate(-50%, -50%);
        }

        .spinner {
            z-index: 99999;
            width: 75px;
            height: 75px;
            display: inline-block;
            border-width: 2px;
            border-color: rgba(255, 255, 255, 0.05);
            border-top-color: rgb(14, 13, 13);
            animation: spin 1s infinite linear;
            border-radius: 100%;
            border-style: solid;
        }

        @keyframes spin {
            100% {
                transform: rotate(360deg);
            }
        }

    </style>


@endpush

@section('main')
    <div class="container  margin_detail">

        <div class="page_header">
            <div class="breadcrumbs">
                <ul itemscope itemtype="http://schema.org/BreadcrumbList">
                    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                        <a itemprop="item" href="{{ route('homePage') }}">
                            <span itemprop="name">Home</span>
                        </a>
                    </li>
                    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                        <a itemprop="item" href="">
                            <span itemprop="name"> {{ $author->name ?? 'Author Name' }} </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col ">
                <div class="box_general">
                    <div class="main_info_wrapper flex flex-col items-start">
                        <div class="w-full flex justify-end items-center gap-2 md:gap-4 mb-6">
                            <img class="w-16 md:w-20 aspect-square mr-auto rounded-full object-cover" src="{{ $author?->avatar ? asset('photos/' . $author->avatar . '.webp') : asset('img/anonyms-avatar.png') }}">
                            @if (json_decode($author->author_data)?->twitter ?? null)
                                <a href="https://twitter.com/{{ json_decode($author->author_data)?->twitter ?? '#' }}"><img class="w-8 md:w-10 aspect-ratio" src="{{ asset('img/twitter_icon.svg') }}"></a>
                            @endif
                            
                            @if (json_decode($author->author_data)?->facebook ?? null)
                                <a href="https://facebook.com/{{ json_decode($author->author_data)?->facebook ?? '#' }}"><img class="w-8 md:w-10 aspect-ratio" src="{{ asset('img/facebook_icon.svg') }}"></a>
                            @endif
                            
                            @if (json_decode($author->author_data)?->instagram ?? null)
                                <a href="https://instagram.com/{{ json_decode($author->author_data)?->instagram ?? '#' }}"><img class="w-8 md:w-10 aspect-ratio" src="{{ asset('img/instagram_icon.svg') }}"></a>
                            @endif
                            
                            @if (json_decode($author->author_data)?->linkedin ?? null)
                                <a href="https://linkedin.com/in/{{ json_decode($author->author_data)?->linkedin ?? '#' }}"><img class="w-8 md:w-10 aspect-ratio" src="{{ asset('img/linkedin.svg') }}"></a>
                            @endif
                        </div>
                        <h4 class="text-xl mb-6 text-slate-600 font-medium">About Author</h4>
                        {!! json_decode($author->author_data)?->about ?? 'Hi I am self taught professional fullstack developer' !!}
                    </div>
                </div>
                
                <div class="w-full flex flex-col md:flex-row md:justify-center items-start md:flex-wrap md:gap-4">
                    @foreach ($subpages as $page)
                        <a href="{{ route('collegeDetail', ['college' => $page->college->slug]) }}" class="flex items-center justify-start md:w-96 rounded shadow h-20 bg-white pr-2 my-4 relative hover:bg-gray-100">
                            <img src="{{ asset('photos/'. $page->college->logo_path .'.webp') }}" class="w-12 h-10 rounded-full mx-3">
                            <div class="h-full w-full flex flex-col justify-start">
                                <p class="pt-2 text-sm" style="-webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; display: -webkit-box;">{{ $page->meta_title }}</p>
                                <p class="w-full text-gray-500 mt-2 text-right">{{ $page->updated_at->format('Y-M-d') }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
                
                <div class="w-full md:w-2/6 h-12 flex items-center justify-center bg-white text-white rounded-md shadow-md mt-8 md:mt-20 px-4 mx-auto">
                    
                    <a href="{{ $pageCount > 1 ? '?page=' . ($pageCount) : '' }}" class="mr-auto {{ $pageCount > 1 ? 'text-teal-500' : 'text-gray-500' }}"><i class="fa-solid fa-angle-left"></i></a>
                    
                    @if ((($pageCount + 1) / 5) > 1)
                        <a href="?page=1" class=" py-1 rounded-md hover:text-teal-500 text-slate-700">1</a>
                        <p class="px-3 py-1 rounded-md text-slate-600 text-lg">...</p>
                    @endif
                    
                    @for ($i = (floor($pageCount / 5) * 5); $i < (floor($pageCount / 5) * 5) + 5; $i++)
                        <p>{{ $i }}</p>
                        @if ($i < $maxPage)
                        
                            @if ($pageCount == $i)
                                <a class="px-3 py-1 rounded-md bg-teal-500 text-white">{{ $i + 1 }}</a>
                            @else
                                <a href="?page={{ $i + 1 }}" class="px-3 py-1 rounded-md hover:text-teal-500 text-slate-700">{{ $i + 1 }}</a>
                            @endif
                        @endif
                    @endfor
                    
                    @if ((($pageCount + 1) / $maxPage) < 1)
                        <p class="px-3 py-1 rounded-md text-slate-600 text-lg">...</p>
                        <a href="?page={{ $maxPage }}" class="py-1 rounded-md hover:text-teal-500 text-slate-700">{{ $maxPage }}</a>
                    @endif
  
                    <a href="{{ $pageCount < $maxPage ? '?page=' . ($pageCount + 2) : '' }}" class="ml-auto {{ $pageCount < $maxPage ? 'text-teal-500' : 'text-gray-500' }}"><i class="fa-solid fa-angle-right"></i></a>
                </div>
            </div>

        </div>

    </div>

@endsection
