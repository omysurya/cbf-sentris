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

			<div style="{{$user_role->nama!='MR'?'display: none':''}}" class="additional-input" id="area-mr">
				<div class="form-group">
					<label class='col-sm-2'>Area (Berdasarkan AM)</label>
					<div id='area-berdasar-am' class="col-sm-4">
						<div class="input-group">
							<input readonly type="text" value="{{@$atasan_am->kode_sales}}" class="form-control required" id="role_mr_kode_sales">
							<div class="input-group-btn">
								<button type="button" class="btn btn-default" onclick="showPickAm()"><i class="fa fa-search"></i> Pick</button>
							</div>	
						</div>
						
						<input type="hidden" class="input-id-area" value="{{$row->id_area}}" name="role_mr_id_area">
						<input type="hidden" class="input-id-atasan-am" value="{{$row->id_atasan_am}}" name="role_mr_id_atasan_am">
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
							@php 
								$kota = getData('kota',"id_area = '$row->id_area'","nama asc");
							@endphp						
							@foreach($kota as $k)
								<option {{$k->id==$row->id_kota?"selected":""}} value="{{$k->id}}">{{$k->nama}}</option>
							@endforeach
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
							@php $teritorial = getData('teritorial',"id_kota = '$row->id_kota'","nama asc"); @endphp
							@foreach($teritorial as $t)
								<option {{$t->id==$row->id_teritorial?"selected":""}} value="{{$t->id}}">{{$t->nama}}</option>
							@endforeach						
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
										"<label><input type='checkbox' name='role_mr_produk_group[]' value='"+o.id+"'/> "+o.nama+"</label>"+
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

				<div class="form-group">
					<label class='col-sm-2'>Produk</label>
					<div class="col-sm-4" id="role_mr_produk_group">
						<?php 
							$data = DB::table('produk_group')
							->whereNull('deleted_at')
							->select('produk_group.*',DB::raw("IFNULL((select count(id) from user_group_produk where id_user = '$row->id' and id_produk_group = produk_group.id),0) as total"))
							->get();
						?>
						@foreach($data as $d)
							<div class="checkbox">
								<label>
									<input {{$d->total!=0?"checked":""}} type="checkbox" name="role_mr_produk_group[]" value="{{$d->id}}"> {{$d->nama}}
								</label>
							</div>							
						@endforeach
					</div>
				</div>

				<div class="form-group">
					<label class='col-sm-2'>MR Satelite</label>
					<div class="col-sm-4">
						<label class="radio-inline">
							<input type="radio" {{$row->is_mr_satelite==1?"checked":""}} name="role_mr_is_mr_satelite" value="1"> Ya
						</label>
						<label class="radio-inline">
							<input type="radio" {{$row->is_mr_satelite==0?"checked":""}} name="role_mr_is_mr_satelite" value="0"> Tidak
						</label>
					</div>
				</div>

				

			</div>
			<!--end-area-mr-->

			<div style="{{$user_role->nama!='AM'?'display: none':''}}" class="additional-input" id="area-am">
				<div class="form-group">
					<label class='col-sm-2'>Devisi</label>
					<div class="col-sm-4">
						<select class="form-control required" name='role_am_id_devisi' >
							<option value="">** Pilih Devisi</option>
							@php $data = getData('devisi',NULL,'nama asc'); @endphp
							@foreach($data as $r)
								<option {{$row->id_devisi==$r->id?"selected":""}} value="{{$r->id}}">
									{{$r->nama}}
								</option>
							@endforeach
						</select>
					</div>
				</div>
				

				<div class="form-group">
					<label class='col-sm-2'>Area</label>
					<div class="col-sm-4">
						<select class="form-control required" name='role_am_id_area' >
							<option value="">** Pilih Area</option>
							@php $data = getData('area',NULL,'nama asc'); @endphp
							@foreach($data as $r)
								<option {{$row->id_area==$r->id?"selected":""}} value="{{$r->id}}">
									{{$r->nama}}
								</option>
							@endforeach
						</select>
					</div>
				</div>				


			</div>
			<!--end-area-am-->

			<div style="{{$user_role->nama!='SM'?'display: none':''}}" class="additional-input" id="area-sm">
				<div class="form-group">
					<label class='col-sm-2'>Wilayah / Regional</label>
					<div class="col-sm-4">
						<select class="form-control required" name='role_sm_id_region' >
							<option value="">** Pilih Regional</option>							
							@php $data = getData('region',NULL,'nama asc'); @endphp
							@foreach($data as $d)
								<option {{$row->id_region==$d->id?"selected":""}} value="{{$d->id}}">{{$d->nama}}</option>
							@endforeach
						</select>
					</div>
				</div>

				
			</div>
			<!--end-area-sm-->

			<div style="{{$user_role->nama!='PM'?'display: none':''}}" class="additional-input" id="area-pm">
				<div class="form-group"> 
					<label class='col-sm-2'>Produk Group</label>
					<div class="col-sm-4" id="role_pm_produk_group">
						<?php 
							$data = DB::table('produk_group')
							->whereNull('deleted_at')
							->select('produk_group.*',
								DB::raw("IFNULL((select count(id) from user_group_produk where id_user = '$row->id' and id_produk_group = produk_group.id),0) as total"))
							->get();
						?>
						@foreach($data as $d)
							<div class="checkbox">
								<label>
									<input {{$d->total!=0?"checked":""}} type="checkbox" name="role_pm_produk_group[]" value="{{$d->id}}"> {{$d->nama}}
								</label>
							</div>							
						@endforeach
					</div>
				</div>

				
			</div>
			<!--end-area-sm-->

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