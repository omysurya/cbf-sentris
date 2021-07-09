@extends('admin.layout')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    User
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li>Master</li>
    <li class="active">User</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
	{!! bootstrapAlert() !!}

	<div class="panel panel-default">
		<div class="panel-heading">Edit Data</div>

		<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
		{!!csrf_field()!!}
		<div class="panel-body">

			<div class="page-header">
				<h4><strong>Pengenal</strong></h4>
			</div>

			<div class="form-group">
				<label class='col-sm-2'>Nama Lengkap</label>
				<div class="col-sm-4">
					<input type="text" readonly class="form-control" value="{{ $karyawan->nama_lengkap }}" required >
				</div>
			</div>

			<div class="form-group">
				<label class='col-sm-2'>Alamat</label>
				<div class="col-sm-4">
					<input type="text" readonly class="form-control" value="{{ $karyawan->alamat }}" >
				</div>
			</div>

			<div class="page-header">
				<h4><strong>Fungsi Kerja</strong></h4>
			</div>

			<div class="form-group">
				<label class='col-sm-2'>Kode Sales</label>
				<div class="col-sm-4">
					<input type="text" name="kode_sales" class="form-control" value="{{ $row->kode_sales }}" required >
				</div>
			</div>

			<div class="form-group">
				<label class='col-sm-2'>Job Title</label>
				<div class="col-sm-4">
					<select disabled class="form-control" name='id_role' required >
						<option value="">** Pilih Job Title</option>
						@php $role = getData('role',NULL,'nama asc'); @endphp
						@foreach($role as $r)
							<option {{$row->id_role==$r->id?"selected":""}} value="{{$r->id}}">
								{{$r->nama}}
							</option>
						@endforeach
					</select>
					<input type="hidden" name="id_role" value="{{$row->id_role}}">
				</div>
			</div>
        </div>
        <!--end-area-mr-->

        <div class="panel-body">
			<div class="page-header">
				<h4><strong>Akun Aplikasi</strong></h4>
			</div>

			<div class="form-group">
				<label class='col-sm-2'>Login ID (Username)</label>
				<div class="col-sm-4">
				<input type="text" name="username" class="form-control" value="{{ $row->username }}" required >
				</div>
			</div>

			<div class="form-group">
				<label class='col-sm-2'>Password</label>
				<div class="col-sm-4">
					<input type="password" name="password" class="form-control" >
					<div class="help-block">Kosongi jika tidak mengganti password</div>
				</div>
			</div>

		</div>
		<div class="panel-footer" align="right">
			<a href="{{action('AdminUserController@getIndex')}}" class="btn btn-default">Back</a>
			<input type="submit" class="btn btn-primary" name="submit" value="Simpan Data">
		</div>
		</form>
	</div>
</section>
<!-- /.content -->

@endsection
