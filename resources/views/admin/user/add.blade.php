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

			<div style="display: none" class="additional-input" id="area-mr">
				<div class="form-group">
					<label class='col-sm-2'>Area (Berdasarkan AM)</label>
					<div id='area-berdasar-am' class="col-sm-4">
						<div class="input-group">
							<input readonly type="text" class="form-control required" id="role_mr_kode_sales">
							<div class="input-group-btn">
								<button type="button" class="btn btn-default" onclick="showPickAm()"><i class="fa fa-search"></i> Pick</button>
							</div>	
						</div>
						
						<input type="hidden" class="input-id-area" name="role_mr_id_area">
						<input type="hidden" class="input-id-atasan-am" name="role_mr_id_atasan_am">
					</div>
				</div>

				@push('scripts')
				<script type="text/javascript">
					$(function() {
						$('#role_mr_kode_sales').change(function() {
							console.log('#role_mr_kode_sales event changed');
							var id_area = $('input[name=role_mr_id_area]').val();
							if(id_area=='') return false;
							$('select[name=role_mr_id_kota]').html('<option value="">Memuat data...</option>');							
							var opt = "<option value=''>** Pilih Kota</option>";
							$.get("{{action('AdminUserController@getKotaByArea')}}/"+id_area,function(r) {
								if(r.length>0) {									
									$.each(r,function(i,o) {										
										opt += "<option value='"+o.id+"'>"+o.nama+"</option>";
									})
									$('select[name=role_mr_id_kota]').html(opt);									
								}else{
									$('select[name=role_mr_id_kota]').html("<option value=''>- Kosong -</option>");
									$('select[name=role_mr_id_teritorial]').html('<option value="">** Pilih Teritorial</option>');
								}
							})							
						})
					})
				</script>
				@endpush

				<div class="form-group">
					<label class='col-sm-2'>Kota PHS</label>
					<div class="col-sm-4">
						<select class="form-control required" name='role_mr_id_kota' >
							<option value="">** Pilih Kota</option>							
						</select>
					</div>
				</div>

				@push('scripts')
				<script type="text/javascript">
					$(function() {
						$('select[name=role_mr_id_kota]').change(function() {
							var id_kota = $(this).val();
							console.log('role_mr_id_kota changed '+id_kota);
							if(!id_kota) {
								$('select[name=role_mr_id_teritorial]').html('<option value="">** Pilih Teritorial</option>');
								return false;							
							}

							$('select[name=role_mr_id_teritorial]').html('<option value="">Memuat data...</option>');														 
							$.get("{{action('AdminUserController@getTeritorialByKota')}}/"+id_kota,function(r) {
								if(r.length>0) {
									var opt = "<option value=''>** Pilih Teritorial</option>";
									$.each(r,function(i,o) {										
										opt += "<option value='"+o.id+"'>"+o.kode+" - "+o.nama+"</option>";
									})
									$('select[name=role_mr_id_teritorial]').html(opt);									
								}else{
									$('select[name=role_mr_id_teritorial]').html("<option value=''>- Kosong -</option>");
								}
							})
						})
					})
				</script>
				@endpush

				<div class="form-group">
					<label class='col-sm-2'>Kode Teritorial</label>
					<div class="col-sm-4">
						<select class="form-control required" name='role_mr_id_teritorial' >
							<option value="">** Pilih Teritorial</option>							
						</select>
					</div>
				</div>

				@push('scripts')
				<script type="text/javascript">
					$(function() {
						$('select[name=role_mr_id_teritorial]').change(function() {
							var id_teritorial = $(this).val();
							if(!id_teritorial) {
								$('#role_mr_produk_group').html("- Kosong -");
								return false;
							}
							$.get("{{action('AdminUserController@getProdukGroupByTeritorial')}}/"+id_teritorial,function(r) {
								if(r.length>0) {
									var opt = "";
									$.each(r,function(i,o) {										
										opt += "<div class='checkbox'>"+
										"<label><input type='checkbox' name='role_mr_produk_group[]' value='"+o.id+"' checked/> "+o.nama+"</label>"+
										"</div>";
									})
									$('#role_mr_produk_group').html(opt);									
								}else{
									$('#role_mr_produk_group').html("- Kosong -");
								}
							})
						})
					})
				</script>
				@endpush

				@push('scripts')
				<script type="text/javascript">
					$(function() {
						$('select[name=role_mr_id_teritorial]').change(function() {
							var id_teritorial = $(this).val();
							if(!id_teritorial) return false;
							$('select[name=mutasi_mr_id_mr]').html('<option value="">Memuat data...</option>');							
							var opt = "<option value=''>** MR BARU</option>";
							$.get("{{action('AdminUserController@getExistingMr')}}/"+id_teritorial,function(r) {
								if(r.length>0) {
									$.each(r,function(i,o) {										
										opt += "<option value='"+o.id+"'>"+o.kode_sales+' - '+o.karyawan_nama+"</option>";
									})
									$('select[name=mutasi_mr_id_mr]').html(opt);									
								}else{
									$('select[name=mutasi_mr_id_mr]').html("<option value=''>** MR BARU</option>");
								}
							})
						})
					})
				</script>
				@endpush

				<div class="form-group">
					<label class='col-sm-2'>Produk</label>
					<div class="col-sm-4" id="role_mr_produk_group">
						
					</div>
				</div>

				<div class="form-group">
					<label class='col-sm-2'>MR Satelite</label>
					<div class="col-sm-4">
						<label class="radio-inline">
							<input type="radio" name="role_mr_is_mr_satelite" value="1"> Ya
						</label>
						<label class="radio-inline">
							<input type="radio" name="role_mr_is_mr_satelite" checked value="0"> Tidak
						</label>
					</div>
				</div>

				<div class="page-header">
					<h4><strong>Mutasi MR</strong></h4>
				</div>

				<div class="form-group">
					<label class='col-sm-2'>MR Lama</label>
					<div class="col-sm-4">
						<select class="form-control" name='mutasi_mr_id_mr' >
							<option value="">** Pilih MR</option>							
						</select>
					</div>
				</div>

				@push('scripts')
				<script type="text/javascript">
				try{
					$(function() {
						$('select[name=mutasi_mr_id_mr]').change(function() {
							var id_mr = $(this).val();
							if(!id_mr) return false;
							$('select[name=mutasi_mr_tahun]').html('<option value="">Memuat data...</option>');
							$.get("{{action('AdminUserController@getVisitPlanMr')}}/"+id_mr,function(r) {
								if(r.length>0) {
									var opt = '';
									$.each(r,function(i,o) {										
										opt += "<option value='"+o.tahun_bulan+"'>"+o.tahun_bulan+"</option>";
									})
									$('select[name=mutasi_mr_tahun]').html(opt);

									var opt = '';
									$.each(r,function(i,o) {										
										opt += "<option value='"+o.bulan_ke+"'>"+o.bulan_ke+"</option>";
									})
									$('select[name=mutasi_mr_bulan]').html(opt);									
								}else{
									$('select[name=mutasi_mr_tahun]').html("<option value=''>- Kosong -</option>");
									$('select[name=mutasi_mr_bulan]').html("<option value=''>- Kosong -</option>");
								}
							})
						})
					})
				}catch(err) {
					swal('Oops',err,'warning');
				}
				</script>
				@endpush

				<div class="form-group">
					<label class='col-sm-2'>Tahun</label>
					<div class="col-sm-4">
						<select class="form-control" name='mutasi_mr_tahun' >
							<option value="">** Pilih Tahun</option>							
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class='col-sm-2'>Bulan</label>
					<div class="col-sm-4">
						<select class="form-control" name='mutasi_mr_bulan' >
							<option value="">** Pilih Bulan</option>							
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class='col-sm-2'>Pindahkan Plan Sales & Kunjungan</label>
					<div class="col-sm-4">
						<label class="radio-inline">
							<input type="radio" name="mutasi_mr_pindah_plan" value="1"> Ya
						</label>
						<label class="radio-inline">
							<input type="radio" name="mutasi_mr_pindah_plan" checked value="0"> Tidak
						</label>
					</div>
				</div>

			</div>
			<!--end-area-mr-->

			<div style="display: none" class="additional-input" id="area-am">
				<div class="form-group">
					<label class='col-sm-2'>Devisi</label>
					<div class="col-sm-4">
						<select class="form-control required" name='role_am_id_devisi' >
							<option value="">** Pilih Devisi</option>
							@php $data = getData('devisi',NULL,'nama asc'); @endphp
							@foreach($data as $r)
								<option value="{{$r->id}}">
									{{$r->nama}}
								</option>
							@endforeach
						</select>
					</div>
				</div>

				@push('scripts')
				<script type="text/javascript">
					$(function() {
						$('select[name=role_am_id_area]').change(function() {
							var idAm = $(this).val();
							if(!idAm) return false;
							$('select[name=mutasi_am_id_am]').html('<option value="">Memuat data...</option>');							
							var opt = "<option value=''>** AM BARU</option>";
							$.get("{{action('AdminUserController@getExistingAm')}}/"+idAm,function(r) {
								if(r.length>0) {
									$.each(r,function(i,o) {										
										opt += "<option value='"+o.id+"'>"+o.kode_sales+' - '+o.karyawan_nama+"</option>";
									})
									$('select[name=mutasi_am_id_am]').html(opt);									
								}else{
									$('select[name=mutasi_am_id_am]').html("<option value=''>** AM BARU</option>");
								}
							})
						})
					})
				</script>
				@endpush

				<div class="form-group">
					<label class='col-sm-2'>Area</label>
					<div class="col-sm-4">
						<select class="form-control required" name='role_am_id_area' >
							<option value="">** Pilih Area</option>
							@php $data = getData('area',NULL,'nama asc'); @endphp
							@foreach($data as $r)
								<option value="{{$r->id}}">
									{{$r->nama}}
								</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="page-header">
					<h4><strong>Mutasi AM</strong></h4>
				</div>

				<div class="form-group">
					<label class='col-sm-2'>AM Lama</label>
					<div class="col-sm-4">
						<select class="form-control" name='mutasi_am_id_am' >
							<option value="">** Pilih AM</option>							
						</select>
					</div>
				</div>

				@push('scripts')
				<script type="text/javascript">
				try{
					$(function() {
						$('select[name=mutasi_am_id_am]').change(function() {
							var idAm = $(this).val();
							if(!idAm) return false;
							$('select[name=mutasi_am_tahun]').html('<option value="">Memuat data...</option>');
							$.get("{{action('AdminUserController@getVisitPlanAm')}}/"+idAm,function(r) {
								if(r.length>0) {
									var opt = '';
									$.each(r,function(i,o) {										
										opt += "<option value='"+o.tahun_bulan+"'>"+o.tahun_bulan+"</option>";
									})
									$('select[name=mutasi_am_tahun]').html(opt);

									var opt = '';
									$.each(r,function(i,o) {										
										opt += "<option value='"+o.bulan_ke+"'>"+o.bulan_ke+"</option>";
									})
									$('select[name=mutasi_am_bulan]').html(opt);									
								}else{
									$('select[name=mutasi_am_tahun]').html("<option value=''>- Kosong -</option>");
									$('select[name=mutasi_am_bulan]').html("<option value=''>- Kosong -</option>");
								}
							})
						})
					})
				}catch(err) {
					swal('Oops',err,'warning');
				}
				</script>
				@endpush

				<div class="form-group">
					<label class='col-sm-2'>Tahun</label>
					<div class="col-sm-4">
						<select class="form-control" name='mutasi_am_tahun' >
							<option value="">** Pilih Tahun</option>							
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class='col-sm-2'>Bulan</label>
					<div class="col-sm-4">
						<select class="form-control" name='mutasi_am_bulan' >
							<option value="">** Pilih Bulan</option>							
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class='col-sm-2'>Pindahkan Plan Sales & Kunjungan</label>
					<div class="col-sm-4">
						<label class="radio-inline">
							<input type="radio" name="mutasi_am_pindah_plan" value="1"> Ya
						</label>
						<label class="radio-inline">
							<input type="radio" name="mutasi_am_pindah_plan" checked value="0"> Tidak
						</label>
					</div>
				</div>


			</div>
			<!--end-area-am-->

			<div style="display: none" class="additional-input" id="area-sm">
				<div class="form-group">
					<label class='col-sm-2'>Wilayah / Regional</label>
					<div class="col-sm-4">
						<select class="form-control required" name='role_sm_id_region' >
							<option value="">** Pilih Regional</option>							
							@php $data = getData('region',NULL,'nama asc'); @endphp
							@foreach($data as $d)
								<option value="{{$d->id}}">{{$d->nama}}</option>
							@endforeach
						</select>
					</div>
				</div>

				@push('scripts')
				<script type="text/javascript">
					$(function() {
						$('select[name=role_sm_id_region]').change(function() {
							var id_region = $(this).val();
							if(!id_region) return false;
							$('select[name=mutasi_sm_id_sm]').html('<option value="">Memuat data...</option>');							
							var opt = "<option value=''>** SM BARU</option>";
							$.get("{{action('AdminUserController@getExistingSm')}}/"+id_region,function(r) {
								if(r.length>0) {
									$.each(r,function(i,o) {										
										opt += "<option value='"+o.id+"'>"+o.kode_sales+' - '+o.karyawan_nama+"</option>";
									})
									$('select[name=mutasi_sm_id_sm]').html(opt);									
								}else{
									$('select[name=mutasi_sm_id_sm]').html("<option value=''>** SM BARU</option>");
								}
							})
						})
					})
				</script>
				@endpush

				<div class="page-header">
					<h4><strong>Mutasi SM</strong></h4>
				</div>

				<div class="form-group">
					<label class='col-sm-2'>SM Lama</label>
					<div class="col-sm-4">
						<select class="form-control" name='mutasi_sm_id_sm' >
							<option value="">** Pilih SM</option>							
						</select>
					</div>
				</div>

			</div>
			<!--end-area-sm--> 

			<div style="display: none" class="additional-input" id="area-pm">
				<div class="form-group">
					<label class='col-sm-2'>Produk Group</label>
					<div class="col-sm-4" id="role_pm_produk_group">						
							@php $data = getData('produk_group',NULL,'nama asc'); @endphp
							@foreach($data as $d)
								<div class="checkbox">
									<label>
										<input type="checkbox" name="role_pm_produk_group[]" value="{{$d->id}}" checked> {{$d->nama}}
									</label>
								</div>
							@endforeach						
					</div>
				</div>
			</div>
			<!--end-area-pm-->

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
					<input type="password" value="{{ old('ulangi_password')?:'abc123' }}" required name="ulangi_password" class="form-control" >
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

