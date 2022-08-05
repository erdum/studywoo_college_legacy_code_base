@extends('frontend::layouts.master',['title'=>$college->name])

@push('style')

    <!-- SPECIFIC CSS -->
    <link href="{{ asset('frontend/css/review.css') }}" rel="stylesheet">
    <!-- SPECIFIC CSS -->

    <link href="{{ asset('frontend/css/detail-page.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('frontend/css/review.css') }}" rel="stylesheet"> --}}

    <!-- SPECIFIC CSS -->
    <link href="{{ asset('frontend/css/blog.css') }}" rel="stylesheet">

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

    <style>
        .content-pane {
            padding: 20px;
            text-align: justify
        }

        .content-pane>p {
            padding: 5px;
            text-align: justify;
            font-size: 16px
        }

        .inline span {
            margin-right: 20px
        }

        .inline-div {
            display: flex;
            flex-direction: row
        }

        .row {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .justify-content-between {
            -webkit-box-pack: justify !important;
            -ms-flex-pack: justify !important;
            justify-content: space-between !important;
        }

        .user_info {
            margin-left: 40px
        }

        .dot_list:not(:first-child):before {
            content: '';
            position: absolute;
            background-color: gray;
            padding: 2px;
            left: -3px;
            top: 50%;
            border-radius: 50%;
            -webkit-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
        }

        .arrow_carrot-right_alt2 {
            margin-left: 10px
        }

    </style>

    <style>
        .collapse:not(.show) {
            display: none !important;
        }

        .collapsing {
            height: 0;
            overflow: hidden;
            transition: height 0.35s ease;
        }

    </style>

    <style>
        .content {
            background: #fff;
            border-radius: 3px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.075), 0 2px 4px rgba(0, 0, 0, 0.0375);
            padding: 15px;
        }

        .panel-group {
            margin-bottom: 0;
        }

        .panel-group .panel {
            border-radius: 0;
            box-shadow: none;
        }

        .panel-group .panel .panel-heading {
            padding: 0;
        }

        .panel-group .panel .panel-heading h4 a {
            background: #f8f8f8;
            display: block;
            font-size: 14px;
            font-weight: bold;
            padding: 15px;
            text-decoration: none;
            transition: 0.15s all ease-in-out;
        }

        .panel-group .panel .panel-heading h4 a:hover,
        .panel-group .panel .panel-heading h4 a:not(.collapsed) {
            background: #fff;
            transition: 0.15s all ease-in-out;
        }

        .panel-group .panel .panel-heading h4 a:not(.collapsed) i:before {
            content: "";
        }

        .panel-group .panel .panel-heading h4 a i {
            color: #999;
        }

        .panel-group .panel .panel-body {
            padding-top: 0;
        }

        .panel-group .panel .panel-heading+.panel-collapse>.nav-tabs-group,
        .panel-group .panel .panel-heading+.panel-collapse>.panel-body {
            border-top: none;
        }

        .panel-group .panel+.panel {
            border-top: none;
            margin-top: 0;
        }

        .push-right {
            float: right;
            margin-top: 2px;
            margin-right: -6px;
        }

    </style>

    {{-- <style>
        .wrapper {
            position: relative;
            margin: 0 auto;
            overflow: hidden;
            padding: 5px;
            height: 50px;
        }



        .scroller {
            text-align: center;
            cursor: pointer;
            display: none;
            padding: 7px;
            padding-top: 11px;
            white-space: no-wrap;
            vertical-align: middle;
            background-color: #fff;
        }

        .scroller-right {
            float: right;
        }

        .scroller-left {
            float: left;
        }

    </style> --}}



    <style>
        .nav-scroller-wrapper {
            position: relative;
            overflow: hidden;
            padding: 15px 30px;
        }

        .nav-scroller {
            position: relative;
            overflow-x: auto;
            overflow-y: hidden;
            white-space: nowrap;
            font-size: 0;

            margin: auto;
        }

        .nav-scroller-content {
            position: relative;
            display: flex;
            justify-content: left;
            float: left;
            width: min-content;
            min-width: 100%;
            transition: transform 0.4s ease-in-out;
        }

        .no-transition {
            transition: none;
        }

        .nav-scroller-item {
            display: block;
            font-size: 1.125rem;
            text-transform: uppercase;
            text-align: left;
            padding: 0.5rem;
        }

        .nav-scroller-btn {
            position: absolute;
            top: 0;
            bottom: 0;
            padding-left: 4px;
            padding-right: 4px;
            font-size: 1.25rem;
            transition: opacity 0.3s;
        }

        .nav-scroller-btn:not(.active) {
            opacity: 0;
            pointer-events: none;
        }

        .nav-scroller-btn--left {
            left: 0;
        }

        .nav-scroller-btn--right {
            right: 0;
        }

        .fullwidth {
            /* padding: 5px 0; */
            /* margin: 15px 0; */
            background-color: #fff;
        }

        .btn-sm {
            width: 25px;
            height: 25px;
            margin: 25% -10%;
            margin: auto;
        }

    </style>


