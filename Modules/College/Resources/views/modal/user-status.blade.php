<div class="modal fade" id="user-status" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title" id="myCenterModalLabel"><span class="modal-title-section">Change</span> Status
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body p-4">
                <form id="status_form">
                    @csrf
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" name="change_status" id="change_status">
                            <option>Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">Deactive</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status_user">Users</label>
                        <select class="form-control select2" name="status_user[]" id="status_user" multiple="multiple">
                            @foreach ($user_table as $table)
                            <option value="{{ $table->id }}">
                                @if ($table->status == 1)
                                {{ $table->email }}-Active
                                @else
                                {{ $table->email }}-Deactive
                                @endif
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-success waves-effect waves-light"
                            onclick="change_status_of_user()">Change Status</button>
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
        function change_status_of_user(){
            var status = $("#change_status option:selected").val();
            let _token = $("input[name=_token]").val();
            var status_user = [];
            $("#status_user option:selected").each(function () {
                status_user.push($(this).val());
            });
            var formData = {
                status:status,
                _token:_token,
                status_user:status_user
            }
            // console.log(formData);
            $.ajax({
                type:'POST',
                url:"{{route('user_status')}}",
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
