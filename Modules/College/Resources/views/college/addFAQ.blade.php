@extends('admin::layout.index')

@section('title', 'Add FAQ')

@section('content')


                <h4>Add FAQ for "{{ $college_name }}"</h4><br/>
        <div class="content">

                    <!-- Start Content-->
        <div class="container-fluid" >
            <div class="card-box">
            <div class="row">
                 <div class="col-xl-12">
                <form method="post" enctype="multipart/form-data" data-url="college-faq/{{ $college }}">
                    @csrf
                    <input type="hidden" name="college_id" value="{{ $college }}">
                    <div id="container">
                    <div class="form-group">
                        <label for="question">Question</label>
                        <textarea name="question[]" class="form-control" style="height:40px;"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="answer">Answer</label>
                        <textarea name="answer[]" class="form-control" style="height:100px;"></textarea>
                    </div>
                    </div>



                    <div class="text-right">
                        <button type="submit" class="btn btn-success waves-effect waves-light">Save</button>
                        <button type="button" class="btn btn-danger waves-effect waves-light m-l-10"
                            data-dismiss="modal" onclick="Custombox.close();">Cancel</button>
                    </div>
                </form>
                <div class="text-left">
                    <button class="btn btn-success waves-effect waves-light btn-sm" id="addFaq">Add Another FAQ</button>
                </div>

                    </div>
                </div>
                <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>



@endsection

@push('script')

<script>
    $(document).ready(function(){
      $("#addFaq").click(function(){
        $("#container").append(`<hr/><div class='form-group'>
                        <label for='question'>Question</label>
                        <textarea name='question[]' class='form-control' style='height:40px;'></textarea>
                    </div>

                    <div class='form-group'>
                        <label for="answer">Answer</label>
                        <textarea name="answer[]" class="form-control" style="height:100px;"></textarea>
                    </div>`)
      });

    });
    </script>

<script>
    document.onreadystatechange=((event)=>{
        setTimeout(()=>{
             window.MyApp.reloadPage = "{{ route('admin.college.faq.list', ['college' => $college]) }}";
             console.log(window.MyApp)
        },500)
    })
</script>

@endpush

