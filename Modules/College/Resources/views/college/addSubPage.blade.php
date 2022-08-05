@extends('admin::layout.index')

@section('title', 'Add Subpage')


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
                        <h4 class="header-title m-t-0">Add/Edit College Subpage for "{{ $college }}" </h4>

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div id="rootwizard">
                                            <form method="POST" enctype="multipart/form-data" class="parsley-examples py-3"
                                                data-url="college-subpage/{{ $college_id }}" id="college_form">
                                                @csrf
                                                <input type="hidden" name="college_id" value="{{ $college_id }}">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="name">Subpage Title<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" name="title" parsley-trigger="change"
                                                                required placeholder="Enter subpage name"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="name">Subpage Slug<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" name="slug" parsley-trigger="change" required
                                                                placeholder="Enter subpage slug" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div>
                                                            <label for="name">Content<span
                                                                    class="text-danger">*</span></label>
                                                            <textarea name="content" class="tinymce-editor"></textarea>
                                                        </div>
                                                    </div>
                                                    <!-- end col -->
                                                </div><br />
                                                <button type="submit"
                                                    class="btn btn-success waves-effect waves-light">Save</button>
                                                <!-- end row -->
                                            </form>
                                        </div>
                                        <br /><br />
                                        <!-- tab-content -->

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

@endsection


@push('script')

    <script>
        document.onreadystatechange=((event)=>{
            setTimeout(()=>{
                 window.MyApp.reloadPage = "{{ route('admin.college.subpage.list', ['college' => $college_id]) }}";
                 console.log(window.MyApp)
            },500)
        })
    </script>

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
@endpush
