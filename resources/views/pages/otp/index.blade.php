@extends('frontend::layouts.master',['title'=>"OTP Verification"])

@push('style')
<!-- SPECIFIC CSS -->
<link href="{{asset('frontend/css/booking-sign_up.css')}}" rel="stylesheet">

<!-- SPECIFIC CSS -->
<link href="{{  asset('frontend/css/account.css')  }}" rel="stylesheet">

<!-- YOUR CUSTOM CSS -->
<link href="{{ asset('frontend/css/custom.css' )}}" rel="stylesheet">
<style>
    .alert {
        text-align: center;
        padding: 15px;
        color: white;
        margin-bottom: 20%;
    }

    .alert-success {
        background-color: skyblue;
    }

    .alert-danger {
        background-color: rgb(243, 65, 65);
    }

</style>

@endpush

@push('script')
<!-- SPECIFIC SCRIPTS -->
<script src="{{ asset('frontend/js/pw_strenght.js') }}"></script>

<script src="{{ asset('frontend/js/common_func.js') }}"></script>
@endpush

@section('content')
<main class="bg_gray pattern">
    <div class="container margin_60_40">
        <div class="page_header">
            <div class="breadcrumbs">
                <ul itemscope itemtype="http://schema.org/BreadcrumbList">
                    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                        <a itemprop="item" href="{{ route('homePage') }}">
                            <span itemprop="name">Home</span></a>
                        {{-- <meta itemprop="position" content="1" /> --}}
                    </li>
                    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                        <a itemprop="item" href="{{ route('otp') }}">
                            <span itemprop="name">OTP</span></a>

                    </li>

                </ul>
            </div>
        </div>

        <div class="row justify-content-center">

            <div class="col-lg-4">
                <div class="box_booking_2">
                    <div class="head">
                        <div class="title">
                            <h3>OTP Verification</h3>

                        </div>
                    </div>
                    <!-- /head -->
                    <div class="main">
                        <form method="post" action="{{ route('verifyOTP') }}">
                            @if (Session::has('success'))
                                <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
                            @elseif (Session::has('error'))
                                <div class="alert alert-danger" role="alert">{{ Session::get('error') }}</div>
                            @endif

                            @csrf
                            <div class="form-group">
                                <input class="form-control" name="code" type="text" placeholder="Enter OTP code">
                                <i class="icon_pencil-edit"></i>
                            </div>
                            <div id="pass-info" class="clearfix"></div>
                            <button type="submit" class="btn_1 rounded full-width">Submit</button>

                        </form>
                    </div>
                </div>
                <!-- /box_booking -->
            </div>
            <!-- /col -->

        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</main>
@endsection













{{-- --}}
