@extends('admin.layout')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Kategori Berita    
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url(config('app.adminPath'))}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li>Master</li>
    <li class="active">Kategori Berita</li>
  </ol>
</section>
  
<!-- Main content -->
<section class="content"> 
	{!! bootstrapAlert() !!}
	<div class="panel panel-default">
		<div class="panel-heading">Edit Data</div>

		<form method="post" action="" class="form-horizontal" enctype="multipart/form-data">
		{!! csrf_field() !!}
		<div class="panel-body">
			
			<div class="form-group">
				<label class="control-label col-sm-2">Nama</label>
				<div class="col-sm-10">					
					<input type="text" name="nama" maxlength="10" class="form-control" value="{{ old('nama')?:$row->nama }}" required >				
				</div>
			</div>

		</div>
		<div class="panel-footer" align="right">
			<a href="{{action('AdminBeritaKategoriController@getIndex')}}" class="btn btn-default">Back</a>
			<input type="submit" class="btn btn-primary" name="submit" value="Simpan Data">
		</div>
		</form>
	</div>
</section>
<!-- /.content -->

@endsection