@extends('frontend::layouts.master',['title'=>"Review"])

@push('style')

    <!-- SPECIFIC CSS -->
    <link href="{{ asset('frontend/css/review.css') }}" rel="stylesheet">
    <!-- SPECIFIC CSS -->

    <link href="{{ asset('frontend/css/detail-page.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('frontend/css/review.css') }}" rel="stylesheet"> --}}

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


@endpush

@section('content')


    <div class="container-fluid  margin_detail">
        <div class="page_header">
            <div class="breadcrumbs">
                <ul itemscope itemtype="http://schema.org/BreadcrumbList">
                    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                        <a itemprop="item" href="{{ route('homePage') }}">
                            <span itemprop="name">Home</span></a>
                        {{-- <meta itemprop="position" content="1" /> --}}
                    </li>
                    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                        <a itemprop="item" href="{{ route('listingPage') }}">
                            <span itemprop="name">College Name</span></a>

                    </li>
                    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                        <a itemprop="item" href="{{ route('listingPage') }}">
                            <span itemprop="name">Review Subpage</span></a>

                    </li>
                    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="active">
                        <a itemprop="item" class="active" href="#">
                            <span itemprop="name"> Review of name for name</span></a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card-body reviews">
                    <div class="box_general" style="padding: 20px">
                        <div class="row add_bottom_45 d-flex align-items-center">
                            <div class="col-md-3">
                                <div id="review_summary">
                                    <strong>{{ $review->average_rating }}</strong>

                                </div>
                            </div>
                            <div class="col-md-9 reviews_sum_details">

                                <div class="row">
                                    <div class="col-md-4">
                                        <h6>Faculty</h6>
                                        <div class="row">
                                            <div class="col-xl-10 col-lg-9 col-9">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: {{ $review->faculty * 10 }}%"
                                                        aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-lg-3 col-3"><strong>{{ $review->faculty }}</strong></div>
                                        </div>
                                        <!-- /row -->
                                        <h6>Placement</h6>
                                        <div class="row">
                                            <div class="col-xl-10 col-lg-9 col-9">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: {{ $review->placement * 10 }}%"
                                                        aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-lg-3 col-3"><strong>{{ $review->placement }}</strong></div>
                                        </div>
                                        <!-- /row -->
                                    </div>
                                    <div class="col-md-4">
                                        <h6>Social Life</h6>
                                        <div class="row">
                                            <div class="col-xl-10 col-lg-9 col-9">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: {{ $review->social_life * 10 }}%"
                                                        aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-lg-3 col-3"><strong>{{ $review->social_life }}</strong></div>
                                        </div>
                                        <!-- /row -->
                                        <h6>Internship</h6>
                                        <div class="row">
                                            <div class="col-xl-10 col-lg-9 col-9">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: {{ $review->internship * 10 }}%"
                                                        aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-lg-3 col-3"><strong>{{ $review->internship }}</strong></div>
                                        </div>
                                        <!-- /row -->
                                    </div>

                                    <div class="col-md-4">
                                        <h6>Interview</h6>
                                        <div class="row">
                                            <div class="col-xl-10 col-lg-9 col-9">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: {{ $review->interview * 10 }}%"
                                                        aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-lg-3 col-3"><strong>{{ $review->interview }}</strong></div>
                                        </div>
                                        <!-- /row -->
                                        <h6>Hostel</h6>
                                        <div class="row">
                                            <div class="col-xl-10 col-lg-9 col-9">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: {{ $review->hostel * 10 }}%"
                                                        aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-lg-3 col-3"><strong>{{ $review->hostel }}</strong></div>
                                        </div>
                                        <!-- /row -->
                                    </div>

                                    <div class="col-md-4">
                                        <h6>Course</h6>
                                        <div class="row">
                                            <div class="col-xl-10 col-lg-9 col-9">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: {{ $review->course * 10 }}%"
                                                        aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-lg-3 col-3"><strong>{{ $review->course }}</strong></div>
                                        </div>

                                    </div>
                                </div>
                                <!-- /row -->
                            </div>
                        </div>
                    </div>
                    <div class="" id="reviews">
                        <div class="review_card box_general">
                            <div class="row">
                                <div class="main_info clearfix">
                                    <div class="row">
                                        <div class="user_info" style="text-align: left !important">
                                            <figure><img class="inline"
                                                    src="{{ asset($review->customer->customerDetail->avatar) }}"
                                                    alt="{{ $review->customer->customerDetail->full_name }}">
                                            </figure>
                                        </div>
                                        <div class="col">
                                            <div class="holder">
                                                <div class="user_desc">
                                                    <h5> {{ $review->customer->customerDetail->full_name }}</h5>
                                                    <h6> {{ Str::limit($review->created_at,11,'') }}</h6>
                                                    {{-- <p> <a href="mailto:{{ $author->email }}"> {{ $author->email }} </a> </p> --}}
                                                </div>
                                                <div class="score_in">
                                                    <div class="follow_us">



                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 review_content">
                                    <h4>{{ $review->title }}</h4>
                                    {!! $review->description !!}
                                </div>
                            </div>
                            <!-- /row -->
                        </div>
                        <!-- /review_card -->
                    </div>
                    <!-- /reviews -->
                </div>
            </div>
            <div class="col-lg-4">

                <div class="box_general">
                    <div class="card" style="background-color: #1f2f6a !important">
                        <div class="card-header">
                            <h5 class="text-center text-white" style="padding-top:10px">Related Reviews</h5>
                        </div>
                    </div>
                </div>

                <div id="reviews">
                    @foreach ($review->getRelatedReview(3) as $item)
                        <div class="review_card">
                            <div class="row">
                                <div class="main_info clearfix">
                                    <div class="row">
                                        <div class="user_info" style="text-align: left !important">
                                            <figure><img class="inline"
                                                    src="{{ asset($review->customer->customerDetail->avatar) }}"
                                                    alt="{{ $review->customer->customerDetail->full_name }}">
                                            </figure>
                                        </div>
                                        <div class="col">
                                            <div class="holder">
                                                <div class="user_desc">
                                                    <h5> {{ $review->customer->customerDetail->full_name }}</h5>
                                                    {{-- <p> <a href="mailto:{{ $author->email }}"> {{ $author->email }} </a> </p> --}}
                                                </div>
                                                <div class="score_in">
                                                    <div class="follow_us">
                                                        <ul class="dot_list" style="display: inline-block">
                                                            <li>
                                                                Batch 2024
                                                            </li>
                                                            <li>
                                                                MBBS, M.B.B.S.
                                                            </li>
                                                            <li>
                                                                July 22, 2021
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 review_content">
                                    <div class="clearfix add_bottom_15">
                                        <span class="rating float-right">{{ $review->average_rating }}<small>/10</small>
                                            <strong>Rating
                                                average</strong></span>
                                    </div>
                                    <h6>{{ $review->title }}</h6>
                                    {!! $review->description !!}
                                    <ul>
                                        <li><a href="#0"><span>Readmore</span><i class="arrow_carrot-right_alt2"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /row -->
                        </div>
                    @endforeach

                    <!-- /review_card -->

                </div>
            </div>

        </div>
    </div>

@endsection
