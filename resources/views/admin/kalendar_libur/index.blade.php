@extends('admin.layout')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Kalendar Libur @if(getPermission(NULL,'can_create'))<a href="{{action('AdminKalendarLiburController@getAdd')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>@endif
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url(config('app.adminPath')) }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li>Master</li>
    <li class="active">Kalendar Libur</li>
  </ol> 
</section>

<!-- Main content -->
<section class="content">
	{!! bootstrapAlert() !!}
	
	<div class="box box-default">
		<div class="box-header with-border">
			<h3 class="box-title">Kalendar Libur Data </h3>
			<div class="pull-right">
				<a href="javascript:;" onclick="showFindDataModal()" class="btn btn-sm btn-default"><i class="fa fa-search"></i> Cari Data</a>
			</div>
		</div>
		<div class="box-body table-responsive no-padding">
			<table class="table table-striped">
				<thead>
					<tr><th>Tanggal</th><th>Keterangan</th><th style="width:10%">Aksi</th></tr>
				</thead>
				<tbody>
					@foreach($result as $row)
					<tr>						
						<td>{{$row->tanggal}}</td>						
						<td>{{$row->keterangan}}</td>						
						<td>
							@if(getPermission(NULL,'can_update'))<a href="{{url('admin/kalendar-libur/edit',['id'=>$row->id])}}" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a> @endif
							@if(getPermission(NULL,'can_delete'))<a href="{{url('admin/kalendar-libur/delete',['id'=>$row->id])}}" class="btn btn-sm btn-danger confirm"><i class="fa fa-trash"></i></a>@endif
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			<p>{!! urldecode(str_replace("/?","?",$result->appends(Request::all())->render())) !!}</p>
			@if(count($result)==0)
				<div align="center" style="padding:10px"><em>Belum Ada Data</em></div>
			@endif
		</div>
	</div>

</section>
<!-- /.content -->

@push('scripts')
	<script type="text/javascript">
		function showFindDataModal() {
			$('#find-data-modal').modal('show');
		}		
	</script>
	<div id='find-data-modal' class="modal fade" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Pencarian Data</h4>
	      </div>
	      <form method="get" action="">
	      <div class="modal-body">
	        	<div class="form-group">
	        		<label>Tanggal</label>
	        		<input class="form-control datepicker" type="text" name="where[tanggal]" value="{{ @g('where')['tanggal'] }}">
	        	</div>
	        	<div class="form-group">
	        		<label>Keterangan</label>
	        		<input class="form-control" type="text" name="search[keterangan]" value="{{ @g('search')['keterangan'] }}">
	        	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
	        <button type="submit" class="btn btn-primary">Cari</button>
	      </div>
	      </form>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
@endpush

@endsection