@extends('admin::layout.index')

@section('title','Profile')

@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">

                        <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>
                <h4 class="page-title">Profile</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-4 col-xl-4">
            <div class="card-box text-center">
                <img src=" {{ asset($user->avatar) }}" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">

                <h4 class="mb-0"> {{ $user->first_name }} {{ $user->last_name }}</h4>
                {{-- <div class="float-right">
                     <div data-row="{{ json_encode(['id'=>$user->id])  }}">
                         <button class="btn btn-primary btn-sm seo-data" data-type="admin-detail">Meta Data <i class="mdi mdi-search-web"></i></button>
                     </div>

                </div> --}}
                <div class="text-left mt-3">
                    <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> <span class="ml-2">{{ $user->first_name }} {{ $user->last_name }}
                        </span></p>

                    <p class="text-muted mb-2 font-13"><strong>Phone :</strong><span class="ml-2">
                            {{ $user->phone }}</span></p>

                    <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ml-2 "> {{ $user->emailAddress }}</span></p>

                    <p class="text-muted mb-1 font-13"><strong>Location :</strong> <span class="ml-2"> {{ $user->address }}</span></p>
                </div>

                <ul class="social-list list-inline mt-3 mb-0">
                    @if($user->facebook)
                    <li class="list-inline-item">
                        <a href="{{ $user->facebook }}" target="__blank" class="social-list-item border-primary text-primary"><i class="mdi mdi-facebook"></i></a>
                    </li>
                    @endif

                    @if($user->twitter)
                    <li class="list-inline-item">
                        <a href="javascript: void(0);" class="social-list-item border-info text-info"><i class="mdi mdi-twitter"></i></a>
                    </li>
                    @endif

                    @if($user->instagram)
                    <li class="list-inline-item">
                        <a href="javascript: void(0);" class="social-list-item border-warning text-warning"><i class="mdi mdi-instagram"></i></a>
                    </li>
                    @endif


                    @if($user->linkedin)
                    <li class="list-inline-item">
                        <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i class="mdi mdi-linkedin"></i></a>
                    </li>
                    @endif

                    @if($user->skype)
                    <li class="list-inline-item">
                        <a href="javascript: void(0);" class="social-list-item border-success text-success"><i class="mdi mdi-skype"></i></a>
                    </li>
                    @endif

                    @if($user->github)
                    <li class="list-inline-item"><i class="fas fa-arrow-alt-from-bottom"></i>
                        <a href="{{ $user->github }}" class="social-list-item border-dark text-dark"><i class="mdi mdi-github"></i></a>
                    </li>
                    @endif
                </ul>


            </div> <!-- end card-box -->


        </div> <!-- end col-->

        <div class="col-lg-8 col-xl-8">
            <div class="card-box">
                <ul class="nav nav-pills navtab-bg nav-justified">
                    <li class="nav-item">
                        <a href="#aboutme" data-toggle="tab" aria-expanded="false" class="nav-link active">
                            About Me
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#basic_details" data-toggle="tab" aria-expanded="false" class="nav-link">
                            Basic Detail
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#additional_details" data-toggle="tab" aria-expanded="false" class="nav-link">
                            Additional Detail
                        </a>
                    </li>
                </ul>
                <form method="post" data-url="saveProfile" class="comment-area-box mt-2 mb-3" enctype="multipart/form-data">
                    @csrf

                    <div class="tab-content">
                        <div class="tab-pane show active" id="aboutme">
                            {!!$user->details!!}
                            {{-- <h5 class="mb-4 text-uppercase"><i class="mdi mdi-briefcase mr-1"></i>
                                                Experience</h5> --}}

                            {{-- <ul class="list-unstyled timeline-sm">
                                                <li class="timeline-sm-item">
                                                    <span class="timeline-sm-date">2015 - 18</span>
                                                    <h5 class="mt-0 mb-1">Lead designer / Developer</h5>
                                                    <p>websitename.com</p>
                                                    <p class="text-muted mt-2">Everyone realizes why a new common language
                                                        would be desirable: one could refuse to pay expensive translators.
                                                        To achieve this, it would be necessary to have uniform grammar,
                                                        pronunciation and more common words.</p>

                                                </li>
                                                <li class="timeline-sm-item">
                                                    <span class="timeline-sm-date">2012 - 15</span>
                                                    <h5 class="mt-0 mb-1">Senior Graphic Designer</h5>
                                                    <p>Software Inc.</p>
                                                    <p class="text-muted mt-2">If several languages coalesce, the grammar
                                                        of the resulting language is more simple and regular than that of
                                                        the individual languages. The new common language will be more
                                                        simple and regular than the existing European languages.</p>
                                                </li>
                                                <li class="timeline-sm-item">
                                                    <span class="timeline-sm-date">2010 - 12</span>
                                                    <h5 class="mt-0 mb-1">Graphic Designer</h5>
                                                    <p>Coderthemes LLP</p>
                                                    <p class="text-muted mt-2 mb-0">The European languages are members of
                                                        the same family. Their separate existence is a myth. For science
                                                        music sport etc, Europe uses the same vocabulary. The languages
                                                        only differ in their grammar their pronunciation.</p>
                                                </li>
                                            </ul> --}}



                        </div> <!-- end tab-pane -->
                        <!-- end about me section content -->


                        <!-- end timeline content-->


                        <div class="tab-pane" id="basic_details">

                            <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle mr-1"></i> Personal Detail</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="firstname">First Name</label>
                                        <input type="text" class="form-control" name="firstname" value="{{ $user->first_name }}" placeholder="Enter first name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lastname">Last Name</label>
                                        <input type="text" class="form-control" name="lastname" value="{{ $user->last_name }}" placeholder="Enter last name">
                                    </div>
                                </div>
                                <!-- end col -->
                            </div> <!-- end row -->




                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control" id="phone" value="{{ $user->phone }}" name="phone" placeholder="Enter phone number">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Email</label>
                                        <input type="text" class="form-control" name="emailAddress" value="{{ $user->emailAddress }}" placeholder="Enter email address">
                                    </div>
                                </div><!-- end col -->
                            </div> <!-- end row -->


                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Date of Birth</label>
                                        <input type="text" class="form-control" name="date_of_birth" id="phone" value="{{ $user->date_of_birth }}" placeholder="Enter date of birth">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Gender</label>
                                        <select class="form-control" name="gender" value="{{ $user->gender }}">
                                            @foreach (['Male','Female','Other'] as $gender )
                                            <option value="{{ $gender }}">{{ $gender }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!-- end col -->
                            </div> <!-- end row -->

                            <div class="row">


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Address</label>
                                        <input type="text" class="form-control" name="address" value="{{ $user->address }}" placeholder="Enter address">
                                    </div>
                                </div><!-- end col -->


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Photo</label>
                                        <input type="file" class="form-control" name="avatar">
                                    </div>
                                </div><!-- end col -->
                            </div>
                        </div>

                        <div class="tab-pane" id="additional_details">

                            <div class="row">
                                <div class="col-12">
                                    <div>
                                        <label for="name">Your info<span class="text-danger">*</span></label>
                                        <textarea name="details" id="summernote-basic">{{ $user->details }}</textarea>
                                    </div>
                                </div>
                                <!-- end col -->
                            </div>

                            <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-earth mr-1"></i> Social</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="social-fb">Facebook</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fab fa-facebook-square"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="facebook" value="{{ $user->facebook}}" id="social-fb" placeholder="Url">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="social-tw">Twitter</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fab fa-twitter"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="twitter" id="social-tw" placeholder="Username" value="{{ $user->twitter}}">
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="social-insta">Instagram</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fab fa-instagram"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="instagram" value="{{ $user->instagram}}" id="social-insta" placeholder="Url">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="social-lin">Linkedin</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fab fa-linkedin"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="linkedin" id="social-lin" value="{{ $user->linkedin}}" placeholder="Url">
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="social-sky">Skype</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fab fa-skype"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="skype" id="social-sky" value="{{ $user->skype}}" placeholder="@username">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="social-gh">Github</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fab fa-github"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="github" value="{{ $user->github}}" id="social-gh" placeholder="Username">
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                            <div class="text-right">
                                <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>
                            </div>
                        </div>

                </form>

            </div>

            <!-- end tab-content -->
            </form>
        </div> <!-- end card-box-->

    </div> <!-- end col -->
</div>





@endsection

@push('script')
<!-- Summernote js -->
<script src="{{ asset('backend/assets/libs/summernote/summernote-bs4.min.js') }}"></script>

<script>
    $('#summernote-basic').summernote({
        placeholder: 'Write something...'
        , height: 230
        , callbacks: {
            // fix broken checkbox on link modal
            onInit: function onInit(e) {
                var editor = $(e.editor);
                editor.find('.custom-control-description').addClass('custom-control-label').parent()
                    .removeAttr('for');
            }
        }
    });

</script>
@endpush

@push('style')
<!-- Summernote css -->
<link href="{{ asset('backend/assets/libs/summernote/summernote-bs4.min.css') }}" rel="stylesheet" type="text/css" />

@endpush
