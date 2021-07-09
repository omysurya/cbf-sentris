@extends('admin.layout')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Menu <a href="{{action('AdminMenuController@getAdd')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url(config('app.adminPath')) }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li>Setting</li>
    <li class="active">Menu</li>
  </ol> 
</section>

<!-- Main content -->
<section class="content">
	{!! bootstrapAlert() !!}
	
	<div class="box box-default">
		<div class="box-header with-border">
			<h3 class="box-title">Menu Data </h3>
			
		</div>
		<div class="box-body table-responsive no-padding">
			<table class="table table-striped">
				<thead>
					<tr><th>Icon</th><th>Nama</th><th>Module Path</th><th style="width:15%">Aksi</th></tr>
				</thead>
				<tbody>
					@foreach($result as $i=>$row)
					<tr>						
						<td>{{$row->icon}}</td>						
						<td>{{$row->nama}}</td>	
						<td>{{$row->module_path}}</td>											
						<td>
							@if($i>0)
							<a class="btn btn-sm btn-primary" href="{{url('admin/menu/up',['id'=>$row->id,'parent_menu_id'=>0])}}"><i class="fa fa-arrow-up"></i></a>
							@endif
							<a class="btn btn-sm btn-primary" href="{{url('admin/menu/down',['id'=>$row->id,'parent_menu_id'=>0])}}"><i class="fa fa-arrow-down"></i></a>

							<a href="{{url('admin/menu/edit',['id'=>$row->id])}}" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
							<a href="{{url('admin/menu/delete',['id'=>$row->id])}}" class="btn btn-sm btn-danger confirm"><i class="fa fa-trash"></i></a>
						</td>
					</tr>

					@if($row->child)
						@foreach($row->child as $ii=>$c)
							<tr>						
								<td>{{$c->icon}}</td>						
								<td>- {{$c->nama}}</td>	
								<td>{{$c->module_path}}</td>											
								<td>
									@if($ii>0)
									<a class="btn btn-sm btn-primary" href="{{url('admin/menu/up',['id'=>$c->id,'parent_menu_id'=>$row->id])}}"><i class="fa fa-arrow-up"></i></a>
									@endif
									@if($ii < count($row->child)-1)
									<a title="{{count($row->child)}}" class="btn btn-sm btn-primary" href="{{url('admin/menu/down',['id'=>$c->id,'parent_menu_id'=>$row->id])}}"><i class="fa fa-arrow-down"></i></a>
									@endif
									<a href="{{url('admin/menu/edit',['id'=>$c->id])}}" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
									<a href="{{url('admin/menu/delete',['id'=>$c->id])}}" class="btn btn-sm btn-danger confirm"><i class="fa fa-trash"></i></a>
								</td>
							</tr>
							@if($c->child)
								@php $totalChild = count($c->child); @endphp
								@foreach($c->child as $iii=>$cc)
								<tr>						
									<td>{{$cc->icon}}</td>						
									<td>-- {{$cc->nama}}</td>	
									<td>{{$cc->module_path}}</td>											
									<td>
										@if($iii>0)
										<a class="btn btn-sm btn-primary" href="{{url('admin/menu/up',['id'=>$cc->id,'parent_menu_id'=>$c->id])}}"><i class="fa fa-arrow-up"></i></a>
										@endif
										@if($iii < count($c->child))
										<a class="btn btn-sm btn-primary" href="{{url('admin/menu/down',['id'=>$cc->id,'parent_menu_id'=>$c->id])}}"><i class="fa fa-arrow-down"></i></a>
										@endif
										<a href="{{url('admin/menu/edit',['id'=>$cc->id])}}" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
										<a href="{{url('admin/menu/delete',['id'=>$cc->id])}}" class="btn btn-sm btn-danger confirm"><i class="fa fa-trash"></i></a>
									</td>
								</tr>
								@endforeach
							@endif
						@endforeach
					@endif

					@endforeach
				</tbody>
			</table> 
			
		</div>
	</div>

</section>
<!-- /.content -->

@endsection