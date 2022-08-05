@extends('customer::index')

@section('content')
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Profile</li>
      </ol>
		<div class="box_general padding_bottom">
			<div class="header_box version_2">
				<h2><i class="fa fa-user"></i>Educational details</h2>
			</div>
            <form method="POST" action="{{ route('postProfile') }}">
                @csrf
			<div class="row">
				{{-- <div class="col-md-4">
					<div class="form-group">
					<label>Your photo</label>
						<form action="/file-upload" class="dropzone"></form>
				    </div>
				</div> --}}
				<div class="col-md-12 add_top_30">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>10th Passing Year</label>
								<input type="text" class="form-control" name="tenth_passing_year" placeholder="10th passing year">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Grading System</label>
								<input type="text" class="form-control" name="tenth_grading_system" placeholder="Grading System">
							</div>
						</div>

                        <div class="col-md-4">
							<div class="form-group">
								<label>10th Marks</label>
								<input type="text" class="form-control" name="tenth_marks" placeholder="10th marks">
							</div>
						</div>
					</div>
					<!-- /row-->
                    <div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>12th Passing Year</label>
								<input type="text" class="form-control" name="twelve_passing_year" placeholder="12th passing year">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Grading System</label>
								<input type="text" class="form-control" name="twelve_grading_system" placeholder="Grading System">
							</div>
						</div>

                        <div class="col-md-4">
							<div class="form-group">
								<label>12th Marks</label>
								<input type="text" class="form-control" name="twelve_marks" placeholder="12th marks">
							</div>
						</div>
					</div>


					<!-- /row-->



					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Grad Passing Year</label>
								<input type="text" class="form-control" name="grad_passing_year" placeholder="Grad passing year">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Grading System</label>
								<input type="text" class="form-control" name="grad_grading_system" placeholder="Grading System">
							</div>
						</div>

                        <div class="col-md-4">
							<div class="form-group">
								<label>Grad Marks</label>
								<input type="text" class="form-control" name="grad_marks" placeholder="Grad marks">
							</div>
						</div>
					</div>

                    <div class="row">

						<div class="col-md-12">
							<div class="form-group">
								<label>A brief About Your Educational Details</label>
								<textarea style="height:100px;" class="form-control" name="detail"></textarea>
							</div>
						</div>
					</div>


					<!-- /row-->
				</div>
			</div>
		</div>
		<!-- /box_general-->

		<!-- /row-->
		<p><button type="submit" class="btn_1 medium">Save</button></p>
	  </div>
    </form>
	  <!-- /.container-fluid-->
   	</div>
@endsection
