@extends('admin::layout.auth',['page_name'=>"Login"])



@section('content')
    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-pattern">

                        <div class="card-body p-4">

                            <div class="text-center w-75 m-auto">
                                <div class="auth-logo">
                                    <a href="{{ route('homePage') }}" class="logo logo-dark text-center">
                                        <span class="logo-lg">
                                            <img src="{{ asset('logo.png') }}" alt="" height="22">
                                        </span>
                                    </a>

                                    <a href="{{ route('homePage') }}" class="logo logo-light text-center">
                                        <span class="logo-lg">
                                            <img src="{{ asset('logo.png') }}}" alt="" height="22">
                                        </span>
                                    </a>
                                </div>
                                <p class="text-muted mb-4 mt-3">Enter your email address and password to access admin
                                    panel.</p>
                            </div>

                            <form action="{{ route('admin.auth.postLogin') }}" method="POST">
                                @if (Session::has('err-message'))
                                    <div class="alert alert-danger">
                                        <div class="text-center">
                                            <span class="text-danger text-center">
                                                {{ Session::get('err-message') }}
                                            </span>
                                        </div>
                                    </div>
                                @endif


                                @csrf
                                <div class="form-group mb-3">
                                    <label for="emailaddress">Email address</label>
                                    <input class="form-control" type="email" name="email" id="emailaddress" required=""
                                        placeholder="Enter your email">


                                </div>

                                <div class="form-group mb-3">
                                    <label for="password">Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" name="password" class="form-control"
                                            placeholder="Enter your password">
                                        <div class="input-group-append" data-password="false">
                                            <div class="input-group-text">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-0 text-center">
                                    <button class="btn btn-primary btn-block" type="submit"> Log In </button>
                                </div>

                            </form>



                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <p> <a href="{{ route('admin.auth.getForgotPassword') }}" class="text-white-50 ml-1">Forgot
                                    your
                                    password?</a></p>
                            <p class="text-white-50">Don't have an account? <a href="{{ route('admin.auth.register') }}"
                                    class="text-white ml-1"><b>Sign Up</b></a></p>
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
@endsection