@endpush

@section('content')

    <main itemprop="mainEntity" itemscope itemtype="https://schema.org/CollegeOrUniversity">
        <div class="container-fluid  margin_detail">
            <div class="page_header">
                <div class="breadcrumbs">
                    <ul itemscope itemtype="http://schema.org/BreadcrumbList">
                        <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                            <a itemprop="item" href="{{ route('homePage') }}">
                                <span itemprop="name">Home</span>
                                <meta itemprop="position" content="1">
                            </a>


                        </li>
                        <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                            <a itemprop="item" href="{{ route('listingPage') }}">
                                <span itemprop="name">Listing</span>
                                <meta itemprop="position" content="2">
                            </a>


                        </li>
                        <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="active">
                            <a itemprop="item" class="active"
                                href="{{ route('collegeDetail', ['college' => $college->slug]) }}">
                                <span itemprop="name">{{ $college->name }}</span>
                                <meta itemprop="position" content="3">
                            </a>


                        </li>
                    </ul>
                </div>
            </div>
            <div class="row" style="margin-bottom: 0px">
                <div class="col-12">
                    <div class="box_general">
                        <div class="d-none d-sm-block">

                            <img itemprop="image" src="{{ asset($college->image ?? 'img/detail_placeholder.png') }}"
                                alt="" class="img-fluid" style="width: 100%; height:200px">
                        </div>
                        <div class="main_info_wrapper">
                            <div class="main_info clearfix" style="padding:20px 40px">

                                <div class="user_desc">
                                    <h3 itemprop="name">{{ $college->name }}</h3>
                                    <p>
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                        <span itemprop="address">
                                            {{ $college->state->name }} ,
                                            {{ $college->city->name }}
                                        </span>

                                    </p>

                                    <ul class="tags no_margin">
                                        @forelse ($college->courses as $course)
                                            <li><span class="link">{{ $course->name }}</span></li>
                                        @empty
                                        @endforelse
                                    </ul>
                                </div>
                                <div class="score_in">
                                    <div class="rating" itemprop="aggregateRating" itemscope
                                        itemtype="https://schema.org/AggregateRating">

                                        <meta itemprop="itemReviewed" content="{{ $college->name }}">
                                        <div class="score">
                                            <span> <b itemprop="reviewCount"> {{ $college->reviewCount }}
                                                </b><em>Reviews</em>
                                            </span>
                                            <strong itemprop="ratingValue">{{ $college->averageRating }}</strong>
                                            <meta itemprop="worstRating" content="{{ $college->worstRating }}" />
                                            <meta itemprop="bestRating" content="{{ $college->bestRating }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12" style="overflow: hidden;">
                    <div class="box_general " style="overflow: hidden;">
                        <section class="fullwidth">
                            <div>
                                <div class="nav-scroller-wrapper">
                                    <nav class="nav-scroller" style="margin:0px 20px;overflow-x: hidden;">
                                        <div class="nav-scroller-content">
                                            @forelse ($college->subPages ?? [] as $subPage)
                                                <a href="{{ route('collegeDetail', ['college' => $college->slug, 'page' => $subPage->slug]) }}"
                                                    class="nav-scroller-item nav-link {{ $page == $subPage->slug ? 'active' : '' }} tab-route"
                                                    data-url={{ $subPage->slug }}>{{ ucwords($subPage->title) }}</a>
                                            @empty
                                            @endforelse
                                        </div>
                                    </nav>
                                    <button class="btn btn-sm  nav-scroller-btn nav-scroller-btn--left"><svg class="icon "
                                            width="20" height="20" viewBox="0 0 21 32">
                                            <path
                                                d="M0 16l4.736-4.768 11.264-11.232 4.736 4.736-11.232 11.264 11.232 11.264-4.736 4.736-11.264-11.264z">
                                            </path>
                                        </svg>
                                    </button>

                                    <button class="btn btn-sm  nav-scroller-btn nav-scroller-btn--right"><svg class="icon "
                                            width="20" height="20" viewBox="0 0 21 32">
                                            <path
                                                d="M0 27.264l11.264-11.264-11.264-11.264 4.736-4.736 11.264 11.232 4.736 4.768-16 16z">
                                            </path>
                                        </svg>
                                    </button>

                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-9">
                    <div class="box_general">
                        <div class="tabs_detail">

                            <div class="tab-content" role="tablist">
                                <div class="overlay__inner">
                                    <div class="overlay__content"><span class="spinner"></span></div>
                                </div>

                                <div id="pane" class="card tab-pane fade show active content-pane" role="tabpanel"
                                    aria-labelledby="tab-A">
                                    {{-- <article itemscope itemtype="https://schema.org/Article">
                                        <meta itemprop="mainEntityOfPage"
                                            content="{{ route('collegeDetail', ['college' => $college->slug]) }}">
                                        <meta itemprop="name headline" content="{{ $college->name }}">

                                        <div>
                                            <div class="main_info_wrapper">
                                                <section itemprop="author" itemscope itemtype="https://schema.org/Person">
                                                    <div class="main_info clearfix">
                                                        <div class="user_thumb">
                                                            <figure>
                                                                <a href="{{ route('getAuthor', ['author' => $college->info_page->author->username]) }}"
                                                                    itemprop="url">
                                                                    <img itemprop="avatar"
                                                                        src="{{ asset($college->info_page->author->avatar) }}"
                                                                        alt="">
                                                                </a>
                                                            </figure>
                                                        </div>

                                                        <div class="row justify-content-between">

                                                            <div class="col">
                                                                <div class="score_in" style="">
                                                                    <div class="follow_us">
                                                                        <ul style="float: left">
                                                                            <li style="text-align: left;">
                                                                                <h5>
                                                                                    <a rel="author" itemprop="url" href="#"
                                                                                        title="View author biography"
                                                                                        href="{{ route('getAuthor', ['author' => $college->info_page->author->username]) }}">
                                                                                        <span
                                                                                            itemprop="name">{{ $college->info_page->author->full_name }}</span>
                                                                                    </a>
                                                                                    <small class=" text-muted small font-8">

                                                                                        <span itemprop="jobTitle"> Content
                                                                                            Creator
                                                                                        </span>
                                                                                        <meta itemprop="worksFor"
                                                                                            content="{{ SystemConfig::get('app-name') }}">
                                                                                        | Updated on -
                                                                                        <time
                                                                                            datetime="{{ $college->info_page->pageData->updated_at }}"
                                                                                            itemprop="dateModified">
                                                                                            {{ \Carbon\Carbon::parse($college->info_page->pageData->updated_at)->format('M d, Y') }}</time>
                                                                                        <meta itemprop="datePublished"
                                                                                            content="{{ $college->info_page->pageData->created_at }}">
                                                                                    </small>
                                                                                </h5>

                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="score_in">
                                                                    <div class="follow_us">
                                                                        <ul>
                                                                            @if ($college->info_page->author->facebook)
                                                                                <li>
                                                                                    <a
                                                                                        href="{{ asset($college->info_page->author->facebook) }}">
                                                                                        <img src="{{ asset('img/facebook_icon.svg') }}"
                                                                                            alt="" class="lazy">
                                                                                    </a>
                                                                                </li>
                                                                            @endif

                                                                            @if ($college->info_page->author->twitter)

                                                                                <li><a href="#0"><img
                                                                                            src="{{ asset('img/twitter_icon.svg') }}"
                                                                                            alt="" class="lazy"></a>
                                                                                </li>
                                                                            @endif

                                                                            @if ($college->info_page->author->instagram)
                                                                                <li><a href="#0"><img
                                                                                            src="{{ asset('img/instagram_icon.svg') }}"
                                                                                            alt="" class="lazy"></a>
                                                                                </li>
                                                                            @endif

                                                                            @if ($college->info_page->author->linkedin)
                                                                                <li><a href="#0"><img
                                                                                            src="{{ asset('img/linkedin.svg') }}"
                                                                                            alt="" class="lazy"></a>
                                                                                </li>
                                                                            @endif

                                                                            @if ($college->info_page->author->github)
                                                                                <li><a href="#0"><img
                                                                                            src="{{ asset('img/github.svg') }}"
                                                                                            alt="" class="lazy"></a>
                                                                                </li>
                                                                            @endif


                                                                            @if ($college->info_page->author->skype)
                                                                                <li><a href="#0"><img
                                                                                            src="{{ asset('img/skype.svg') }}"
                                                                                            alt="" class="lazy"></a>
                                                                                </li>
                                                                            @endif
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            </span>

                                                        </div>
                                                    </div>
                                                </section>
                                            </div>
                                        </div>
                                        <div itemprop="articleBody">
                                            {!! $college->info_page->pageData->content !!}
                                        </div>

                                        <span style="display: none" itemprop="publisher" itemscope
                                            itemtype="https://schema.org/Organization">
                                            <meta itemprop="name" content="{{ SystemConfig::get('app-name') }}">
                                            <span itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
                                                <meta itemprop="url" content="{{ url('/logo.png') }}">
                                                <meta itemprop="width" content="320">
                                                <meta itemprop="height" content="60">
                                            </span>
                                        </span>
                                    </article> --}}
                                </div>
                            </div>
                            <!-- /tab-content -->
                        </div>
                        <!-- /tabs_detail -->
                    </div>
                    <!-- /tabs_detail -->
                </div>
                <!-- /box_general -->
                <!-- /col -->
                <div class=" col-lg-3" id="sidebar_fixed">
                    <ul class="share-buttons">
                        <li><a class="fb-share"
                                href="https://www.facebook.com/share.php?u={{ url()->current() }}&title={{ $college->name }}"
                                target="blank"><i class="social_facebook"></i> Share</a></li>
                        <li><a class="twitter-share"
                                href="https://twitter.com/intent/tweet?status={{ $college->name }}+{{ url()->current() }}"
                                target="blank"><i class="social_twitter"></i> Share</a></li>
                        <li><a class="telegram-share"
                                href="https://t.me/share/url?url={{ url()->current() }}&text={{ $college->name }}"
                                target="blank"><i class="fab fa-telegram"></i> Share</a></li>
                        <li><a class="whatsapp-share" href="https://wa.me/1234567890/?text={{ url()->current() }}"
                                data-action="share/whatsapp/share" target="blank"><i class="fab fa-whatsapp"
                                    style=" font-size:14px"></i> Share</a>
                        </li>
                    </ul>

                    <div class="box_general">
                        <h5 class="text-center" style="padding: 10px">Students Also Visit</h5>
                    </div>

                    @foreach ($college->getRelatedCollege() as $collegeDetail)
                        @if ($collegeDetail->slug != $college->slug)
                            <div class="review_card box_general">
                                <div class="row">
                                    <div class="main_info clearfix">
                                        <div class="row">
                                            <div class="user_info" style="text-align: left !important">

                                                <figure>
                                                    <img class="inline"
                                                        src="{{ asset($collegeDetail->logo ?? 'img/lazy-placeholder.png') }}"
                                                        alt="{{ $college->name }}" />
                                                </figure>
                                            </div>
                                            <div class="col">
                                                <div class="holder">
                                                    <div class="user_desc">
                                                        <h6>
                                                            <a
                                                                href="{{ route('collegeDetail', ['college' => $collegeDetail->slug]) }}">
                                                                {{ $collegeDetail->name }}</a>
                                                        </h6>
                                                        <p>
                                                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                            <span itemprop="address">
                                                                <a
                                                                    href="{{ route('filterCollege', ['filter1' => $college->state->slug]) }}">{{ $college->state->name }}</a>
                                                                ,
                                                                <a
                                                                    href="{{ route('filterCollege', ['filter1' => $college->city->slug]) }}">
                                                                    {{ $college->city->name }}</a>
                                                            </span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endif

                        <!-- /row -->

                    @endforeach



                </div>

            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add Comment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="{{ route('saveComment') }}">
                        <div class="modal-body">
                            @csrf
                            <input type="text" value="{{ $college->id }}" name="college_id" hidden>
                            <textarea name="comment" class="form-control"></textarea>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- /container -->

    </main>



