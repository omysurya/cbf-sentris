@extends('admin.layout')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Kalendar Libur    
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url(config('app.adminPath'))}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li>Master</li>
    <li class="active">Kalendar Libur</li>
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
				<label class="col-sm-2 control-label">Tanggal</label>
				<div class="col-sm-10">
					<input type="text" name="tanggal" class="form-control datepicker" value="{{ old('tanggal') }}" required >				
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label">Keterangan</label>
				<div class="col-sm-10">
					<input type="text" name="keterangan" class="form-control" value="{{ old('keterangan') }}" required >				
				</div>
			</div>

		</div>
		<div class="panel-footer" align="right">
			<a href="{{action('AdminKalendarLiburController@getIndex')}}" class="btn btn-default">Back</a>
			<input type="submit" class="btn btn-primary" name="submit" value="Tambah Data">
		</div>
		</form>
	</div>
</section>
<!-- /.content -->

@endsection