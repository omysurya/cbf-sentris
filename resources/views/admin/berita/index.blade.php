@extends('admin.layout')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Berita @if(getPermission(NULL,'can_create'))<a href="{{action('AdminBeritaController@getAdd')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>@endif
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url(config('app.adminPath')) }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li>Master</li>
    <li class="active">Berita</li>
  </ol> 
</section>

<!-- Main content -->
<section class="content">
	{!! bootstrapAlert() !!}
	
	<div class="box box-default">
		<div class="box-header with-border">
			<h3 class="box-title">Data </h3>
			<div class="pull-right">
				<a href="javascript:;" onclick="showFindDataModal()" class="btn btn-sm btn-default"><i class="fa fa-search"></i> Cari Data</a>
			</div>
		</div>
		<div class="box-body table-responsive no-padding">
			<table class="table table-striped">
				<thead>
					<tr>						
						<th>Dipublish Pada</th>											
						<th>Kategori</th>
						<th>Judul</th>
						<th>Status</th>
						<th>Dipublish Oleh</th>						
						<th style="width:10%">Aksi</th></tr>
				</thead>
				<tbody>
					@foreach($result as $row)
					<tr>						
						<td>{{ $row->created_at}}</td>												
						<td>{{$row->berita_kategori_nama}}</td>
						<td>{{ str_limit($row->judul,70)}}</td>
						<td>{{$row->status}}</td>
						<td>{{$row->karyawan_nama}}</td>
						<td>
							@if(getPermission(NULL,'can_update'))<a href="{{url('admin/berita/edit',['id'=>$row->id])}}" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a> @endif
							@if(getPermission(NULL,'can_delete'))<a href="{{url('admin/berita/delete',['id'=>$row->id])}}" class="btn btn-sm btn-danger confirm"><i class="fa fa-trash"></i></a>@endif
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
	        		<label>Judul</label>
	        		<input class="form-control" type="text" name="search[berita.judul]" value="{{ @g('search')['berita.judul'] }}">
	        	</div>

	        	<div class="form-group">
	        		<label>Kategori</label>
	        		<select class="form-control" name='where[berita.id_berita_kategori]'>
	        		<option value="">** Semua Kategori</option>
	        		@php $combo = getData('berita_kategori',NULL,'nama asc'); @endphp
	        		@foreach($combo as $c)
	        			<option {{$c->id==g('where')['berita.id_berita_kategori']?"selected":""}} value="{{$c->id}}">{{$c->nama}}</option>
	        		@endforeach
	        		</select>
	        	</div>

	        	<div class="form-group">
	        		<label>Status</label>
	        		<select class="form-control" name='where[berita.status]'>
	        		<option value="">** Semua Status</option>
	        		<option {{g('where')['berita.status']=='Pending'?"selected":""}} value="Pending">Pending</option>
	        		<option {{g('where')['berita.status']=='Publish'?"selected":""}} value="Publish">Publish</option>
	        		</select>
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