@endsection


@push('script')
    {{-- <script src="{{ asset('frontend/js/specific_review.js') }}"></script> --}}
    <script>
        var slug = "{{ $college->slug }}";

        function loadDoc(url) {
            console.log("load")
            url = url.split("/info")[0]
            $(".overlay__inner").addClass("show");
            $.ajax({
                url,
                type: 'GET', // http method
                success: function(data, status, xhr) {
                    $("#pane").empty();
                    $('#pane').append(data);
                    $(".overlay__inner").removeClass("show");
                },
                error: function(jqXhr, textStatus, errorMessage) {
                    $(".overlay__inner").removeClass("show");


                }
            });
        }

        console.log(window.location.href, "{{ route('collegeDetail', ['college' => $college->slug]) }}")
        if (window.location.href != "{{ route('collegeDetail', ['college' => $college->slug]) }}")
            window.onLoad = loadDoc(window.location.href)
        // window.addEventListener("load", loadDoc(window.location.href));
        $(document).on('click', '.tab-route', function(e) {
            e.preventDefault();
            $('.tab-route.active').removeClass("active")
            $(this).addClass("active")
            loadDoc($(this).attr('href'));
            goTo("", "", $(this).attr('href'));
        })

        function goTo(page, title, url) {
            url = url.replace("/info", "")
            if ("undefined" !== typeof history.pushState) {
                history.pushState({
                    page: page
                }, title, url);
            } else {
                window.location.assign(url);
            }
        }
    </script>

    {{-- <script>
        var hidWidth;
        var scrollBarWidths = 40;

        var widthOfList = function() {
            var itemsWidth = 0;
            $('.nav-tabs li').each(function() {
                var itemWidth = $(this).outerWidth();
                itemsWidth += itemWidth;
            });
            return itemsWidth;
        };
 $(document).on('scroll', '.college-list-container' , function() {
            let div = $(this).get(0);
            if (div.scrollTop + div.clientHeight >= div.scrollHeight) {
                // do the lazy loading here
                alert("loadmore")
            }
        });
        var widthOfHidden = function() {
            return (($('.wrapper').outerWidth()) - widthOfList() - getLeftPosi()) - scrollBarWidths;
        };

        var getLeftPosi = function() {
            return $('.nav-tabs').position().left;
        };

        var reAdjust = function() {
            if (($('.wrapper').outerWidth()) < widthOfList()) {
                $('.scroller-right').show();
            } else {
                $('.scroller-right').hide();
            }

            if (getLeftPosi() < 0) {
                $('.scroller-left').show();
            } else {
                $('.item').animate({
                    left: "-=" + getLeftPosi() + "px"
                }, 'slow');
                $('.scroller-left').hide();
            }
        }

        reAdjust();

        $(window).on('resize', function(e) {
            reAdjust();
        });

        $('.scroller-right').click(function() {
            console.log(widthOfHidden())
            $('.scroller-left').fadeIn('slow');
            $('.scroller-right').fadeOut('slow');

            $('.nav-tabs').animate({
                left: "+=" + widthOfHidden() + "px"
            }, 'slow', function() {

            });
        });

        $('.scroller-left').click(function() {

            $('.scroller-right').fadeIn('slow');
            $('.scroller-left').fadeOut('slow');

            $('.nav-tabs').animate({
                left: "-=" + getLeftPosi() + "px"
            }, 'slow', function() {

            });
        });
    </script> --}}


