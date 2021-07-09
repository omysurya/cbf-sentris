@extends('admin.layout')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Menu    
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url(config('app.adminPath'))}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li>Setting</li>
    <li class="active">Menu</li>
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
				<label>Icon</label>
				<input type="text" name="icon" class="form-control" value="{{ old('icon') }}" required >				
			</div>

			<div class="form-group">
				<label>Nama</label>
				<input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required >				
			</div>

			<div class="form-group">
				<label>Module Path</label>
				<input type="text" name="module_path" class="form-control" value="{{ old('module_path') }}" required >				
			</div>

			<div class="form-group">
				<label>Parent</label>
				<select class="form-control" required name='parent_menu_id'>
					<option value="0">** Atur Sebagai Parent</option>
					{!! comboMenu() !!}
				</select>
			</div>
			
		</div>
		<div class="panel-footer" align="right">
			<a href="{{action('AdminMenuController@getIndex')}}" class="btn btn-default">Back</a>
			<input type="submit" class="btn btn-primary" name="submit" value="Tambah Data">
		</div>
		</form>
	</div>
</section>
<!-- /.content -->

@endsection