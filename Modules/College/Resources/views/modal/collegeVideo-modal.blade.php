<div class="modal fade" id="collegeVideo-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title" id="myCenterModalLabel"><span class="modal-title-section">Add</span> Video</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body p-4">



                <form method="post" enctype="multipart/form-data" data-url="college-video/{{ $college_id }}">
                    @csrf

                    <input type="hidden" name="id">
                    <input type="hidden" name="college_id" value="{{ $college_id }}">



                                <div class="form-group">
                                    <label for="name">Video Title<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="title"
                                        parsley-trigger="change" required
                                        placeholder="Enter Video Title"
                                        class="form-control" id="title">
                                </div>

                                <div class="form-group">
                                    <label for="name">Video Url<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="url"
                                        parsley-trigger="change" required
                                        placeholder="Enter Video URL"
                                        class="form-control" id="url">
                                </div>




                                <div class="text-right">
                                    <button type="submit" class="btn btn-success waves-effect waves-light">Save</button>
                                    <button type="button" class="btn btn-danger waves-effect waves-light m-l-10"
                                        data-dismiss="modal" onclick="Custombox.close();">Cancel</button>
                                </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