@endpush

@push('script')
    <!-- SPECIFIC SCRIPTS -->
    <script src="{{ asset('frontend/js/specific_review.js') }}"></script>




    <script>
        const navScroller = function({
            wrapperSelector: wrapperSelector = '.nav-scroller-wrapper',
            selector: selector = '.nav-scroller',
            contentSelector: contentSelector = '.nav-scroller-content',
            buttonLeftSelector: buttonLeftSelector = '.nav-scroller-btn--left',
            buttonRightSelector: buttonRightSelector = '.nav-scroller-btn--right',
            scrollStep: scrollStep = 75
        } = {}) {

            let scrolling = false;
            let scrollingDirection = '';
            let scrollOverflow = '';
            let timeout;

            let navScrollerWrapper;

            if (wrapperSelector.nodeType === 1) {
                navScrollerWrapper = wrapperSelector;
            } else {
                navScrollerWrapper = document.querySelector(wrapperSelector);
            }
            if (navScrollerWrapper === undefined || navScrollerWrapper === null) return;

            let navScroller = navScrollerWrapper.querySelector(selector);
            let navScrollerContent = navScrollerWrapper.querySelector(contentSelector);
            let navScrollerLeft = navScrollerWrapper.querySelector(buttonLeftSelector);
            let navScrollerRight = navScrollerWrapper.querySelector(buttonRightSelector);


            // Sets overflow
            const setOverflow = function() {
                scrollOverflow = getOverflow(navScrollerContent, navScroller);
                toggleButtons(scrollOverflow);
            }


            // Debounce setting the overflow with requestAnimationFrame
            const requestSetOverflow = function() {
                if (timeout) {
                    window.cancelAnimationFrame(timeout);
                }

                timeout = window.requestAnimationFrame(() => {
                    setOverflow();
                });
            }


            // Get overflow value on scroller
            const getOverflow = function(content, container) {
                let containerMetrics = container.getBoundingClientRect();
                let containerWidth = containerMetrics.width;
                let containerMetricsLeft = Math.floor(containerMetrics.left);

                let contentMetrics = content.getBoundingClientRect();
                let contentMetricsRight = Math.floor(contentMetrics.right);
                let contentMetricsLeft = Math.floor(contentMetrics.left);

                // Offset the values by the left value of the container
                let offset = containerMetricsLeft;
                containerMetricsLeft -= offset;
                contentMetricsRight -= offset + 1; // Due to an off by one bug in iOS
                contentMetricsLeft -= offset;

                // console.log (containerMetricsLeft, contentMetricsLeft, containerWidth, contentMetricsRight);

                if (containerMetricsLeft > contentMetricsLeft && containerWidth < contentMetricsRight) {
                    return 'both';
                } else if (contentMetricsLeft < containerMetricsLeft) {
                    return 'left';
                } else if (contentMetricsRight > containerWidth) {
                    return 'right';
                } else {
                    return 'none';
                }
            }


            // Move the scroller with a transform
            const moveScroller = function(direction) {
                if (scrolling === true) return;

                setOverflow();

                let scrollDistance = scrollStep;
                let scrollAvailable;


                if (scrollOverflow === direction || scrollOverflow === 'both') {

                    if (direction === 'left') {
                        scrollAvailable = navScroller.scrollLeft;
                    }

                    if (direction === 'right') {
                        let navScrollerRightEdge = navScroller.getBoundingClientRect().right;
                        let navScrollerContentRightEdge = navScrollerContent.getBoundingClientRect().right;

                        scrollAvailable = Math.floor(navScrollerContentRightEdge - navScrollerRightEdge);
                    }

                    // If there is less that 1.5 steps available then scroll the full way
                    if (scrollAvailable < (scrollStep * 1.5)) {
                        scrollDistance = scrollAvailable;
                    }

                    if (direction === 'right') {
                        scrollDistance *= -1;
                    }

                    navScrollerContent.classList.remove('no-transition');
                    navScrollerContent.style.transform = 'translateX(' + scrollDistance + 'px)';

                    scrollingDirection = direction;
                    scrolling = true;
                }

            }


            // Set the scroller position and removes transform, called after moveScroller()
            const setScrollerPosition = function() {
                var style = window.getComputedStyle(navScrollerContent, null);
                var transform = style.getPropertyValue('transform');
                var transformValue = Math.abs(parseInt(transform.split(',')[4]) || 0);

                if (scrollingDirection === 'left') {
                    transformValue *= -1;
                }

                navScrollerContent.classList.add('no-transition');
                navScrollerContent.style.transform = '';
                navScroller.scrollLeft = navScroller.scrollLeft + transformValue;
                navScrollerContent.classList.remove('no-transition');

                scrolling = false;
            }


            // Toggle buttons depending on overflow
            const toggleButtons = function(overflow) {
                navScrollerLeft.classList.remove('active');
                navScrollerRight.classList.remove('active');

                if (overflow === 'both' || overflow === 'left') {
                    navScrollerLeft.classList.add('active');
                }

                if (overflow === 'both' || overflow === 'right') {
                    navScrollerRight.classList.add('active');
                }
            }


            const init = function() {

                // Determine scroll overflow
                setOverflow();

                // Scroll listener
                navScroller.addEventListener('scroll', () => {
                    requestSetOverflow();
                });

                // Resize listener
                window.addEventListener('resize', () => {
                    requestSetOverflow();
                });

                // Button listeners
                navScrollerLeft.addEventListener('click', () => {
                    moveScroller('left');
                });

                navScrollerRight.addEventListener('click', () => {
                    moveScroller('right');
                });

                // Set scroller position
                navScrollerContent.addEventListener('transitionend', () => {
                    setScrollerPosition();
                });

            };

            // Init is called by default
            init();


            // Reveal API
            return {
                init
            };
        };

        const navScrollerTest = navScroller();
    </script>
@endpush
