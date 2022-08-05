@extends('layouts.master',[
    'title' => 'Apply Now',
    'meta_description' => '',
    'meta_keywords' => '',
    'faqs' => null
])


@push('style')
    <!-- SPECIFIC CSS -->
    <link href="{{ asset('frontend/css/booking-sign_up.css') }}" rel="stylesheet">

@endpush

@section('content')
    <main class="bg_gray pattern">
        <div class="container margin_60_40">
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    @if (Session::has('error'))
                        <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    @endif
                    <div class="box_booking_2">
                        <div class="head">
                            <div class="title">
                                <h3>Apply For {{ $college->name }}</h3>
                            </div>
                        </div>
                        <!-- /head -->
                        <div class="main bg-slate-50">
                            <form>
                                @csrf
                                <div class="sign-in-wrapper">

                                    <div class="form-groupn">
                                        <label>Contact Number</label>
                                        <input type="tel" class="form-control my-2" name="phone" id="phone" placeholder="Enter your phone number">
                                    </div>
                                    <div class="form-group my-2">
                                        <select name="course_id" class="form-control">
                                            <option selected disabled>Select Course you want to apply for.</option>
                                            @foreach ($college->courses as $course)
                                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="text-center my-4">
                                        <!--<input type="submit" value="Apply" class="w-full rounded-md py-2 bg-[#1f2f6a] text-white hover:bg-gray-600">-->
                                        <p class="w-full text-center mb-2 text-gray-600 font-semibold">Apply With</p>
                                        <button type="submit" formaction="{{ route('socialLogin', 'google') }}" class="my-4 w-full rounded-md shadow-md py-2 bg-white text-gray-700 flex justify-start items-center transition-shadow hover:shadow-none">
                                            <img class="ml-20 mr-8 w-[28px] sm:ml-24" src="{{ asset('img/Google__G__Logo.svg') }}">
                                            Google
                                        </button>
                                        <button class="my-4 w-full rounded-md shadow-md py-2 bg-[#4267B2] text-white flex justify-start items-center transition-shadow hover:shadow-none">
                                            <img class="ml-20 mr-8 w-[28px] sm:ml-24" src="{{ asset('img/facebook-logo-png-38362.jpg') }}">
                                            Facebook
                                        </button>
                                        <button class="my-4 w-full rounded-md shadow-md py-2 bg-white text-sky-400 flex justify-start items-center transition-shadow hover:shadow-none">
                                            <img class="ml-20 mr-8 w-[28px] sm:ml-24" src="{{ asset('img/twitter_icon.svg') }}">
                                            Twitter
                                        </button>
                                        <button class="my-4 w-full rounded-md shadow-md py-2 bg-white text-[#2867b2] flex justify-start items-center transition-shadow hover:shadow-none">
                                            <img class="ml-20 mr-8 w-[28px] sm:ml-24" src="{{ asset('img/linkedin.svg') }}">
                                            Linkedin
                                        </button>
                                        <button class="my-4 w-full rounded-md shadow-md py-2 bg-slate-400 text-black flex justify-start items-center transition-shadow hover:shadow-none">
                                            <img class="ml-20 mr-8 w-[28px] sm:ml-24" src="{{ asset('img/github_icon.svg') }}">
                                            Github
                                        </button>
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
