@extends('admin.layout')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Karyawan    
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url(config('app.adminPath'))}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li>Master</li>
    <li class="active">Karyawan</li>
  </ol>
</section>
  
<!-- Main content -->
<section class="content"> 
	{!! bootstrapAlert() !!}
	<div class="panel panel-default">
		<div class="panel-heading">Tambah Data</div>

		<form method="post" class="form-horizontal" action="" enctype="multipart/form-data">
		{!! csrf_field() !!}
		<div class="panel-body">
			
			<div class="form-group">
				<label class="control-label col-sm-2">NIK</label>
				<div class="col-sm-10">					
					<input type="text" name="kode" class="form-control" value="{{ old('kode')?old('kode'):date('Y').add_zero($nik) }}" required >				
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2">Foto</label>
				<div class="col-sm-10">										
					<input type="file" name="foto" class="form-control">
					<div class="help-block">
						Format jpg,jpeg,png,gif
					</div>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2">Nama Lengkap</label>
				<div class="col-sm-10">					
					<input type="text" name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap') }}" required >				
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2">Jenis Kelamin</label>
				<div class="col-sm-10">					
					<label class="radio-inline">
						<input type="radio" name="jenis_kelamin" value="Laki-laki"> Laki-laki
					</label>
					<label class="radio-inline">
						<input type="radio" name="jenis_kelamin" value="Perempuan"> Perempuan
					</label>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2">Tempat Lahir</label>
				<div class="col-sm-10">					
					<input type="text" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir') }}" required >				
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2">Tanggal Lahir</label>
				<div class="col-sm-10">					
					<input type="text" name="tanggal_lahir" class="form-control datepicker" value="{{ old('tanggal_lahir') }}" required >				
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2">No. Telp</label>
				<div class="col-sm-10">					
					<input type="number" name="no_telp" class="form-control" value="{{ old('no_telp') }}" required >				
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2">Email</label>
				<div class="col-sm-10">					
					<input type="email" name="email" class="form-control" value="{{ old('email') }}" required >				
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2">Alamat</label>
				<div class="col-sm-10">					
					<input type="text" name="alamat" class="form-control" value="{{ old('alamat') }}" required >				
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2">Provinsi</label>
				<div class="col-sm-10">					
					<select id='id_provinsi' name="id_provinsi" required class="form-control">
						<option value="">** Pilih Provinsi</option>
						@php $provinsi = getData('provinsi',NULL,'nama asc'); @endphp
						@foreach($provinsi as $p)
							<option value="{{$p->id}}">{{$p->nama}}</option>
						@endforeach
					</select>					
				</div>
			</div>		

			<div class="form-group">
				<label class="control-label col-sm-2">Kota Reguler</label>
				<div class="col-sm-10">					
					<select id='id_kota_reguler' name="id_kota_reguler" required class="form-control">
						<option value="">** Pilih Kota Reguler</option>
					</select>					
				</div>
				@push('scripts')
					<script type="text/javascript">
						$(function() {							
							$('#id_provinsi').change(function() {
								var currentIdProvinsi = $(this).val();
								if(currentIdProvinsi) {
									var optionHtml = "<option value=''>** Pilih Kota</option>";
									$.get("{{action('AdminKaryawanController@getCariKotaReguler')}}/"+currentIdProvinsi,function(resp) {
										$.each(resp,function(i,o) {
											optionHtml += "<option value='"+o.id+"'>"+o.nama+"</option>";
										});	
										$('#id_kota_reguler').html(optionHtml);										
									})
								}
							})						
						})
					</script>
				@endpush
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2">Keterangan</label>
				<div class="col-sm-10">					
					<input type="text" name="keterangan" class="form-control" value="{{ old('keterangan') }}" required >				
				</div>
			</div>

		</div>
		<div class="panel-footer" align="right">
			<a href="{{action('AdminKaryawanController@getIndex')}}" class="btn btn-default">Back</a>
			<input type="submit" class="btn btn-primary" name="submit" value="Tambah Data">
		</div>
		</form>
	</div>
</section>
<!-- /.content -->

@endsection