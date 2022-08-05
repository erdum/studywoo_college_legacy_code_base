@extends('admin::layout.index')

@section('title', 'Subpage')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">

                        <div class="col-sm-6">


                            <div class="text-sm-left">
                                <h4>{{ $college }}</h4>

                            </div>
                        </div>

                        @if (hasPermission('Add Subpage'))
                        <div class="col-sm-8 offset-sm-4">
                            <div class="text-sm-right">
                                <a type="button" class="btn btn-danger waves-effect waves-light mb-2"
                                    href="{{ route('admin.college.subpage.add-edit', ['college' => $college_id]) }}">Add
                                    Sub
                                    page</a>
                            </div>

                        </div>
                        @endif
                       <!-- end col-->
                    </div>


                    <div class="table-responsive">
                        {!! $dataTable->table([
                            'class' => 'table dt-responsive nowrap w-100 dataTable no-footer
                                            dtr-inline',
                        ]) !!}
                    </div>


                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
@endsection


@push('style')
    <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.bootstrap4.min.css" rel="stylesheet">
    <link href="{{ asset('/backend/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
    <!-- Summernote css -->
    <link href="{{ asset('backend/assets/libs/summernote/summernote-bs4.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('script')


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

    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
    {{ $dataTable->scripts() }}
@endpush
