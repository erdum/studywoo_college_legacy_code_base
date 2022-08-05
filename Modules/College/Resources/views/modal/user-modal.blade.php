<div class="modal fade" id="user-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title" id="myCenterModalLabel"><span class="modal-title-section">Add</span> User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body p-4">

                <form method="post" enctype="multipart/form-data" data-url="register">
                    @csrf
                    <input type="hidden" name="id" />
                    <div class="form-group">
                        <label for="name">First Name</label>
                        <input type="text" class="form-control" name="first_name" placeholder="Enter first name">
                    </div>

                    <div class="form-group">
                        <label for="name">Last Name</label>
                        <input type="text" class="form-control" name="last_name" placeholder="Enter first name">
                    </div>

                    <div class="form-group">
                        <label for="name">Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Enter email">
                    </div>

                    <div class="form-group">
                        <label for="name">Password</label>
                        <input type="text" class="form-control" name="password" placeholder="Enter password">
                    </div>

                    <div class="form-group">
                        <label for="permission">Permissions</label>
                        <select class="form-control select2" name="permissions[]" multiple="multiple">

                            @foreach (Config::get('constants.permissions') as $permission)

                                <option value="{{ \Str::slug($permission) }}">
                                    {{ $permission }}
                                </option>
                            @endforeach

                        </select>
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





<div class="modal fade" id="user-edit-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title" id="myCenterModalLabel"><span class="modal-title-section">Edit</span>
                    Permission
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body p-4">

                <form method="post" enctype="multipart/form-data" data-url="register">
                    @csrf
                    <input type="hidden" name="id" />
                    <div class="form-group">
                        <label for="permission">Permissions</label>
                        <select class="form-control select2" name="permissions[]" value="add-college" id="per"
                            multiple="multiple">

                            @foreach (Config::get('constants.permissions') as $permission)

                                <option value="{{ \Str::slug($permission) }}">
                                    {{ $permission }}
                                </option>
                            @endforeach

                        </select>
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



@push('script')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
            $('.meta-keyword').select2({
                tags: true,
                tokenSeperator: [',', ' ']
            })
        });

        $(document).on('click', '.user-edit', function() {

            var div = $(this).closest("div");
            var data = div.data("row");

            var modal = $("#user-edit-modal");
            modal.modal("show");
            var arr = (data.permissions).replace("[", '').replace("]", '').replaceAll('"', '').split(",")
            $("input[name=id]").val(data.id)
            $('#per').val(arr).trigger('change')

        });
    </script>
@endpush
