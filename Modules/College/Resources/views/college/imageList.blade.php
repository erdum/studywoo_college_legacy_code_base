@extends('admin::layout.index')

@section('title','Image')

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

                    @if(hasPermission('Add Image'))
                    <div class="col-sm-8 offset-sm-4">
                        <div class="text-sm-right">
                            <button type="button" class="btn btn-danger waves-effect waves-light mb-2"
                                data-toggle="modal" data-target="#image_modal">Add Image</button>
                        </div>
                    </div><!-- end col-->
                    @endif
                </div>
                <div class="table-responsive">
                    {!! $dataTable->table(['class' => 'table dt-responsive nowrap w-100 dataTable no-footer
                    dtr-inline']) !!}
                </div>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col -->
</div>

@include('college::modal.collegeImage-modal')


@endsection

@include('dataTable.cnd')









