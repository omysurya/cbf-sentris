@extends('admin.layout')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Info Pusat
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url(config('app.adminPath')) }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li>Dashboard</li>
    <li class="active">Info Pusat</li>
  </ol> 
</section>

<!-- Main content -->
<section class="content">
	{!! bootstrapAlert() !!}

	<div class="box box-primary">
   <div class="box-header">
     <h3 class="box-title">{{ $row->judul }}</h3>
   </div> 
   <div class="box-body">
    <p class="text-muted">
      <i class="fa fa-user"></i> Dipublish oleh {{$row->karyawan_nama}} pada {{ date("d F Y H:i",strtotime($row->created_at)) }}
    </p>
     {!! $row->isi !!}
   </div>
   <div class="box-footer">
     <a class="btn btn-primary" href="{{ action('AdminDashboardController@getInfo') }}" title="Kembali"><i class="fa fa-arrow-left"></i> Kembali</a>
   </div>
  </div>

</section>
<!-- /.content -->

@endsection