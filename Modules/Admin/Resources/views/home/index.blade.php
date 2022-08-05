@extends('admin::layout.index')

{{-- @section('title','Category') --}}



@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
               <h1>Add Image for Home Page</h1>

                <form method="post" enctype="multipart/form-data">
                    @csrf
                <div class="form-group">
                    <label for="logo">Dimension of image : 1400*800<span
                            class="text-danger">*</span></label>
                    <input type="file" name="image" parsley-trigger="change"
                        required class="form-control" id="emailAddress">
                </div>
                <button type="submit" class="btn btn-success waves-effect waves-light">Save</button>
                </form>
                {{ $homeImage }}
            </div>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col -->
</div>

@include('college::modal.course-modal')


@endsection










