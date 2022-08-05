<div>
    <div class="card-body reviews">
        <div class="row add_bottom_45 d-flex align-items-center">
            <div class="col-md-3">
                <div id="review_summary">
                    <strong>{{ round($college->total_average,1)}}</strong>
                    <em>Superb</em>
                    <small>Based on {{ $college->reviews()->count() }} reviews</small>
                </div>
            </div>
            <div class="col-md-9 reviews_sum_details">
                <div class="row">
                    <div class="col-md-4">
                        <h6>Faculty</h6>
                        <div class="row">
                            <div class="col-xl-9 col-lg-8 col-8">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $college->average_faculty * 10 }}%"
                                        aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-4"><strong>{{ $college->average_faculty }}</strong></div>
                        </div>
                        <!-- /row -->
                        <h6>Placement</h6>
                        <div class="row">
                            <div class="col-xl-9 col-lg-8 col-8">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $college->average_placement * 10 }}%"
                                        aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-4"><strong>{{ $college->average_placement }}</strong></div>
                        </div>
                        <!-- /row -->
                    </div>
                    <div class="col-md-4">
                        <h6>Social Life</h6>
                        <div class="row">
                            <div class="col-xl-9 col-lg-8 col-8">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $college->average_social_life * 10 }}%"
                                        aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-4"><strong>{{ $college->average_social_life }}</strong></div>
                        </div>
                        <!-- /row -->
                        <h6>Internship</h6>
                        <div class="row">
                            <div class="col-xl-9 col-lg-8 col-8">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $college->average_internship * 10}}%"
                                        aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-4"><strong>{{ $college->average_internship }}</strong></div>
                        </div>
                        <!-- /row -->
                    </div>

                    <div class="col-md-4">
                        <h6>Interview</h6>
                        <div class="row">
                            <div class="col-xl-9 col-lg-8 col-8">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $college->average_interview * 10 }}%"
                                        aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-4"><strong>{{ $college->average_interview }}</strong></div>
                        </div>
                        <!-- /row -->
                        <h6>Hostel</h6>
                        <div class="row">
                            <div class="col-xl-9 col-lg-8 col-8">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $college->average_hostel * 10}}%"
                                        aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-4"><strong>{{ $college->average_hostel }}</strong></div>
                        </div>
                        <!-- /row -->
                    </div>

                    <div class="col-md-4">
                        <h6>Course</h6>
                        <div class="row">
                            <div class="col-xl-9 col-lg-8 col-8">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $college->average_course * 10 }}%"
                                        aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-4"><strong>{{ $college->average_course }}</strong></div>
                        </div>

                    </div>
                </div>
                <!-- /row -->
            </div>
        </div>
        @if (auth()->guard('customer')->check())
        <div class="review-section">
            <p class="text-right">
                <button class="btn_1" type="button" data-toggle="collapse" data-target="#collapseReview"
                    aria-expanded="false" aria-controls="collapseReview">
                    Leave a review
                </button>
            </p>
            <div class="collapse" id="collapseReview">
                <div class="box_general write_review">
                    <h1 class="add_bottom_15">Write a review for "{{ $college->name }}"</h1>
                    <form method="post" action="{{ route('saveCustomerReview') }}">
                        @csrf
                        <input type="text" value="{{ $college->id }}" name="college_id" hidden>
                        <label class="d-block add_bottom_15">Overall rating</label>
                        <div class="row">
                            <div class="col-md-3 add_bottom_25">
                                <div class="add_bottom_15">Faculty <strong class="faculty"></strong></div>
                                <input type="range" min="0" max="10" step="1" value="0" data-orientation="horizontal"
                                    id="faculty" name="faculty">
                            </div>
                            <div class="col-md-3 add_bottom_25">
                                <div class="add_bottom_15">Placement <strong class="placement"></strong></div>
                                <input type="range" min="0" max="10" step="1" value="0" data-orientation="horizontal"
                                    id="placement" name="placement">
                            </div>
                            <div class="col-md-3 add_bottom_25">
                                <div class="add_bottom_15">Social Life <strong class="social_life"></strong></div>
                                <input type="range" min="0" max="10" step="1" value="0" data-orientation="horizontal"
                                    id="social_life" name="social_life">
                            </div>
                            <div class="col-md-3 add_bottom_25">
                                <div class="add_bottom_15">Course <strong class="course"></strong></div>
                                <input type="range" min="0" max="10" step="1" value="0" data-orientation="horizontal"
                                    id="course" name="course">
                            </div>
                            <div class="col-md-3 add_bottom_25">
                                <div class="add_bottom_15">Hostel <strong class="hostel"></strong></div>
                                <input type="range" min="0" max="10" step="1" value="0" data-orientation="horizontal"
                                    id="hostel" name="hostel">
                            </div>
                            <div class="col-md-3 add_bottom_25">
                                <div class="add_bottom_15">Interview <strong class="interview"></strong></div>
                                <input type="range" min="0" max="10" step="1" value="0" data-orientation="horizontal"
                                    id="interview" name="interview">
                            </div>
                            <div class="col-md-3 add_bottom_25">
                                <div class="add_bottom_15">Internship <strong class="internship"></strong></div>
                                <input type="range" min="0" max="10" step="1" value="0" data-orientation="horizontal"
                                    id="internship" name="internship">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Title of your review</label>
                            <input class="form-control" type="text" name="title" value="{{ old('title') }}"
                                placeholder="If you could say it in one sentence, what would you say?">
                            @error('title')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Your review</label>
                            <textarea class="form-control" style="height: 180px;" name="description"
                                value="{{ old('description') }}"
                                placeholder="Write your review to help others learn about this online business"></textarea>
                            @error('description')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="btn_1">Submit review</a>
                    </form>
                </div>
            </div>
        </div>
        @endif
        <div id="reviews">
            @foreach ($college->reviews as $review)

                <div class="review_card">
                    <div class="row">
                        <div class="main_info clearfix">
                            <div class="row">
                                <div class="user_info" style="text-align: left !important">
                                    <figure><img class="inline" src="{{ asset($review->customer->customerDetail->avatar) }}"
                                            alt="{{ $review->customer->customerDetail->full_name }}"></figure>
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
                                                {{-- <ul class="dot_list" style="display: inline-block">
                                                    <li>
                                                        {{ Str::limit($review->created_at,11,'') }}
                                                    </li>
                                                </ul> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="col-md-12 review_content">
                            <div class="clearfix add_bottom_15">
                                <span class="rating float-right">{{ $review->average_rating }}<small>/10</small> <strong>Rating
                                        average</strong></span>
                            </div>

                            <div class="p" style="padding: 10px">
                                <div class="h4">{{ $review->title }}</div>

                                {!! $review->description !!}
                            </div>


                            <ul>
                                <li><a href="{{ route("singleReview",['review'=>$review->slug]) }}"><span>Readmore</span><i class="arrow_carrot-right_alt2"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /row -->
                </div>
            @endforeach

            <!-- /review_card -->

        </div>
        <!-- /reviews -->
    </div>
</div>
