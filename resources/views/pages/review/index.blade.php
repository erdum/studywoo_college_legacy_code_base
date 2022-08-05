@extends('frontend::layouts.master',['title'=>SystemConfig::get('listing-page-name')])

@push('style')

<!-- SPECIFIC CSS -->
<link href="{{ asset('frontend/css/review.css') }}" rel="stylesheet">

@endpush

@section('content')

<div class="container margin_60_40">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="box_general write_review">
                <h1 class="add_bottom_15">Write a review.</h1>
                <form method="post" action="{{ route('saveCustomerReview')}}">
                    @csrf
                    {{-- <input type="text" value="{{ $college->id }}" name="college_id" hidden> --}}

                    <div class="row">
                        <div class="col-md-12 add_bottom_25">
                        <div class="form-group">
                            <label>College</label>

                            <select class='form-control' name="college_id">
                                <option disabled selected>Select College</option>
                                @foreach ($colleges as $college)
                                    <option value="{{ $college->id }}">{{ $college->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        </div>
                    </div>
                    <label class="d-block add_bottom_15">Overall rating</label>
                    <div class="row">
                        <div class="col-md-3 add_bottom_25">
                            <div class="add_bottom_15">Faculty <strong class="faculty"></strong></div>
                            <input type="range" min="0" max="10" step="1" value="0" data-orientation="horizontal" id="faculty" name="faculty">
                        </div>
                        <div class="col-md-3 add_bottom_25">
                            <div class="add_bottom_15">Placement <strong class="placement"></strong></div>
                            <input type="range" min="0" max="10" step="1" value="0" data-orientation="horizontal" id="placement" name="placement">
                        </div>
                        <div class="col-md-3 add_bottom_25">
                            <div class="add_bottom_15">Social Life <strong class="social_life"></strong></div>
                            <input type="range" min="0" max="10" step="1" value="0" data-orientation="horizontal" id="social_life" name="social_life">
                        </div>
                        <div class="col-md-3 add_bottom_25">
                            <div class="add_bottom_15">Course <strong class="course"></strong></div>
                            <input type="range" min="0" max="10" step="1" value="0" data-orientation="horizontal" id="course" name="course">
                        </div>
                        <div class="col-md-3 add_bottom_25">
                            <div class="add_bottom_15">Hostel <strong class="hostel"></strong></div>
                            <input type="range" min="0" max="10" step="1" value="0" data-orientation="horizontal" id="hostel" name="hostel">
                        </div>
                        <div class="col-md-3 add_bottom_25">
                            <div class="add_bottom_15">Interview <strong class="interview"></strong></div>
                            <input type="range" min="0" max="10" step="1" value="0" data-orientation="horizontal" id="interview" name="interview">
                        </div>
                        <div class="col-md-3 add_bottom_25">
                            <div class="add_bottom_15">Internship <strong class="internship"></strong></div>
                            <input type="range" min="0" max="10" step="1" value="0" data-orientation="horizontal" id="internship" name="internship">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Title of your review</label>
                        <input class="form-control" type="text" name="title" value="{{ old('title') }}" placeholder="If you could say it in one sentence, what would you say?">
                        @error('title')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Your review</label>
                        <textarea class="form-control" style="height: 180px;" name="description" value="{{ old('description') }}" placeholder="Write your review to help others learn about this online business"></textarea>
                        @error('description')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn_1">Submit review</a>
                </form>
            </div>
        </div>
    </div>
    <!-- /row -->
</div>
<!-- /container -->

@endsection




@push('script')
<!-- SPECIFIC SCRIPTS -->
<script src="{{ asset('frontend/js/specific_review.js') }}"></script>
@endpush
