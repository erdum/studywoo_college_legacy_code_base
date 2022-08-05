<div class="modal fade " id="image_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel"> Upload Image</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="card">

                    <form action="{{ route('admin.college.addImage') }}" method="post" data-url="addImage" enctype="multipart/form-data">
                        @csrf

                        @csrf
                        <div class=" form-group">
                            <input type="hidden" name="college_id" id="college_id">
                            <input name="image[]" class=" form-control-file" type="file" multiple />

                        </div>


                        <input type="submit" class="btn btn-success waves-effect waves-light mt-2" value="Submit">
                    </form>

                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
