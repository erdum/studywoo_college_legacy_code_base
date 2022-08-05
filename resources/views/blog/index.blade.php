<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>Philosophy</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="{{ asset('blog-assets/css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('blog-assets/css/vendor.css') }}">
    <link rel="stylesheet" href="{{ asset('blog-assets/css/main.css') }}">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- script
    ================================================== -->
    <script src="{{ asset('blog-assets/js/modernizr.js') }}"></script>
    <script src="{{ asset('blog-assets/js/pace.min.js') }}"></script>

    <!-- favicons
    ================================================== -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body id="top">

    <header class="sm:hidden w-full h-16 bg-teal-500 flex items-center justify-center relative">
        <i class="fa-solid fa-bars absolute right-0 p-4 text-2xl text-white" onclick="openMobMenu()"></i>
        <img alt="Studywoo logo" class="h-12" src="https://college.studywoo.com/logo.png">
    </header>
	
	<header class="hidden sm:flex overflow-hidden w-full h-16 bg-teal-500 text-white text-lg font-medium items-stretch justify-end shadow-md">
        <img class="mr-auto ml-8 my-2" loading="lazy" src="https://college.studywoo.com/logo.png" alt="Studywoo logo">
        <a class="flex items-center px-6 hover:text-teal-500 hover:bg-white" href="/">Home</a>
        <a class="flex items-center px-6 hover:text-teal-500 hover:bg-white" href="{{ route('listingPage') }}">Listing</a>
        @foreach (['Engineering', 'Medical', 'Science', 'Commerce', 'Arts'] as $stream)
        <nav class="group mx-4 hover:text-teal-500 hover:bg-white">
            <button class="h-full px-2 font-medium">
                {{ $stream }} <i class="fa-solid fa-caret-down"></i>
            </button>
            <section class="hidden overflow-y-auto group-hover:block w-full h-[45vh] absolute left-0 z-10 bg-slate-100 shadow-lg">
                <div class="w-full h-16 bg-white text-xl font-normal pl-10 flex items-stretch">
                    <h2 class="flex items-center">{{ $stream }} Colleges</h2>
                </div>
                <div class="w-full flex items-stretch justify-evenly text-gray-500 text-xs font-normal">
                    <div class="flex flex-col item-stretch justify-start">
                        <h4 class="my-4 font-medium text-sm text-orange-400">Colleges by course</h4>
                        @foreach (Modules\College\Entities\College::getCollegesWithFilters('course', $stream) as $item)
                        <a class="py-1 hover:text-orange-500" href="{{ '/listing/stream=' . $stream . '&course=' . $item->name ?? '' }}">{{ $item->name }}</a>
                        @endforeach
                    </div>
                </div>
            </section>
        </nav>        
        @endforeach
    </header>

    <section class="s-content">
        
        <div class="row masonry-wrap">
            <div class="masonry">

                <div class="grid-sizer"></div>

                @foreach ($posts as $post)
                
                <article class="masonry__brick entry format-gallery" data-aos="fade-up">
                        
                    <div class="entry__thumb slider">
                        <div class="slider__slides">
                            @foreach (json_decode($post->cover_image) as $image)
                                <div class="slider__slide">
                                    <img src="{{ $image }}" alt=""> 
                                </div>
                            @endforeach
                        </div>
                    </div>
    
                    <div class="entry__text">
                        <div class="entry__header">
                            
                            <div class="entry__date">
                                <a href="{{ 'blog/' . $post->slug }}">{{ $post->created_at->format('d M Y') }}</a>
                            </div>
                            <h1 class="entry__title"><a href="{{ 'blog/' . $post->slug }}">{{ $post->title }}</a></h1>
                            
                        </div>
                        <div class="entry__excerpt">
                            <p>
                                {{ $post->meta_description }}
                            </p>
                        </div>
                        <div class="entry__meta">
                            <span class="entry__meta-links">
                                <a href="{{ 'blog/' . lcfirst($post->category) }}">{{ $post->category }}</a> 
                            </span>
                        </div>
                    </div>
    
                </article> <!-- end article -->
                
                @endforeach

            </div> <!-- end masonry -->
        </div> <!-- end masonry-wrap -->

        <div class="row">
            <div class="col-full">
                <nav class="pgn">
                    <ul>
                        @if ($current_page > 1)
                        
                            <li><a class="pgn__prev" href="{{ $current_page - 1 }}">Prev</a></li>
                            
                        @endif
                        
                        @if ($numof_posts >= $tab)
                        
                            @for ($i = ($tab - $per_page + 1); $i <= $tab; $i++)
                            
                                @if ($i == $current_page)
                            
                                    <li><span class="pgn__num current">{{ $i }}</span></li>
                                    
                                @else
                                
                                    <li><a class="pgn__num" href="{{ $i }}">{{ $i }}</a></li>
                                    
                                @endif
                                
                            @endfor
                            
                            <li><span class="pgn__num dots">…</span></li>
                            <li><a class="pgn__num" href="{{ $tab + 1 }}">{{ $tab + 1 }}</a></li>
                            
                        @else 
                        
                            @for ($i = ($tab - $per_page + 1); $i <= $numof_posts; $i++)
                            
                                @if ($i == $current_page)
                            
                                    <li><span class="pgn__num current">{{ $i }}</span></li>
                                    
                                @else
                                
                                    <li><a class="pgn__num" href="{{ $i }}">{{ $i }}</a></li>
                                    
                                @endif
                                
                            @endfor
                        
                        @endif
                        
                        @if($current_page < $numof_posts)
                        
                            <li><a class="pgn__next" href="{{ $current_page + 1 }}">Next</a></li>
                            
                        @endif
                    </ul>
                </nav>
            </div>
        </div>

    </section> <!-- s-content -->

    <!-- preloader
    ================================================== -->
    <div id="preloader">
        <div id="loader">
            <div class="line-scale">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>


    <!-- Java Script
    ================================================== -->
    <script src="{{ asset('blog-assets/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('blog-assets/js/plugins.js') }}"></script>
    <script src="{{ asset('blog-assets/js/main.js') }}"></script>

</body>

</html>