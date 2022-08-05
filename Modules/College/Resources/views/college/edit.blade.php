@extends('admin::layout.index')

@section('title', 'Edit College')


@push('style')
    <!-- Summernote css -->
    <link href="{{ asset('backend/assets/libs/summernote/summernote-bs4.min.css') }}" rel="stylesheet" type="text/css" />

@endpush

@section('content')

    <div>
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                <div>

                    <div class="card-box">
                        <h4 class="header-title m-t-0">Edit College </h4>

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                       @foreach ($errors->all() as $error)
                                           {{ $error }}
                                       @endforeach

                                        <div id="rootwizard">
                                            <ul class="nav nav-pills bg-light nav-justified form-wizard-header mb-3">
                                                <li class="nav-item" data-target-form="#accountForm">
                                                    <a href="#basicData" data-toggle="tab"
                                                        class="nav-link rounded-0 pt-2 pb-2">
                                                        <i class="mdi mdi-account-circle mr-1"></i>
                                                        <span class="d-none d-sm-inline">Basic Data</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item" data-target-form="#profileForm">
                                                    <a href="#course" data-toggle="tab"
                                                        class="nav-link rounded-0 pt-2 pb-2">
                                                        <i class="mdi mdi-face-profile mr-1"></i>
                                                        <span class="d-none d-sm-inline">Additional Data</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item" data-target-form="#otherForm">
                                                    <a href="#info" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                        <i class="mdi mdi-checkbox-marked-circle-outline mr-1"></i>
                                                        <span class="d-none d-sm-inline">Info</span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <form action="{{ route('admin.college.editCollege') }}" method="POST"
                                                enctype="multipart/form-data" class="parsley-examples py-3"
                                                id="college_form">
                                                @csrf
                                                <input type="text" name="id" value="{{$college->id}}" hidden>
                                                <div class="tab-content mb-0 b-0 pt-0">
                                                    Note: <span
                                                    class="text-danger">*</span> are required fields.<br/><br/>

                                                    <div class="tab-pane" id="basicData">

                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="name">College / University Name<span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" name="name" parsley-trigger="change"
                                                                        required
                                                                        placeholder="Enter College / University Name"
                                                                        class="form-control" id="userName" value="{{ $college->name }}">
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="logo">Established Date<span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" name="estd"
                                                                        parsley-trigger="change" required
                                                                        placeholder="Enter established date"
                                                                        class="form-control" id="userName"  value="{{ $college->estd }}">
                                                                </div>
                                                            </div>


                                                        </div>


                                                        <div class="row">
                                                            <div class="col-lg-6">

                                                                <div class="form-group">
                                                                    <label for="logo">State<span
                                                                            class="text-danger">*</span></label>
                                                                    <select class="form-control" name="state_id">
                                                                        <option selected>Select State</option>
                                                                        @foreach ($states as $state)
                                                                            <option value="{{ $state->id }}"
                                                                                @if ($state->id == $college->state_id)
                                                                                    selected
                                                                                @endif
                                                                                >
                                                                                {{ $state->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="logo">City<span
                                                                            class="text-danger">*</span></label>
                                                                    <select class="form-control" name="city_id">
                                                                        <option selected>Select City</option>
                                                                        @foreach ($cities as $city)
                                                                            <option value="{{ $city->id }}"
                                                                                @if ($city->id == $college->city_id)
                                                                                selected
                                                                                @endif
                                                                                >
                                                                                {{ $city->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="logo">Location<span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" name="location"
                                                                        parsley-trigger="change" required
                                                                        placeholder="Enter location"
                                                                        class="form-control" id="userName" value="{{ $college->location }}">
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="logo">College Contacts<span
                                                                            class="text-danger">*</span></label>

                                                                            <select class="form-control meta-keyword" name="contacts[]"  multiple>
                                                                                {{-- <option selected disabled></option> --}}

                                                                                @foreach ($contacts as $contact)
                                                                                     <option selected value="{{ $contact->contact_number }}"> {{ $contact->contact_number }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                </div>
                                                            </div>



                                                        </div>


                                                        <div class="row">


                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="logo">Website URL<span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" name="website"
                                                                        parsley-trigger="change" required
                                                                        placeholder="Enter college website url"
                                                                        class="form-control" id="userName" value="{{ $college->website }}">
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="logo">Logo</label>
                                                                    <input type="file" name="logo" parsley-trigger="change"
                                                                        required class="form-control" id="emailAddress">
                                                                </div>
                                                            </div>


                                                        </div>

                                                    </div>
                                                    <div class="tab-pane fade" id="course">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="logo">College Type<span
                                                                            class="text-danger">*</span></label>
                                                                            <select class="form-control select2" name="college_types[]"  multiple>
                                                                                {{-- <option selected disabled>Select College Type</option> --}}
                                                                                @foreach ($collegeTypes as $type)
                                                                                    <option value="{{ $type->id }}"
                                                                                        @foreach ($selectedCollegeTypes as $selected)
                                                                                            @if ($type->id == $selected->college_type_id)
                                                                                             selected
                                                                                            @endif
                                                                                        @endforeach

                                                                                        >
                                                                                        {{ $type->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="logo">Affiliated To<span
                                                                            class="text-danger">*</span></label>
                                                                            <select class="form-control select2" name="affiliateds[]" multiple="multiple">

                                                                                @foreach ($affiliateds as $affiliated )

                                                                                    <option value="{{ $affiliated->id }}"
                                                                                        @foreach ($selectedAffiliateds as $selected)
                                                                                            @if ($affiliated->id == $selected->affiliated_id)
                                                                                             selected
                                                                                            @endif
                                                                                        @endforeach
                                                                                        >
                                                                                        {{ $affiliated->name }}
                                                                                    </option>
                                                                                @endforeach

                                                                             </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="stream">Streams<span
                                                                        class="text-danger">*</span></label>
                                                                        <select class="form-control select2" name="streams[]" multiple="multiple">

                                                                            @foreach ($streams as $stream )

                                                                                <option value="{{ $stream->id }}"
                                                                                    @foreach ($selectedStreams as $selected)
                                                                                            @if ($stream->id == $selected->stream_id)
                                                                                             selected
                                                                                            @endif
                                                                                        @endforeach
                                                                                    >
                                                                                    {{ $stream->name }}
                                                                                </option>
                                                                            @endforeach

                                                                         </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6">

                                                                <div class="form-group">
                                                                    <label for="logo">Program types<span
                                                                            class="text-danger">*</span></label>
                                                                    <select class="form-control select2" name="program_types[]" multiple>
                                                                        {{-- <option selected>Select Course Types</option> --}}
                                                                        @foreach ($programTypes as $programTypes)
                                                                            <option value="{{ $programTypes->id }}"
                                                                                @foreach ($selectedProgramTypes as $selected)
                                                                                            @if ($programTypes->id == $selected->program_type_id)
                                                                                             selected
                                                                                            @endif
                                                                                 @endforeach
                                                                                >
                                                                                {{ $programTypes->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="row">

                                                            <div class="col-lg-6">

                                                                <div class="form-group">
                                                                    <label for="logo">Course types<span
                                                                            class="text-danger">*</span></label>
                                                                    <select class="form-control select2" name="course_types[]" multiple>
                                                                        {{-- <option selected>Select Course Types</option> --}}
                                                                        @foreach ($courseTypes as $courseType)
                                                                            <option value="{{ $courseType->id }}"
                                                                                @foreach ($selectedCourseTypes as $selected)
                                                                                            @if ($courseType->id == $selected->course_type_id)
                                                                                             selected
                                                                                            @endif
                                                                                 @endforeach


                                                                                >
                                                                                {{ $courseType->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6">

                                                                <div class="form-group">
                                                                    <label for="logo">Entrance Exams<span
                                                                            class="text-danger">*</span></label>
                                                                    <select class="form-control select2" name="entrance_exams[]" multiple>
                                                                        {{-- <option selected>Select Course Types</option> --}}
                                                                        @foreach ($entranceExams as $entranceExam)
                                                                            <option value="{{ $entranceExam->id }}"
                                                                                @foreach ($selectedEntranceExams as $selected)
                                                                                            @if ($entranceExam->id == $selected->entrance_exam_id)
                                                                                             selected
                                                                                            @endif
                                                                                 @endforeach
                                                                                >
                                                                                {{ $entranceExam->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>


                                                            {{-- <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="name">Course Duration<span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" name="duration"
                                                                        parsley-trigger="change" required
                                                                        placeholder="Enter Course Duration"
                                                                        class="form-control" id="userName">
                                                                </div>
                                                            </div> --}}

                                                        </div>

                                                        <div class="row">

                                                            <div class="col-lg-12">

                                                                <div class="form-group">
                                                                    <label for="logo">Courses<span
                                                                            class="text-danger">*</span></label>
                                                                    <select class="form-control select2" name="courses[]" multiple>

                                                                        @foreach ($courses as $course)
                                                                            <option value="{{ $course->id }}"
                                                                                @foreach ($selectedCourses as $selected)
                                                                                            @if ($course->id == $selected->course_id)
                                                                                             selected
                                                                                            @endif
                                                                                 @endforeach
                                                                                >
                                                                                {{ $course->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>



                                                            {{-- <div class="col-lg-6">

                                                                <div class="form-group">
                                                                    <label for="logo">Entrance Exam<span
                                                                            class="text-danger">*</span></label>
                                                                    <select class="form-control" name="entrance_exam_id">
                                                                        <option selected>Select Entrance Exam</option>
                                                                        @foreach ($entranceExams as $entranceExam)
                                                                            <option value="{{ $entranceExam->id }}">
                                                                                {{ $entranceExam->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div> --}}


                                                            {{-- <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="name">Type<span
                                                                            class="text-danger">*</span></label>
                                                                            <select class="form-control" name="type_id">
                                                                                <option selected>Select Course Type</option>
                                                                                @foreach ( $courseTypes as $type)
                                                                                    <option value="{{ $type->id}}">
                                                                                        {{ $type->name}}</option>
                                                                                @endforeach
                                                                            </select>

                                                                </div>
                                                            </div> --}}

                                                        </div>
                                                        <div class="row">

{{--
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="name">Price<span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" name="price" parsley-trigger="change"
                                                                        required placeholder="Enter Course Price"
                                                                        class="form-control" id="userName">
                                                                </div>
                                                            </div>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                                    <div class="tab-pane fade" id="info">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div>
                                                                    <label for="name">College / University Info<span
                                                                            class="text-danger">*</span></label>
                                                                    <textarea name="info" class="tinymce-editor">{{ isset($info) ? $info:''}}</textarea>
                                                                </div>
                                                            </div>
                                                            <!-- end col -->
                                                        </div>
                                                        <!-- end row -->

                                                    </div>
                                                    <br /><br />
                                                    <ul class="list-inline wizard mb-0">
                                                        <li class="previous list-inline-item"><a href="javascript: void(0);"
                                                                class="btn btn-secondary">Previous</a>
                                                        </li>
                                                        <li class="next list-inline-item float-right"><a
                                                                href="javascript: void(0);"
                                                                class="btn btn-secondary">Next</a>
                                                        </li>
                                                    </ul>

                                                </div> <!-- tab-content -->
                                            </form>
                                        </div> <!-- end #rootwizard-->

                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div>
                        </div>

                    </div> <!-- end card-box -->
                </div>
                <!-- end col -->


            </div>
        </div>
    </div>
@endsection




@push('script')

    <!-- Plugins js-->
    <script src="{{ asset('backend/assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}"></script>

    {{-- <!-- Init js-->
    <script src="{{ asset('backend/assets/js/pages/form-wizard.init.js') }}"></script> --}}


    <script>
        $("#rootwizard").bootstrapWizard({
            onNext: function(tab, navigation, index) {

                if ($('#info').hasClass('show')) {
                    // $('textarea.note-codable').attr('name', "info");
                    $('#college_form').trigger('submit');
                }

                var form = $($(tab).data("targetForm"));
                if (form) {
                    form.addClass("was-validated");
                    // if (form[0].checkValidity() === false) {
                    //     event.preventDefault();
                    //     event.stopPropagation();
                    //     return false;
                    // }
                }
            },
        });

    </script>


    <!-- Summernote js -->
    <script src="{{ asset('backend/assets/libs/summernote/summernote-bs4.min.js') }}"></script>

    <script>
        $('#summernote-basic').summernote({
            placeholder: 'Write something...',
            height: 230,
            callbacks: {
                // fix broken checkbox on link modal
                onInit: function onInit(e) {
                    var editor = $(e.editor);
                    editor.find('.custom-control-description').addClass('custom-control-label').parent()
                        .removeAttr('for');
                }
            }
        });
    </script>

        <script>
           $(document).ready(function() {
                $('.select2').select2();
                $('.meta-keyword').select2({
                        tags:true,
                        tokenSeperator:[',',' ']
                })
            });











    </script>
@endpush
