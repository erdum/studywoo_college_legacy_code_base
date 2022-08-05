@extends('admin::layout.index')

@section('title', 'College')

@push('style')
    <style>
        .image-container {
            margin: 4px;
        }

        .image-preiew {
            /* border: 2px solid #479845; */
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        }

        .delete-image {
            width: auto;
            height: auto;
            position: relative;
            bottom: 43%;
            right: 15%;
        }

        .mdi-delete {
            color: red
        }

    </style>

    <style>
        .flex {
            display: flex;


        }

        .icon {
            cursor: pointer;
            font-size: 14px;
            color: red
        }

        .w-1500 {
            width: 150px !important;
            overflow: auto
        }

    </style>
@endpush

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @if (hasPermission('Add College'))
                        <div class="row mb-2">
                            <div class="col-sm-8 offset-sm-4">
                                <div class="text-sm-right">
                                    <a type="button" class="btn btn-danger waves-effect waves-light mb-2"
                                        href="{{ route('admin.college.getAddEditForm') }}">Add College</a>
                                </div>
                            </div><!-- end col-->


                        </div>

                    @endif


                    <div class="row mb-2">
                        <div class="col-md-3">
                            <label for="logo">State</label>
                            <div class="flex">
                                <select class="form-control" id="state" value="" onchange="filterData()">
                                    <option selected="" value="">Select State</option>
                                    @foreach ($states as $state)
                                        <option {{ request()->state == $state->id ? 'selected' : '' }}
                                            value="{{ $state->id }}">{{ $state->name }}</option>
                                    @endforeach

                                </select>

                            </div>

                        </div>
                        <div class="col-md-3">
                            <label for="logo">City</label>
                            <div class="flex">
                                <select class="form-control" id="city" value="" onchange="filterData()">
                                    <option selected="" value="">Select City</option>
                                    @foreach ($states[0]->getCityByState($selectState) as $city)
                                        <option {{ request()->city == $city->id ? 'selected' : '' }}
                                            value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach

                                </select>

                            </div>

                        </div>
                        <div class="col-md-3">
                            <label for="logo">College Type</label>
                            <div class="flex">

                                <select class="form-control" id="type" value="" onchange="filterData()">
                                    <option selected="" value="">Select College Type</option>
                                    @foreach ($types as $type)
                                        <option {{ request()->type == $type->id ? 'selected' : '' }}
                                            value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach

                                </select>

                            </div>

                        </div>
                        <div class="col-md-3">
                            <label for="logo">Stream</label>
                            <div class="flex">
                                <select class="form-control" id="stream" value="" onchange="filterData()">
                                    <option selected="" value="">Select Stream</option>
                                    @foreach ($streams as $stream)
                                        <option {{ request()->stream == $stream->id ? 'selected' : '' }}
                                            value="{{ $stream->id }}">{{ $stream->name }}</option>
                                    @endforeach

                                </select>

                            </div>

                        </div>
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

@include('dataTable.cnd')

@push('script')



    <script>
        function filterData() {
            const url = "{{ route('admin.college.list') }}"
            const state = $("#state").val();
            const city = $("#city").val();
            const type = $("#type").val();
            const stream = $("#stream").val();

            let query = ``;
            if (state) {
                if (query)
                    query += `&state=${state}`
                else {
                    query += `?state=${state}`
                }
            } else


            if (city) {
                if (query)
                    query += `&city=${city}`
                else {
                    query += `?city=${city}`
                }
            }

            if (type) {
                if (query)
                    query += `&type=${type}`
                else {
                    query += `?type=${type}`
                }
            }

            if (stream) {
                if (query)
                    query += `&stream=${stream}`
                else {
                    query += `?stream=${stream}`
                }
            }
            console.log(query)
            query && window.open(url + query, "_self");
        }
    </script>

@endpush
