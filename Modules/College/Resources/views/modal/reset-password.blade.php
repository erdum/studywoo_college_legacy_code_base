<div class="modal fade" id="reset-password" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title" id="myCenterModalLabel"><span class="modal-title-section">Reset</span> Password</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body p-4">
                <form id="reset_form">
                    @csrf
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" class="form-control" name="password" id="password" placeholder="Enter Your Password">
                    </div>
                    <div class="form-group">
                        <label for="password_user">Users</label>
                        <select class="form-control select2" name="password_user[]" id="password_user" multiple="multiple">
                            @foreach ($user_table as $table)
                            <option value="{{ $table->id }}">
                                {{ $table->email }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary waves-effect waves-light" onclick="change_password()">Change Password</button>
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

        function change_password(){
            var password = $("#password").val();
            let _token = $("input[name=_token]").val();
            var password_user = [];
            $("#password_user option:selected").each(function () {
                password_user.push($(this).val());
            });
            var formData = {
                password:password,
                _token:_token,
                password_user:password_user
            }
            console.log(formData);
            $.ajax({
                type:'POST',
                url:"{{route('user_password')}}",
                data:formData,
                dataType: 'json',
                success: function(result){
                    // console.log(result);
                    location.reload();
                }
            });
        }
    </script>
@endpush