@push('scripts')		

	<link rel="stylesheet" type="text/css" href="{{asset('css')}}/plugins/datatables/jquery.dataTables.min.css">
	<script type="text/javascript" src="{{asset('css')}}/plugins/datatables/jquery.dataTables.min.js"></script>
	<link rel="stylesheet" type="text/css" href="{{asset('css')}}/plugins/datatables/dataTables.bootstrap.css">
	<script type="text/javascript" src="{{asset('css')}}/plugins/datatables/dataTables.bootstrap.min.js"></script>

	<script type="text/javascript">
		$(function() {
			$('#table-pick-am').DataTable();
			$(document).on('click','.btnPilihAM',function() {
				var id = $(this).data('id');
				var kode_sales = $(this).data('kode_sales');
				var id_area = $(this).data('id_area');
				$('input[name=role_mr_id_area]').val(id_area);
				$('input[name=role_mr_id_atasan_am]').val(id);
				$('#role_mr_kode_sales').val(kode_sales);
				$('#role_mr_kode_sales').trigger('change');				
				$('#modal-pick-am').modal('hide');
				console.log('Click btnPilihAM');
			})
		})
		function showPickAm() {
			$('#modal-pick-am').modal('show');			
		}
	</script>

	<div id='modal-pick-am' class="modal fade" tabindex="-1" role="dialog">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Daftar Karyawan AM</h4>
	      </div>
	      <div class="modal-body">
	        <table id='table-pick-am'>
	        	<thead>
	        		<tr>
	        			<th>Kode</th>
	        			<th>Nama</th>
	        			<th>Devisi</th>
	        			<th>Area</th>
	        			<th>Pilih</th>
	        		</tr>
	        	</thead>
	        	<tbody>
	        		<?php 
	        			$data = getAM();	        			
	        		?>
	        		@foreach($data as $d)
	        		<tr>
	        			<td>{{$d->kode_sales}}</td>
	        			<td>{{$d->karyawan_nama}}</td>
	        			<td>{{$d->devisi_nama}}</td>
	        			<td>{{$d->area_nama}}</td>
	        			<td>
	        				<a class="btn btn-info btnPilihAM" data-id='{{$d->id}}' data-id_area='{{$d->id_area}}' data-kode_sales='{{$d->kode_sales}}' href="javascript:;">Pilih</a>
	        			</td>
	        		</tr>
	        		@endforeach
	        	</tbody>
	        </table>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>	        
	      </div>	      
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
@endpush
<!-- /.content -->

@endsection