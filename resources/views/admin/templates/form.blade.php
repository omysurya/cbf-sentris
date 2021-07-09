@extends('admin.layout')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    [pageTitle]
    <small>Optional description</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">[pageTitle]</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
	{!! bootstrapAlert() !!}
	<div class="panel panel-default">
		<div class="panel-heading"></div>

		<form method="post" action="" enctype="multipart/form-data">
		<div class="panel-body">
			
			<div class="form-group">
				<label></label>
				<input type="text" name="" class="form-control">
			</div>

		</div>
		<div class="panel-footer">
			<a href="#" class="btn btn-default">Back</a>
			<input type="submit" class="btn btn-primary" name="submit" value="Submit">
		</div>
		</form>
	</div>
</section>
<!-- /.content -->

@endsection