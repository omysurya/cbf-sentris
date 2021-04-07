@extends('admin.layout')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Dokter    
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url(config('app.adminPath'))}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li>Master</li>
    <li class="active">Dokter</li>
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

			<!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist">
			   <li role="presentation" class="active"><a href="#detail" aria-controls="home" role="tab" data-toggle="tab">Detail</a></li>
			   <li role="presentation"><a href="#tempatpraktik" aria-controls="profile" role="tab" data-toggle="tab">Tempat Praktik</a></li>			    
			</ul> 
			<br/>

			<!-- Tab panes -->
			 <div class="tab-content">
			    <div role="tabpanel" class="tab-pane active" id="detail">
					<div class="row">

						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label col-sm-3">Kode</label>
								<div class="col-sm-9">					
									<input type="text" name="kode" class="form-control" value="{{ old('kode') }}" required >				
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3">Gelar</label>
								<div class="col-sm-9">					
									<input type="text" name="gelar" class="form-control" value="{{ old('gelar') }}" required >				
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3">Nama</label>
								<div class="col-sm-9">					
									<input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required >				
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3">Jenis Kelamin</label>
								<div class="col-sm-9">					
									<div class="radio-inline">
										<label>
											<input type="radio" name="jenis_kelamin" class="minimal" value="laki-laki"> Laki-laki
										</label>
									</div>

									<div class="radio-inline">
										<label>
											<input type="radio" name="jenis_kelamin" class="minimal" value="perempuan"> Perempuan
										</label>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3">Nomor Kontak</label>
								<div class="col-sm-9">					
									<input type="number" name="nomor_kontak" class="form-control" value="{{ old('nomor_kontak') }}" required >				
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3">Kelas</label>
								<div class="col-sm-9">					
									<select name="id_kelas" required class="form-control">
										<option value="">** Pilih Kelas</option>
										@php $combo = getData('kelas',NULL,'nama asc'); @endphp
										@foreach($combo as $w)
											<option value="{{$w->id}}">{{$w->nama}}</option>
										@endforeach
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3">Spesialis</label>
								<div class="col-sm-9">					
									<select name="id_spesialis_dokter" required class="form-control">
										<option value="">** Pilih Spesialis</option>
										@php $combo = getData('spesialis_dokter',NULL,'kode asc'); @endphp
										@foreach($combo as $w)
											<option value="{{$w->id}}">{{$w->kode}}</option>
										@endforeach
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3">Instansi / Tempat Praktik</label>
								<div class="col-sm-9">					
									<select name="id_instansi_praktik" required class="form-control">
										<option value="">** Pilih Instansi / Praktik</option>
										@php $combo = getData('instansi_praktik',NULL,'nama asc'); @endphp
										@foreach($combo as $w)
											<option value="{{$w->id}}">{{$w->nama}}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div><!--end-col-sm-6-->
							
					
					
						<div class="col-sm-6">

							<div class="form-group">
								<label class="control-label col-sm-3">Provinsi</label>
								<div class="col-sm-9">					
									<select id='id_provinsi' name="id_provinsi" required class="form-control">
										<option value="">** Pilih Provinsi</option>
										@php $combo = getData('provinsi',NULL,'nama asc'); @endphp
										@foreach($combo as $w)
											<option value="{{$w->id}}">{{$w->nama}}</option>
										@endforeach
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3">Kota</label>
								<div class="col-sm-9">					
									<select id='id_kota' name="id_kota" required class="form-control">
										<option value="">** Pilih Kota</option>
									</select>					
								</div>
								@push('scripts')
									<script type="text/javascript">
										$(function() {							
											$('#id_provinsi').change(function() {
												var currentIdProvinsi = $(this).val();
												if(currentIdProvinsi) {
													var optionHtml = "<option value=''>** Pilih Kota</option>";
													$.get("{{action('AdminDokterController@getCariKota')}}/"+currentIdProvinsi,function(resp) {
														$.each(resp,function(i,o) {
															optionHtml += "<option value='"+o.id+"'>"+o.nama+"</option>";
														});	
														$('#id_kota').html(optionHtml);										
													})
												}
											})						
										})
									</script>
								@endpush
							</div>				

							<div class="form-group">
								<label class="control-label col-sm-3">Tempat Lahir</label>
								<div class="col-sm-9">					
									<input type="text" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir') }}" required >				
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3">Tanggal Lahir</label>
								<div class="col-sm-9">					
									<input type="text" name="tanggal_lahir" class="form-control datepicker" value="{{ old('tanggal_lahir') }}" required >				
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3">Alamat Rumah</label>
								<div class="col-sm-9">					
									<input type="text" name="alamat_rumah" class="form-control" value="{{ old('alamat_rumah') }}" required >				
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3">Telp Rumah</label>
								<div class="col-sm-9">					
									<input type="number" name="telp_rumah" class="form-control" value="{{ old('telp_rumah') }}" required >				
								</div>
							</div>		
						</div><!--end-col-sm-6-->
					
					</div><!--end-row-->
				</div>
				<div role="tabpanel" class="tab-pane" id="tempatpraktik">
					<p>
						<a href="javascript:;" onclick="showAddTempatPraktik()" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Tempat Praktik</a>
					</p>
					<table id='table-tempat-praktik' class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>Nama</th>
								<th>Alamat</th>
								<th>Provinsi</th>
								<th>Kota</th>
								<th>Hapus</th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
					</table>

					@push('scripts')
					<script type="text/javascript">
						function showAddTempatPraktik() {
							$('#modal-add-tempat-praktik').modal('show');
						}
						var i = 0;
						function tambahkanTempat() {
							$('#modal-add-tempat-praktik').find('input[type=text],select').jqBootstrapValidation(); 
							
							var nama = $('#modal-add-tempat-praktik .nama').val();
							var alamat = $('#modal-add-tempat-praktik .alamat').val();
							var id_provinsi = $('#modal-add-tempat-praktik .id_provinsi').val();
							var provinsi_nama = $('#modal-add-tempat-praktik .id_provinsi option:selected').text();
							var id_kota = $('#modal-add-tempat-praktik .id_kota').val();
							var kota_nama = $('#modal-add-tempat-praktik .id_kota option:selected').text();
							$('#table-tempat-praktik tbody').append("<tr>"+
								"<td>"+nama+"<input type='hidden' name='tempat_praktik["+i+"][nama]' value='"+nama+"'/></td>"+
								"<td>"+alamat+"<input type='hidden' name='tempat_praktik["+i+"][alamat]' value='"+alamat+"'/></td>"+
								"<td>"+provinsi_nama+"<input type='hidden' name='tempat_praktik["+i+"][id_provinsi]' value='"+id_provinsi+"'/></td>"+
								"<td>"+kota_nama+"<input type='hidden' name='tempat_praktik["+i+"][id_kota]' value='"+id_kota+"'/></td>"+
								"<td><a class='fa fa-trash' href='javascript:;' onclick='hapusPraktik(this)'></a></tr>");
							i += 1; 
							$('#modal-add-tempat-praktik').find('input[type=text],select').val('');
							$('#modal-add-tempat-praktik').modal('hide');
						}
						function hapusPraktik(t) {
							$(t).parent().parent().remove();
						}
					</script>
					<script type="text/javascript">
						$(function() {							
							$('#modal-add-tempat-praktik .id_provinsi').change(function() {
								var currentIdProvinsi = $(this).val();
								if(currentIdProvinsi) {
									var optionHtml = "<option value=''>** Pilih Kota</option>";
									$.get("{{action('AdminDokterController@getCariKota')}}/"+currentIdProvinsi,function(resp) {
										$.each(resp,function(i,o) {
											optionHtml += "<option value='"+o.id+"'>"+o.nama+"</option>";
										});	
										$('#modal-add-tempat-praktik .id_kota').html(optionHtml);										
									})
								}
							})	


						})
					</script>
					<div id='modal-add-tempat-praktik' class="modal fade" tabindex="-1" role="dialog">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h4 class="modal-title">Tambah Tempat Praktik</h4>
					      </div>
					      <div class="modal-body">
					        <div class="form-group">
					        	<label>Nama Tempat</label>
					        	<input type="text" class='nama form-control'>
					        </div>

					        <div class="form-group">
					        	<label>Alamat</label>
					        	<input type="text" class='alamat form-control'>
					        </div>

					        <div class="form-group">
								<label>Provinsi</label>
								<select class="id_provinsi form-control">
									<option value="">** Pilih Provinsi</option>
									@php $combo = getData('provinsi',NULL,'nama asc'); @endphp
									@foreach($combo as $w)
										<option value="{{$w->id}}">{{$w->nama}}</option>
									@endforeach
								</select>
							</div>

							<div class="form-group">
								<label>Kota</label>
								<select class="form-control id_kota">
									<option value="">** Pilih Kota</option>
								</select>								
																
							</div>

					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
					        <button type="button" onclick="tambahkanTempat()" class="btn btn-primary">Tambahkan</button>
					      </div>
					    </div><!-- /.modal-content -->
					  </div><!-- /.modal-dialog -->
					</div><!-- /.modal -->
					@endpush

				</div><!--end-tempatpraktik-->
			 </div>
			
		</div>
		<div class="panel-footer" align="right">
			<a href="{{action('AdminDokterController@getIndex')}}" class="btn btn-default">Back</a>
			<input type="submit" class="btn btn-primary" name="submit" value="Tambah Data">
		</div>
		</form>
	</div>
</section>
<!-- /.content -->

@endsection