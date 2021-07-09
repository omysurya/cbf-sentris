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
		<div class="panel-heading">Detail Data</div>

		<div class="panel-body">
			<table class="table table-striped">
				<tr>
					<td width="150px">Nama Lengkap</td>
					<td width="5px">:</td>
					<td>{{$row->nama_lengkap}}</td>
				</tr>
				<tr>
					<td>Jenis Kelamin</td>
					<td>:</td>
					<td>{{$row->jenis_kelamin}}</td>
				</tr>
				<tr>
					<td>Tempat Lahir</td>
					<td>:</td>
					<td>{{$row->tempat_lahir}}</td>
				</tr>
				<tr>
					<td>Tanggal Lahir</td>
					<td>:</td>
					<td>{{$row->tanggal_lahir}}</td>
				</tr>
				<tr>
					<td>No. Telp</td>
					<td>:</td>
					<td>{{$row->no_telp}}</td>
				</tr>
				<tr>
					<td>Alamat</td>
					<td>:</td>
					<td>{{$row->alamat}}</td>
				</tr>

				<tr>
					<td>Online</td>
					<td>:</td>
					<td>{{$user->is_online?"YA":"TIDAK"}}</td>
				</tr>

				<tr>
					<td>Online Terakhir</td>
					<td>:</td>
					<td>{{$user->last_online_datetime}}</td>
				</tr>

				<tr>
					<td>Versi Aplikasi</td>
					<td>:</td>
					<td>{{$user->last_app_version?:'- Belum Ada -'}}</td>
				</tr>
				
			</table>
			<p>
				<a class="btn btn-default" href="{{action('AdminUserController@getIndex')}}">&laquo; Kembali</a>
			</p>
		</div>
	</div>
</section>
<!-- /.content -->

@endsection