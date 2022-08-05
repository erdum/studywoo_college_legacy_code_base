@extends('admin::layout.index')

@section('title', 'SEO')

@section('content')
<h4>Add Seo</h4><br/>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <h5>Home Page</h5><br>
                <form method="post" action="{{ route('admin.seo.addSeoForStatic') }}">
                    @csrf
                    <input type="text" name="id" value="home-page-seo" hidden>
                    <div class="row">
                    <div class="col-md-10">
                    <div class="form-group">
                        <label for="logo">Meta Title<span
                                class="text-danger">*</span></label>
                        <input type="text" name="meta_title"
                            parsley-trigger="change"
                            placeholder="Enter meta title"
                            class="form-control" id="metaTitle"
                            value="{{ $home!=null ? $home->meta_title : ''}}">
                    </div>
                </div>
                    </div>

                    <div class="row">
                        <div class="col-md-10">
                        <div class="form-group">
                            <label for="logo">Meta Keyword<span
                                    class="text-danger">*</span></label>
                            <input type="text" name="meta_keyword"
                                parsley-trigger="change"
                                placeholder="Enter meta keyword"
                                class="form-control" id="metaKeyword"

                                value="{{ $home!=null ? $home->meta_keyword : ''}}">
                        </div>
                    </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10">
                            <div class="form-group">
                                <label for="logo">Meta Description<span
                                        class="text-danger">*</span></label>
                                <textarea name="meta_description"

                                    class="form-control" >{{ $home!=null ? $home->meta_description : ''}}</textarea>
                            </div>
                        </div>
                        </div>
                            <input type="submit" class="btn btn-success waves-effect waves-light btn-sm" value="Save">
                </form>
            </div>

            <div class="col-md-6">
               <h5>Listing Page</h5><br>

               <form method="post" action="{{ route('admin.seo.addSeoForStatic') }}">
                @csrf
                <input type="text" name="id" value="listing-page-seo" hidden>
                <div class="row">
                <div class="col-md-10">
                <div class="form-group">
                    <label for="logo">Meta Title<span
                            class="text-danger">*</span></label>
                    <input type="text" name="meta_title"
                        parsley-trigger="change"
                        placeholder="Enter meta title"
                        class="form-control" id="metaTitle"
                        value="{{ $listing!=null ? $listing->meta_title : ''}}"
                        >
                </div>
            </div>

            </div>
            <div class="row">
                <div class="col-md-10">
                <div class="form-group">
                    <label for="logo">Meta Keyword<span
                            class="text-danger">*</span></label>
                    <input type="text" name="meta_keyword"
                        parsley-trigger="change"
                        placeholder="Enter meta keyword"
                        class="form-control" id="metaKeyword"
                        value="{{ $listing!=null ? $listing->meta_keyword : ''}}">
                </div>
            </div>
                </div>

                <div class="row">
                    <div class="col-md-10">
                    <div class="form-group">
                        <label for="logo">Meta Description<span
                                class="text-danger">*</span></label>
                        <textarea name="meta_description"

                            class="form-control" >
                           {{ $listing!=null ? $listing->meta_description : ''}}</textarea>
                    </div>
                </div>
                </div>
                    <input type="submit" class="btn btn-success waves-effect waves-light btn-sm" value="Save">
               </form>
            </div>
        </div><br>
        <div class="row">
            <div class="col-md-5">
            <h5>Review Page</h5><br>

               <form method="post" action="{{ route('admin.seo.addSeoForStatic') }}">
                @csrf
                <input type="text" name="id" value="review-page-seo" hidden>
                <div class="row">
                <div class="col-md-10">
                <div class="form-group">
                    <label for="logo">Meta Title<span
                            class="text-danger">*</span></label>
                    <input type="text" name="meta_title"
                        parsley-trigger="change"
                        placeholder="Enter meta title"
                        class="form-control" id="metaTitle"

                        value="{{ $review!=null ? $review->meta_title : ''}}">
                </div>
            </div>

            </div>
            <div class="row">
                <div class="col-md-10">
                <div class="form-group">
                    <label for="logo">Meta Keyword<span
                            class="text-danger">*</span></label>
                    <input type="text" name="meta_keyword"
                        parsley-trigger="change"
                        placeholder="Enter meta keyword"
                        class="form-control" id="metaKeyword"
                        value="{{ $review!=null ? $review->meta_keyword : ''}}">
                </div>
            </div>
                </div>

                <div class="row">
                    <div class="col-md-10">
                    <div class="form-group">
                        <label for="logo">Meta Description<span
                                class="text-danger">*</span></label>
                        <textarea name="meta_description"

                            class="form-control" >{{ $review!=null ? $review->meta_description : ''}}</textarea>
                    </div>
                </div>
                </div>
                    <input type="submit" class="btn btn-success waves-effect waves-light btn-sm" value="Save">
               </form>
            </div>
        </div>
    </div>
@endsection
