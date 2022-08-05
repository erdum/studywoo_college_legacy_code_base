@extends('frontend::layouts.master')

@push('style')
    <!-- SPECIFIC CSS -->
     <link href="{{asset('frontend/css/booking-sign_up.css')}}" rel="stylesheet">

      <!-- SPECIFIC CSS -->
    <link href="{{  asset('frontend/css/account.css')  }}" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="{{ asset('frontend/css/custom.css' )}}" rel="stylesheet">




@endpush

@push('script')

    <!-- SPECIFIC SCRIPTS -->
	<script src="{{ asset('frontend/js/pw_strenght.js') }}"></script>

    <script src="{{ asset('frontend/js/common_func.js') }}"></script>
@endpush

@section('content')
<main class="bg_gray pattern">
    <div class="container margin_60_40">

        <div class="row justify-content-center">
            <div class="col-lg-4">
                @if (Session::has('error'))
                <div class="alert">{{ Session::get('error') }}</div>
                @endif
                <div class="box_booking_2">
                    <div class="head">
                        <div class="title">
                        <h3>Register</h3>

                    </div>
                    </div>
                    <!-- /head -->
                    <div class="main">
                        <form method="post" action="{{ route('postRegister') }}">
                            @csrf
                            <div class="form-group">
                                <input class="form-control" name="first_name" type="text" placeholder="First Name">
                                <i class="icon_pencil-edit"></i>
                            </div><br/>
                            <div class="form-group">
                                <input class="form-control" name="last_name" type="text" placeholder="Last Name">
                                <i class="icon_pencil-edit"></i>
                            </div><br/>
                            <div class="form-group">
                                <input class="form-control" name="email" type="email" placeholder="Email">
                                <i class="icon_mail_alt"></i>
                            </div><br/>
                            <div class="form-group">
                                <input class="form-control" name="password" type="password" id="password1" placeholder="Password">
                                <i class="icon_lock_alt"></i>
                            </div><br/>
                            <div class="form-group">
                                <input class="form-control" name="c_password" type="password" id="password2"
                                    placeholder="Confirm Password">
                                <i class="icon_lock_alt"></i>
                            </div><br/>
                            <div id="pass-info" class="clearfix"></div>
                            <button type="submit" class="btn_1 rounded full-width">Register Now!</button>
                            <div class="text-center add_top_10">Already have an acccount? <strong><a href="{{ route('login') }}">Sign
                                        In</a></strong></div>
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














