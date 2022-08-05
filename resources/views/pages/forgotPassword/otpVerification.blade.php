

@extends('frontend::layouts.master',['title'=>'OTP Verfication'])

@push('style')
    <!-- SPECIFIC CSS -->
     <link href="{{asset('frontend/css/booking-sign_up.css')}}" rel="stylesheet">

     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

@endpush

@section('content')
<main class="bg_gray pattern">
    <div class="container margin_60_40">



        <div class="row justify-content-center">
            <div class="col-lg-4">

                @if (Session::has('success'))
                     <div class="alert alert-success">Check your email and enter OTP.</div>
                @else
                
                  <div class="alert alert-danger">{{ Session::get('error') }}</div>
                @endif
                <div class="box_booking_2">
                    <div class="head">
                        <div class="title">
                        <h3>OTP Verification</h3>

                    </div>
                    </div>
                    <!-- /head -->
                    <div class="main">
                        <form method="post" action={{ route('postOtpVerification') }}>
                            @csrf
                            <div class="sign-in-wrapper">
                                {{-- <a href="#0" class="social_bt facebook">Login with Facebook</a>
                                <a href="#0" class="social_bt google">Login with Google</a> --}}
                                {{-- <div class="divider"><span>Or</span></div> --}}
                                <div class="form-group">

                                    <input type="text" class="form-control" name="otp" id="otp" placeholder="Enter OTP" value="{{ old('otp') }}">

                                </div>
                                

                                <div class="text-center">
                                    <input type="submit" value="Submit" class="btn_1 full-width mb_5">

                                </div>



                            </div>

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













{{--  --}}
