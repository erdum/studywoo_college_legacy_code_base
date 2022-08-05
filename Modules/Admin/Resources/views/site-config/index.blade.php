@extends('admin::layout.index')

@section('title', 'Site Config')

@push('style')

    <!-- Plugins css -->
    <link href="{{ asset('backend/assets/libs/x-editable/bootstrap-editable/css/bootstrap-editable.css') }}"
        rel="stylesheet" type="text/css" />

@endpush

@php
$configList = ['App Name', 'App Slogan', 'Logo Thumbnail Width', 'Logo Thumbnail Height', 'Phone', 'Email', 'Contact', 'Locality Address', 'Street Address', 'Postal Code', 'Telephone', 'Fax Number'];

$socialMediaList = ['Facebook', 'Instagram', 'Twitter', 'Youtube'];
@endphp



@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card-box">



                <div>

                    <ul class="nav nav-pills navtab-bg nav-justified">
                        <li class="nav-item">
                            <a href="{{ route('admin.system-config.getSiteConfig') }}"
                                class="nav-link {{ $page == null ? 'active' : '' }}">
                                Basic Config
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.system-config.getSiteConfig', ['page' => 'social-link']) }}"
                                class="nav-link {{ $page == 'social-link' ? 'active' : '' }}">
                                Social Links
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.system-config.getSiteConfig', ['page' => 'frontend-page']) }}"
                                class="nav-link {{ $page == 'frontend-page' ? 'active' : '' }}">
                                Frontend Page
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        @switch($page)



                            @case('social-link')
                                <div class="table-responsive">
                                    <table class="table table-centered table-borderless table-striped mb-0">
                                        <tbody>
                                            @foreach ($socialMediaList as $key => $config)
                                                <tr>
                                                    <td style="width: 35%;">{{ $config }}</td>
                                                    <td data-id="{{ Str::slug($config) }}">
                                                        <a href="#" class="inline-editableform" data-type="text"
                                                            data-pk="{{ $key + 1 }}"
                                                            data-title="Enter {{ $config }}">{{ SystemConfig::get(Str::slug($config)) }}</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @break

                            @case('frontend-page')

                                <div class="tab-pane show active">
                                    <h3>Home Page Image</h3> Preferrable size( 1400* 800)
                                    <br />
                                    <form enctype="multipart/form-data"
                                    method="POST"
                                        action="{{ route('admin.system-config.addHomeImage') }}" data-url="home-image">

                                        @csrf
                                        <img src="{{ asset(SystemConfig::get('home-image')) }}" width="200" height="200"
                                            alt="Home page image">
                                            <br>
                                        <br>
                                        <input type="file" name="home-image"><br />
                                        <br /><br />
                                        <h3>Site Logo</h3>
                                        <br />
                                        <img src="{{ asset('logo.png') }}" alt="Site Logo">
                                        <br>
                                        <input type="file" name="site-logo"><br />

                                        <br /><br />
                                        <h3>Favicon Icon</h3>
                                        <br />
                                        <img src="{{ asset('favicon.ico') }}" alt="Site Logo">
                                        <br>
                                        <input type="file" name="favicon-icon"><br />
                                        <input value="Submit" type="submit" class="btn btn-primary btn-sm m-2" />
                                    </form>
                                </div>
                            @break
                            @case(null)


                                <div class="tab-pane show active">
                                    <div class="table-responsive">
                                        <table class="table table-centered table-borderless table-striped mb-0">
                                            <tbody>
                                                @foreach ($configList as $key => $config)
                                                    <tr>
                                                        <td style="width: 35%;">{{ $config }}</td>
                                                        <td data-id="{{ Str::slug($config) }}">
                                                            <a href="#" class="inline-editableform" data-type="text"
                                                                data-pk="{{ $key + 1 }}"
                                                                data-title="Enter {{ $config }}">{{ SystemConfig::get(Str::slug($config)) }}</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div> <!-- end .table-responsive -->
                                </div>
                            @break
                            @default
                                {{ $page }}
                        @endswitch


                    </div>
                </div> <!-- end card-box-->

            </div> <!-- end card-box -->
        </div><!-- end col -->
    </div>
@endsection


@push('script')


    <!-- Plugins js -->
    <script src="{{ asset('backend/assets/libs/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/x-editable/bootstrap-editable/js/bootstrap-editable.min.js') }}"></script>

    <!-- Init js-->
    <script src="{{ asset('backend/assets/js/pages/form-xeditable.init.js') }}"></script>


@endpush
