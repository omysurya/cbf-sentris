@extends('admin.layout')
@section('content')
@push('head')
	<style type="text/css">
		#box-table-user table tr td,
		#box-table-user table tr th {
			text-overflow: ellipsis;
			white-space: nowrap;
		}
	</style>
@endpush
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    User @if(getPermission(NULL,'can_create'))<a href="javascript:;" onclick="showChooseKaryawan()" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>@endif
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url(config('app.adminPath')) }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li>Master</li>
    <li class="active">User</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
	{!! bootstrapAlert() !!}

	<form method="get" action="">
	<table class="table table-striped">
		<tr>
			<td width="100px" style="vertical-align: middle; @if(empty(g('search_type'))) display: none; @endif" class="fetch_periode">
				<input type="text" name="tanggal" data-provide="datepicker" class="form-control date" readonly="readonly" value="{{ g('tanggal')?:date('Y-m-d') }}">
			</td>
			<td style="vertical-align: middle;" width="130px">Kode / Nama Sales:</td>
			<td width="230px"><input type="text" value="{{g('search_text')}}" name="search_text" class="form-control"></td>
			<td align="left"><button class="btn btn-success" type="submit"><i class="fa fa-search"></i> Cari</button></td>
		</tr>
	</table>
	</form>

	<div class="box box-default" id='box-table-user'>
		<div class="box-header with-border">
			<h3 class="box-title">User Data </h3>
		</div>
		<div class="box-body table-responsive no-padding">
            @include('admin.user.index_table_all')
		</div>
	</div>

</section>
<!-- /.content -->


@push('scripts')

	<link rel="stylesheet" type="text/css" href="{{asset('css')}}/plugins/datatables/jquery.dataTables.min.css">
	<script type="text/javascript" src="{{asset('css')}}/plugins/datatables/jquery.dataTables.min.js"></script>
	<link rel="stylesheet" type="text/css" href="{{asset('css')}}/plugins/datatables/dataTables.bootstrap.css">
	<script type="text/javascript" src="{{asset('css')}}/plugins/datatables/dataTables.bootstrap.min.js"></script>

	<script type="text/javascript">
		$(function() {
			$('#table-choose-karyawan').DataTable( {
			    serverSide: true,
			    ajax: {
			    	type:'GET',
			    	url:"{{action('AdminUserController@getChooseKaryawan')}}"
			    }
			});
		})
		function showChooseKaryawan() {
			$('#modal-choose-karyawan').modal('show');

		}
		function pilihKaryawan(id) {
			$('#modal-choose-karyawan').modal('hide');
			location.href = "{{action('AdminUserController@getAdd')}}/"+id;
		}

		//Hide or Show fect option to table user_jabatan
		function tampilFetch(c){
			var level = $(c).val();

			if(level=='AM'){
				$(".fetch_label").show();
				$(".fetch_opsi").show();
				$(".fetch_periode").show();
			}else{
				$(".fetch_label").hide();
				$(".fetch_opsi").hide();
				$(".fetch_periode").hide();
				$(".fetch_periode").val();
			}
		}

		//Datepicker
		$.fn.datepicker.defaults.format = "yyyy-mm-dd";
		$('.datepicker').datepicker({
			format: 'yyyy-mm-dd',
			startDate: '-1d',
		});
	</script>

	<div id='modal-choose-karyawan' class="modal fade" tabindex="-1" role="dialog">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Silahkan Pilih Karyawan</h4>
	      </div>
	      <div class="modal-body">
	        <table id='table-choose-karyawan' class="table table-striped">
	        	<thead>
	        		<tr>
	        			<th width="160px">Nama</th>
	        			<th width="140px">User Terakhir</th>
	        			<th>Alamat</th>
	        			<th>Pilih</th>
	        		</tr>
	        	</thead>
	        	<tbody>

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

@endsection
