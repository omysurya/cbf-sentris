<table class="table table-striped table-bordered">
<thead>
	<tr class="active">
		<th style="vertical-align: middle;text-align: center" rowspan="2">No</th>
		<th style="vertical-align: middle;text-align: center" rowspan="2">LoginID</th>
		<th style="vertical-align: middle;text-align: center" rowspan="2">Kode Sales</th>
		<th style="vertical-align: middle;text-align: center" rowspan="2">Nama</th>
		<th style="vertical-align: middle;text-align: center" rowspan="2">Position</th>
		<th style="vertical-align: middle;text-align: center" colspan="2">Area</th>						
		<th style="vertical-align: middle;text-align: center" rowspan="2">Kota</th>
		<th style="vertical-align: middle;text-align: center" rowspan="2">Teritorial</th>						
		<th style="vertical-align: middle;text-align: center" rowspan="2" style="width:20%">Fungsi</th>
	</tr>
	<tr class="active">
		<th style="vertical-align: middle;text-align: center">Kode</th>
		<th style="vertical-align: middle;text-align: center">Nama</th>
	</tr>
</thead>
<tbody>
		@foreach($result as $iAM=>$row_gpm)
		@php $noAM = (($result->currentPage() - 1 ) * $result->perPage() ) + $loop->iteration; @endphp
			<tr class="{{$row_gpm->status=='disable'?'danger':''}}">
				<td>{{ $noAM }}</td>
				<td>{{$row_gpm->username}}</td> 
				<td>{{$row_gpm->kode_sales}}</td>
				<td>{{$row_gpm->karyawan_nama}}</td>
				<td>{{$row_gpm->role_nama}}</td> 
				<td>{{$row_gpm->area_kode}}</td>
				<td>{{$row_gpm->area_nama}}</td>
				<td>-</td>
				<td>-</td>
				<td align="right"> 							
					@if(getPermission(NULL,'can_update'))<a title="Edit user" href="{{url('admin/user/edit',['id'=>$row_gpm->id])}}" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a> @endif
					@if(getPermission(NULL,'can_read'))<a title="Detail user" href="{{url('admin/user/detail',['id'=>$row_gpm->id_karyawan])}}" class="btn btn-xs btn-info"><i class="fa fa-eye"></i></a> @endif
					@if(getPermission(NULL,'can_delete'))<a title="Delete user" href="{{url('admin/user/delete',['id'=>$row_gpm->id])}}" class="btn btn-xs btn-danger confirm"><i class="fa fa-trash"></i></a> @endif

					@if(getPermission(NULL,'can_update'))
						@if($row_gpm->status=='disable')
						<a href="{{url('admin/user/active',['id'=>$row_gpm->id])}}" class="btn btn-xs btn-success confirm" title="Enable user"><i class="fa fa-check"></i></a>
						@else
						<a href="{{url('admin/user/unactive',['id'=>$row_gpm->id])}}" class="btn btn-xs btn-danger confirm" title="Disable user"><i class="fa fa-times"></i></a>
						@endif
					@endif

					@if($row_gpm->regid) 
						<a href="{{url('admin/user/logout',['id'=>$row_gpm->id])}}" class="btn btn-xs btn-warning" title="Online Terakhir {{$row_gpm->last_online_datetime}}. Klik untuk logout"><i class="fa fa-sign-out"></i></a>
					@endif
				</td>
			</tr>
			<?php if($row_gpm->status == 'disable') continue; ?>
			@php 
				$result_mr = getMRByArea($row_gpm->id_area);
			@endphp
			@foreach($result_mr as $iMR=>$row_pm)
			@php $noMR = $iMR+1; @endphp
				<tr class="{{$row_pm->status=='disable'?'danger':''}}">
					<td>{{ $noAM.'.'.$noMR }}</td>
					<td>{{$row_pm->username}}</td> 
					<td>{{$row_pm->kode_sales}}</td>
					<td>{{$row_pm->karyawan_nama}}</td>
					<td>{{$row_pm->role_nama}}</td> 
					<td>{{$row_pm->area_kode}}</td>
					<td>{{$row_pm->area_nama}}</td>
					<td>{{$row_pm->kota_nama}}</td>
					<td>{{$row_pm->teritorial_nama}}</td>
					<td align="right"> 							
						@if(getPermission(NULL,'can_update'))<a title="Edit user" href="{{url('admin/user/edit',['id'=>$row_pm->id])}}" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a> @endif
						@if(getPermission(NULL,'can_read'))<a title="Detail user" href="{{url('admin/user/detail',['id'=>$row_pm->id_karyawan])}}" class="btn btn-xs btn-info"><i class="fa fa-eye"></i></a> @endif
						@if(getPermission(NULL,'can_delete'))<a title="Delete user" href="{{url('admin/user/delete',['id'=>$row_pm->id])}}" class="btn btn-xs btn-danger confirm"><i class="fa fa-trash"></i></a> @endif

						@if(getPermission(NULL,'can_update'))
							@if($row_pm->status=='disable')
							<a href="{{url('admin/user/active',['id'=>$row_pm->id])}}" class="btn btn-xs btn-success confirm" title="Enable user"><i class="fa fa-check"></i></a>
							@else
							<a href="{{url('admin/user/unactive',['id'=>$row_pm->id])}}" class="btn btn-xs btn-danger confirm" title="Disable user"><i class="fa fa-times"></i></a>
							@endif
						@endif

						@if($row_pm->regid) 
							<a href="{{url('admin/user/logout',['id'=>$row_pm->id])}}" class="btn btn-xs btn-warning" title="Online Terakhir {{$row_pm->last_online_datetime}}. Klik untuk logout"><i class="fa fa-sign-out"></i></a>
						@endif
					</td>
				</tr>
			@endforeach
		@endforeach	
</tbody>
</table>
<p>{!! urldecode(str_replace("/?","?",$result->appends(Request::all())->render())) !!}</p>