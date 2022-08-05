<div class="modal fade" id="city-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title" id="myCenterModalLabel"><span class="modal-title-section">Add</span> City</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body p-4">



                <form method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id"/>

                     <div class="form-group">
                        <label for="state">State</label>
                        <select class="form-control" name="state_id">
                            <option selected disabled>Select State</option>
                            @foreach ($states as $state)
                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter city name">
                    </div>

                    <div class="form-group">
                        <label for="name">Slug</label>
                        <input type="text" class="form-control" name="slug" placeholder="Enter slug">
                    </div>




                    <div class="text-right">
                        <button type="submit" class="btn btn-success waves-effect waves-light">Save</button>
                        <button type="button" class="btn btn-danger waves-effect waves-light m-l-10" data-dismiss="modal" onclick="Custombox.close();">Cancel</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
