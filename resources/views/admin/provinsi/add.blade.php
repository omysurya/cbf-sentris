@extends('admin.layout')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Provinsi    
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url(config('app.adminPath'))}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li>Master</li>
    <li class="active">Provinsi</li>
  </ol>
</section>
  
<!-- Main content -->
<section class="content"> 
	{!! bootstrapAlert() !!}
	<div class="panel panel-default">
		<div class="panel-heading">Tambah Data</div>

		<form method="post" action="" enctype="multipart/form-data">
		{!! csrf_field() !!}
		<div class="panel-body">
			
			<div class="form-group">
				<label>Nama Provinsi</label>
				<input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required >				
			</div>

		</div>
		<div class="panel-footer" align="right">
			<a href="{{action('AdminProvinsiController@getIndex')}}" class="btn btn-default">Back</a>
			<input type="submit" class="btn btn-primary" name="submit" value="Tambah Data">
		</div>
		</form>
	</div>
</section>
<!-- /.content -->

@endsection