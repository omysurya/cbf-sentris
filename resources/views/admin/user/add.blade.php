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

	@if($user)
	<div class="alert alert-warning">
		<strong>Note</strong><br/>
		Pegawai Aktif dengan kode sales: {{$user->kode_sales}}. Jika membuat user baru maka user lama akan dikunci.
	</div>
	@endif

	<div class="panel panel-default">
		<div class="panel-heading">Tambah Data</div>

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
					<input type="text" readonly class="form-control" value="{{ $karyawan->alamat }}" required >				
				</div>
			</div>

			<div class="page-header">
				<h4><strong>Fungsi Kerja</strong></h4>
			</div>

			<div class="form-group">
				<label class='col-sm-2'>Kode Sales</label>
				<div class="col-sm-4">
					<input type="text" name="kode_sales" class="form-control" value="{{ $kode_sales }}" required >				
				</div>
			</div>

			<div class="form-group">
				<label class='col-sm-2'>Job Title</label>
				<div class="col-sm-4">
					<select class="form-control" name='id_role' required >
						<option value="">** Pilih Job Title</option>
						@php $role = getData('role',NULL,'nama asc'); @endphp
						@foreach($role as $r)
							<option value="{{$r->id}}">
								{{$r->nama}}
							</option>
						@endforeach
					</select>					
				</div>
			</div>

			<div class="page-header">
				<h4><strong>Akun Aplikasi</strong></h4>
			</div>			

			<div class="form-group">
				<label class='col-sm-2'>Login ID (Username)</label>				
				<div class="col-sm-4">
				<input type="text" name="username" class="form-control" value="{{ old('username')?:$username }}" required >
				</div>
			</div>

			<div class="form-group">
				<label class='col-sm-2'>Password</label>
				<div class="col-sm-4">
					<input type="password" value="{{ old('password')?:'abc123' }}" required name="password" class="form-control" >
					<div class="help-block">Default abc123</div>
				</div>
			</div>

			<div class="form-group">
				<label class='col-sm-2'>Ulangi Password</label>
				<div class="col-sm-4">
					<input type="password" value="{{ old('ulangi_password')?:'123456' }}" required name="ulangi_password" class="form-control" >
				</div>
			</div>

		</div>
		<div class="panel-footer" align="right">
			<a href="{{action('AdminUserController@getIndex')}}" class="btn btn-default">Back</a>
			<input type="submit" class="btn btn-primary" name="submit" value="Tambah Data">
		</div>
		</form>
	</div>
</section>

@push('scripts')
<script type="text/javascript">	
	$(function() {
		$('select[name=id_role]').change(function() {
			var roleName = $(this).find('option:selected').text().trim();
			console.log(roleName);
			$('.additional-input').hide();

			if(roleName == 'MR') {
				$('#area-mr').show();
				$('.additional-input .required').prop('required',false);
				$('#area-mr .required').prop('required',true);				
			}else if (roleName == 'AM') {
				$('#area-am').show();
				$('.additional-input .required').prop('required',false);
				$('#area-am .required').prop('required',true);				
			}else if (roleName == 'SM') {
				$('#area-sm').show();
				$('.additional-input .required').prop('required',false);
				$('#area-sm .required').prop('required',true);								
			}else if (roleName == 'PM') {
				$('#area-pm').show();
				$('.additional-input .required').prop('required',false);
				$('#area-pm .required').prop('required',true);								
			}
		})
	})
</script>
@endpush
<!-- /.content -->

@endsection