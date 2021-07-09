@extends('admin.layout')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Kota Reguler   
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url(config('app.adminPath'))}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li>Master</li>
    <li class="active">Kota Reguler</li>
  </ol>
</section>
  
<!-- Main content -->
<section class="content"> 
	{!! bootstrapAlert() !!}
	<div class="panel panel-default">
		<div class="panel-heading">Tambah Data</div>

		<form method="post" action="" enctype="multipart/form-data">
		{!! csrf_field() !!}
		<div class="panel-body">
			
			<div class="form-group">
				<label>Nama Kota</label>
				<input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required >				
			</div>

			<div class="form-group">
				<label>Provinsi</label>
				<select class="form-control" name="id_provinsi">
					<option value="">** Pilih Provinsi</option>
					@php $provinsi = DB::table('provinsi')->orderby('nama','asc')->get(); @endphp
					@foreach($provinsi as $p)
						<option value="{{$p->id}}">{{$p->nama}}</option>
					@endforeach
				</select>
			</div>

		</div>
		<div class="panel-footer" align="right">
			<a href="{{action('AdminKotaRegulerController@getIndex')}}" class="btn btn-default">Back</a>
			<input type="submit" class="btn btn-primary" name="submit" value="Tambah Data">
		</div>
		</form>
	</div>
</section>
<!-- /.content -->

@endsection