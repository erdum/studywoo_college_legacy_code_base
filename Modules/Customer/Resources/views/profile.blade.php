@extends('customer::index')

@push('style')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
          integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <style>
        .stepwizard-step p {
            margin-top: 0px;
            color: #666;
        }

        .stepwizard-row {
            display: table-row;
        }

        .stepwizard {
            display: table;
            width: 100%;
            position: relative;
        }

        .stepwizard-step button[disabled] {
            /*opacity: 1 !important;
        filter: alpha(opacity=100) !important;*/
        }

        .stepwizard .btn.disabled,
        .stepwizard .btn[disabled],
        .stepwizard fieldset[disabled] .btn {
            opacity: 1 !important;
            color: #bbb;
        }

        .stepwizard-row:before {
            top: 14px;
            bottom: 0;
            position: absolute;
            content: " ";
            width: 100%;
            height: 1px;
            background-color: #ccc;
            z-index: 0;
        }

        .stepwizard-step {
            display: table-cell;
            text-align: center;
            position: relative;
        }

        .btn-circle {
            width: 30px;
            height: 30px;
            text-align: center;
            padding: 6px 0;
            font-size: 12px;
            line-height: 1.428571429;
            border-radius: 15px;
        }

        .form-group {
            padding: 10px;
            border: 2px solid #c7c7c7;
            margin: 10px;
        }

        .form-group > label {
            position: absolute;
            top: -1px;
            left: 40px;
            background-color: #f8f9fa;
            padding: 0px 5px;
        }

        .form-group > input {
            border: none;
            background-color: #f8f9fa;
        }

        .form-group > input:focus {
            border: none;
            background-color: #f8f9fa;
        }

        .form-group > textarea {
            background-color: #f8f9fa !important;
            border: none;
        }

        .form-group > select {
            background-color: #f8f9fa !important;
            border: none;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">


        <div class="stepwizard">
            <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step col-xs-3">
                    <a href="/profile" type="button" class="btn  @if ($step==1) btn-success @else btn-default @endif btn-circle">1</a>
                    <p><small>Basic</small></p>
                </div>
                <div class="stepwizard-step col-xs-3">
                    <a href="/profile?step=2" type="button" class="btn @if ($step==2) btn-success @else btn-default @endif btn-circle">2</a>
                    <p><small>Educational</small></p>
                </div>
            </div>
        </div>


        @if ($step ==1)
            <div class="box_general padding_bottom">
                <div class="header_box version_2">
                    <h2><i class="fa fa-user"></i>Basic details</h2>
                </div>
                <form name="bio" method="POST" action="{{ route('userBasicData') }}" enctype="multipart/form-data">

                    @csrf

                    <div class="row d-flex flex-row justify-content-center">

                        <div class="col-lg-8 col-md-8 col-sm-12 col-12 add_top_30 bg-light shadow">
                            <div class="row pt-4">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" name="name"
                                               placeholder="Your name"
                                               value="{{ $user->name ?? '' }}">
                                        @error('first_name')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Photo</label>
                                        <input type="file" class="form-control" name="avatar">
                                        @error('photo')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- /row-->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" class="form-control" name="phone"
                                               placeholder="Your phone number" value="{{ $user->profile()?->phone ?? '' }}">
                                        @error('phone')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email" placeholder="Your email"
                                               value="{{ $user->email ?? '' }}">
                                        @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- /row-->

                            <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            @foreach (Config::get('constants.gender') as $gender )
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="gender" @if($gender == $user->profile()?->gender ?? '') checked @endif value="{{ $gender }}">{{ $gender }}
                                                </label>
                                            </div>
                                            @endforeach
                                            @error('gender')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Date Of Birth</label>
                                            <input type="text" class="form-control datepicker" autocomplete="off" name="date_of_birth" placeholder="Your Date of Birth" value="{{ $user->profile()?->date_of_birth ?? '' }}">
                                            @error('date_of_birth')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>



                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>State</label>
                                            <select autocomplete="off" class="form-control" name="state">
                                                @foreach ($states as $state)
                                                    @if ($state->name == 'Kerala')
                                                        <option selected value="{{ $state->name }}">{{ $state->name }}</option>
                                                    @else
                                                        <option value="{{ $state->name }}">{{ $state->name }}</option>
                                                    @endif
                                                @endforeach
                                                
                                                @if (!property_exists($user->profile(), 'state'))
                                                    <option selected disabled>Please select state</option>
                                                @endif
                                            </select>
                                            @error('state')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>City</label>

                                        <select autocomplete="off" class="form-control" name="city">
                                            @foreach ($cities as $city)
                                                @if ($city->name == ($user?->profile()?->city ?? ''))
                                                    <option selected value="{{ $city->name }}">{{ $city->name }}</option>
                                                @else
                                                    <option value="{{ $city->name }}">{{ $city->name }}</option>
                                                @endif
                                            @endforeach
                                            
                                            @if (!property_exists($user->profile(), 'city'))
                                                <option selected disabled>Please select city</option>
                                            @endif
                                        </select>
                                        @error('city')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" class="form-control" name="address"
                                               placeholder="Your address" value="{{ $user->profile()->address ?? '' }}">
                                        @error('address')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="text" class="form-control" name="password"
                                               placeholder="Password" value="{{ $user->password ?? '' }}">
                                        @error('password')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Personal info</label>
                                        <textarea style="height:100px;" class="form-control" name="detail"
                                                  placeholder="Personal info">{{ $user->profile()?->about ?? '' }}</textarea>
                                        @error('detail')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- /row-->
                        </div>
                    </div>
                    <p>
                        <button type="submit" class="btn_1 medium pull-right">Next</button>
                    </p>
                </form>

                @else
                    <div class="box_general padding_bottom">
                        <div class="header_box version_2">
                            <h2><i class="fa fa-user"></i>Educational details</h2>
                        </div>
                        <form method="POST" action="{{ route('userEduData') }}">
                            @csrf
                            <div class="row">

                                <div class="col-md-12 add_top_30">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>10th Passing Year</label>
                                                <input type="text" class="form-control" name="tenth_passing_year"
                                                       placeholder="10th passing year"
                                                       value="{{ $user->profile()->tenth_passing_year ?? '' }}">
                                                @error('tenth_passing_year')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Grading System</label>
                                                <input type="text" class="form-control" name="tenth_grading_system"
                                                       placeholder="Grading System"
                                                       value="{{ $user->profile()->tenth_grading_system ?? '' }}">
                                                @error('tenth_grading_system')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>10th Marks</label>
                                                <input type="text" class="form-control" name="tenth_marks"
                                                       placeholder="10th marks" value="{{ $user->profile()->tenth_marks ?? '' }}">
                                                @error('tenth_marks')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /row-->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>12th Passing Year</label>
                                                <input type="text" class="form-control" name="twelve_passing_year"
                                                       placeholder="12th passing year"
                                                       value="{{ $user->profile()->twelve_passing_year ?? '' }}">
                                                @error('twelve_passing_year')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Grading System</label>
                                                <input type="text" class="form-control" name="twelve_grading_system"
                                                       placeholder="Grading System"
                                                       value="{{ $user->profile()->twelve_grading_system ?? '' }}">
                                                @error('twelve_grading_system')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>12th Marks</label>
                                                <input type="text" class="form-control" name="twelve_marks"
                                                       placeholder="12th marks" value="{{ $user->profile()->twelve_marks ?? '' }}">
                                                @error('twelve_marks')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /row-->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Grad Passing Year</label>
                                                <input type="text" class="form-control" name="grad_passing_year"
                                                       placeholder="Grad passing year"
                                                       value="{{ $user->profile()->grad_passing_year ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Grading System</label>
                                                <input type="text" class="form-control" name="grad_grading_system"
                                                       placeholder="Grading System"
                                                       value="{{ $user->profile()->grad_grading_year ?? '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Grad Marks</label>
                                                <input type="text" class="form-control" name="grad_marks"
                                                       placeholder="Grad marks" value="{{ $user->profile()->grad_marks ?? '' }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>A brief About Your Educational Details</label>
                                                <textarea style="height:100px;" class="form-control"
                                                          name="detail">{{ $user->profile()->detail ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /row-->
                                </div>
                            </div>

                            <p>
                                <button type="submit" class="btn_1 medium pull-right">Save</button>
                            </p>
                            <p>
                                <button type="submit" class="btn_1 medium pull-left" onclick="{{ route('profile') }}">
                                    Previous
                                </button>
                            </p>
                        </form>

                    </div>
            @endif

            <!-- /box_general-->

                <!-- /row-->

            </div>
            @endsection


            @push('script')

                <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js">
                </script>
                <script>
                    $('.datepicker').datepicker();
                </script>


    @endpush
