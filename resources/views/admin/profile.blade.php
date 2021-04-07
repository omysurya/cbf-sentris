@extends('admin.layout')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Profile    
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url(config('app.adminPath')) }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Profile</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
	{!! bootstrapAlert() !!}
	<div class="panel panel-default">
		<div class="panel-heading">{{$pageTitle}}</div>

		<form method="post" action="" enctype="multipart/form-data">
		{!! csrf_field() !!}
		<div class="panel-body">

			<div class="form-group">
				<label>Foto</label>
				@if(getUser()->foto)
					<p>
						<img src="{{asset(getUser()->foto)}}" width="90px" height="90px">
					</p>
				@endif
				<input type="file" name="foto" class="form-control">
				<div class="help-block">Format yang didukung jpeg,jpg,png,gif</div>
			</div>
			
			<div class="form-group">
				<label>Nama Lengkap</label>
				<input type="text" name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap')?:getUser()->nama_lengkap}}" required >				
			</div>

			<div class="form-group">
				<label>No. Telp</label>
				<input type="number" name="no_telp" maxlength="20" class="form-control" value="{{ old('no_telp')?:getUser()->no_telp}}" required >
			</div>

			<div class="form-group">
				<label>Alamat</label>
				<input type="text" name="alamat" class="form-control" value="{{ old('alamat')?:getUser()->alamat}}" required >
			</div>

			<div class="form-group">
				<label>Email</label>
				<input type="email" name="email" class="form-control" style="display: none" >
				<input type="email" name="email" class="form-control" value="{{ old('email')?:getUser()->email}}" required >
			</div>

			<div class="form-group">
				<label>Username</label>				
				<input type="text" name="username" class="form-control" value="{{ old('username')?:getUser()->username}}" required >
			</div>

			<div class="form-group">
				<label>Password</label>
				<input type="password" placeholder="Tidak perlu diisi jika tidak dirubah" value="{{ old('password')?:'' }}" name="password" class="form-control" >
			</div>

		</div>
		<div class="panel-footer" align="right">			
			<input type="submit" class="btn btn-primary" name="submit" value="Simpan Profile">
		</div>
		</form>
	</div>
</section>
<!-- /.content -->

@endsection