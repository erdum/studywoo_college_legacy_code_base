<div class="modal fade" id="collegeCourse-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title" id="myCenterModalLabel"><span class="modal-title-section">Add</span> Course</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body p-4">



                <form method="post" enctype="multipart/form-data" data-url="college-course/{{ $college_id }}">
                    @csrf

                    <input type="hidden" name="id">
                    <input type="hidden" name="college_id" value="{{ $college_id }}">
                                <div class="form-group">
                                    <label for="logo">Course<span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" name="course_id">
                                        <option selected>Select Course</option>
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}">
                                                {{ $course->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="name">Course Duration<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="duration"
                                        parsley-trigger="change" required
                                        placeholder="Enter Course Duration"
                                        class="form-control" id="userName">
                                </div>




                                <div class="form-group">
                                    <label for="logo">Entrance Exam<span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" name="entrance_exam_id">
                                        <option selected>Select Entrance Exam</option>
                                        @foreach ($entranceExams as $entranceExam)
                                            <option value="{{ $entranceExam->id }}">
                                                {{ $entranceExam->name }}</option>
                                        @endforeach
                                    </select>
                                </div>



                                <div class="form-group">
                                    <label for="name">Type<span
                                            class="text-danger">*</span></label>
                                            <select class="form-control" name="course_type_id">
                                                <option selected>Select Course Type</option>
                                                @foreach ( $courseTypes as $type)
                                                    <option value="{{ $type->id}}">
                                                        {{ $type->name}}</option>
                                                @endforeach
                                            </select>

                                </div>



                                <div class="form-group">
                                    <label for="name">Price<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="price" parsley-trigger="change"
                                        required placeholder="Enter Course Price"
                                        class="form-control" id="userName">
                                </div>

                                <div class="form-group">
                                    <label for="name">Description<span
                                            class="text-danger">*</span></label>
                                    <textarea name="description"
                                        class="tinymce-editor"></textarea>
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
