@extends('admin.layout')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Jabatan (Role)    
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url(config('app.adminPath'))}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li>Master</li>
    <li class="active">Jabatan (Role)</li>
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
					@if(!in_array($row->nama,['MR','AM','SM','NSM','PM','GPM','DIRUT','SUPERADMIN']))		
					<input type="text" name="nama" class="form-control" value="{{ old('nama')?:$row->nama }}" required >				
					@else
					<input type="text" name="nama" readonly class="form-control" value="{{ old('nama')?:$row->nama }}" required >				
					@endif
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2">
					Hak Akses
				</label>
				<div class="col-sm-10">
						<table class="table table-striped">
							<thead>
								<tr>
									<th width="2%">No</th>
									<th>Module</th>
									<th width="50px">View</th>
									<th width="50px">Create</th>
									<th width="50px">Read</th>
									<th width="50px">Update</th>
									<th width="50px">Delete</th>
								</tr>
							</thead>
							<tbody>
								@php $i = 1; @endphp
								@foreach($modules as $m)
								<tr>
									<td>{{ $i++ }}</td>
									<td>{{ $m->nama }}</td>
									@if( substr($m->module_path,-1,1) !='#')
									<td><input type="checkbox" class='minimal' name="permission[{{$m->module_path}}][can_view]" {{getPermission($m->module_path,'can_view',$row->id)?"checked":""}} value="1"></td>
									<td><input type="checkbox" class='minimal' name="permission[{{$m->module_path}}][can_create]" {{getPermission($m->module_path,'can_create',$row->id)?"checked":""}} value="1"></td>
									<td><input type="checkbox" class='minimal' name="permission[{{$m->module_path}}][can_read]" {{getPermission($m->module_path,'can_read',$row->id)?"checked":""}} value="1"></td>
									<td><input type="checkbox" class='minimal' name="permission[{{$m->module_path}}][can_update]" {{getPermission($m->module_path,'can_update',$row->id)?"checked":""}} value="1"></td>
									<td><input type="checkbox" class='minimal' name="permission[{{$m->module_path}}][can_delete]" {{getPermission($m->module_path,'can_delete',$row->id)?"checked":""}} value="1"></td>
									@else
									<td><input type="checkbox" class='minimal' name="permission[{{$m->module_path}}][can_view]" {{getPermission($m->module_path,'can_view',$row->id)?"checked":""}} value="1"></td>
										<td colspan="4"></td>
									@endif
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
			</div>

		</div>
		<div class="panel-footer" align="right">
			<a href="{{action('AdminRoleController@getIndex')}}" class="btn btn-default">Back</a>
			<input type="submit" class="btn btn-primary" name="submit" value="Simpan Data">
		</div>
		</form>
	</div>
</section>
<!-- /.content -->

@endsection