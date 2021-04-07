@extends('admin.layout')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Mutasi    
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li>User</li>
    <li class="active">Mutasi</li>
  </ol>
</section>
  
<!-- Main content -->
<section class="content"> 
	{!! bootstrapAlert() !!}
	<div class="panel panel-default">
		<div class="panel-heading">Mutasi</div>

		<form method="post" class="form-horizontal" action="" enctype="multipart/form-data">
		{!!csrf_field()!!}
		<div class="panel-body">

			<div class="page-header">
				<h4><i class="fa fa-user"></i> User Yang Dimutasi</h4>
			</div>
			
			<div class="form-group">
				<label class='col-sm-2'>Nama Lengkap</label>
				<div class="col-sm-4">
					<input type="text" readonly class="form-control" value="{{ $karyawan->nama_lengkap }}" required >				
				</div>
			</div>

			<div class="form-group">
				<label class='col-sm-2'>Jabatan</label>
				<div class="col-sm-4">
					<input type="text" readonly class="form-control" value="{{ $jabatan }}" required >				
				</div>
			</div>

			<div class="form-group">
				<label class='col-sm-2'>Alamat</label>
				<div class="col-sm-4">
					<input type="text" readonly class="form-control" value="{{ $karyawan->alamat }}" required >				
				</div>
			</div>

			<div class="page-header">
				<h4><i class="fa fa-mail-forward"></i> Dimutasi Ke</h4>
			</div>


			<div class="form-group">
				<label class='col-sm-2'>Regional</label>
				<div class="col-sm-4">
					<select id='id_region' class="form-control" name='id_region' required >
						<option value="">** Pilih Regional</option>
						@php $region = getData('region',NULL,'nama asc'); @endphp
						@foreach($region as $r)
							<option value="{{$r->id}}">
								{{$r->nama}}
							</option>
						@endforeach
					</select>
				</div>
			</div>
 
			<div class="form-group {{ (!in_array($jabatan,['MR','AM']))?'hide':'' }}">
				<label class='col-sm-2'>Area</label>
				<div class="col-sm-4">
					<select id='id_area' class="form-control" name='id_area' required >
						<option value="">** Pilih Area</option>
						
					</select> 
				</div>
			</div>			

			<div class="form-group {{ ($jabatan != 'MR')?'hide':'' }}">
				<label class='col-sm-2'>Subarea</label>
				<div class="col-sm-4">
					<select id='id_subarea' class="form-control" name='id_subarea' required >
						<option value="">** Pilih Subarea</option>
						
					</select>
				</div>
			</div>			

			<div class="form-group {{ ($jabatan != 'MR')?'hide':'' }}">
				<label class="col-sm-2">Existing MR</label>
				<div class="col-sm-4">
					<div id="existing-mr">
						- 
					</div>
				</div>
			</div>

			<div class="form-group {{ ($jabatan != 'AM')?'hide':'' }}">
				<label class="col-sm-2">Existing AM</label>
				<div class="col-sm-4">
					<div id="existing-am">
						- 
					</div>
				</div>
			</div>

			<div class="form-group {{ ($jabatan != 'SM')?'hide':'' }}">
				<label class="col-sm-2">Existing SM</label>
				<div class="col-sm-4">
					<div id="existing-sm">
						- 
					</div>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2">Catatan Mutasi</label>
				<div class="col-sm-4">
					<textarea class="form-control" name="catatan_mutasi" required ></textarea>
				</div>
			</div>

			

			@push('scripts')
				<script type="text/javascript">	
					var cur_id_region = "";				
					var cur_id_area = "";
					var cur_id_subarea = "";

					function comboArea(id_region) {
						$('#id_area').html('<option value="">Memuat data...</option>');
						var opt = "<option value=''>** Pilih Area</option>";
						$.get("{{action('AdminUserController@getArea')}}/"+id_region,function(r) {
							if(r) {
								$.each(r,function(i,o) {
									var selected = (o.id == cur_id_area)?"selected":"";
									opt += "<option "+selected+" value='"+o.id+"'>"+o.nama+"</option>";
								})
								$('#id_area').html(opt);
								$('#id_area').trigger('change');
							}
						})						
					}

					function comboSubarea(id_area) {
						if(!id_area) return false;

						$('#id_subarea').html('<option value="">Memuat data...</option>');
						var opt = "<option value=''>** Pilih Subarea</option>";
						$.get("{{action('AdminUserController@getSubarea')}}/"+id_area,function(r) {
							if(r) {
								$.each(r,function(i,o) {
									var selected = (o.id == cur_id_subarea)?"selected":"";
									opt += "<option "+selected+" value='"+o.id+"'>"+o.nama+"</option>";
								})
								$('#id_subarea').html(opt);
							}
						})						
					}
					
					$(function() {
						$('#id_region').change(function() {
							comboArea( $(this).val() ); 

							var id_region = $(this).val();
							$.get("{{action('AdminUserController@getExistingSm')}}/"+id_region,function(r) {
								if(r.status==1) {
									$('#existing-sm').text(r.data.karyawan_nama);
								}else{
									$('#existing-sm').text('-');
								}
							})
						})
						$('#id_area').change(function() {
							comboSubarea( $(this).val() );	
							var id_area = $(this).val();
							$.get("{{action('AdminUserController@getExistingAm')}}/"+id_area,function(r) {
								if(r.status==1) {
									$('#existing-am').text(r.data.karyawan_nama);
								}else{
									$('#existing-am').text('-');
								}
							})					
						})			
						$('#id_subarea').change(function() {
							var id_subarea = $(this).val();
							$.get("{{action('AdminUserController@getExistingMr')}}/"+id_subarea,function(r) {
								if(r.status==1) {
									$('#existing-mr').text(r.data.karyawan_nama);
								}else{
									$('#existing-mr').text('-');
								}
							})
						})

						if(cur_id_region) {
							comboArea( cur_id_region );
						}	
					})
				</script>
			@endpush

			
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