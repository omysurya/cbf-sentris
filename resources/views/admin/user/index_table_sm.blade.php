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
	@foreach($result as $row)
	@php $noSM = (($result->currentPage() - 1 ) * $result->perPage() ) + $loop->iteration; @endphp
	<tr class="{{$row->status=='disable'?'danger':''}}">
		<td>{{$noSM}}</td>
		<td>{{$row->username}}</td> 
		<td>{{$row->kode_sales}}</td>
		<td>{{$row->karyawan_nama}}</td>
		<td>{{$row->role_nama}}</td> 
		<td>-</td>
		<td>-</td>
		<td>-</td>
		<td>-</td>
		<td align="right"> 							
			@if(getPermission(NULL,'can_update'))<a title="Edit user" href="{{url('admin/user/edit',['id'=>$row->id])}}" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a> @endif
			@if(getPermission(NULL,'can_read'))<a title="Detail user" href="{{url('admin/user/detail',['id'=>$row->id_karyawan])}}" class="btn btn-xs btn-info"><i class="fa fa-eye"></i></a> @endif
			@if(getPermission(NULL,'can_delete'))<a title="Delete user" href="{{url('admin/user/delete',['id'=>$row->id])}}" class="btn btn-xs btn-danger confirm"><i class="fa fa-trash"></i></a> @endif

			@if(getPermission(NULL,'can_update'))
				@if($row->status=='disable')
				<a href="{{url('admin/user/active',['id'=>$row->id])}}" class="btn btn-xs btn-success confirm" title="Enable user"><i class="fa fa-check"></i></a>
				@else
				<a href="{{url('admin/user/unactive',['id'=>$row->id])}}" class="btn btn-xs btn-danger confirm" title="Disable user"><i class="fa fa-times"></i></a>
				@endif
			@endif

			@if($row->regid) 
				<a href="{{url('admin/user/logout',['id'=>$row->id])}}" class="btn btn-xs btn-warning" title="Online Terakhir {{$row->last_online_datetime}}. Klik untuk logout"><i class="fa fa-sign-out"></i></a>
			@endif
		</td>
	</tr>
		<?php if($row->status == 'disable') continue; ?>
		@php 
			$result_am = getAMByRegion($row->id_region);
		@endphp
		@foreach($result_am as $iAM=>$row_am)
		@php $noAM = $iAM+1; @endphp
			<tr class="{{$row_am->status=='disable'?'danger':''}}">
				<td>{{ $noSM.'.'.$noAM }}</td>
				<td>{{$row_am->username}}</td> 
				<td>{{$row_am->kode_sales}}</td>
				<td>{{$row_am->karyawan_nama}}</td>
				<td>{{$row_am->role_nama}}</td> 
				<td>{{$row_am->area_kode}}</td>
				<td>{{$row_am->area_nama}}</td>
				<td>-</td>
				<td>-</td>
				<td align="right"> 							
					@if(getPermission(NULL,'can_update'))<a title="Edit user" href="{{url('admin/user/edit',['id'=>$row_am->id])}}" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a> @endif
					@if(getPermission(NULL,'can_read'))<a title="Detail user" href="{{url('admin/user/detail',['id'=>$row_am->id_karyawan])}}" class="btn btn-xs btn-info"><i class="fa fa-eye"></i></a> @endif
					@if(getPermission(NULL,'can_delete'))<a title="Delete user" href="{{url('admin/user/delete',['id'=>$row_am->id])}}" class="btn btn-xs btn-danger confirm"><i class="fa fa-trash"></i></a> @endif

					@if(getPermission(NULL,'can_update'))
						@if($row_am->status=='disable')
						<a href="{{url('admin/user/active',['id'=>$row_am->id])}}" class="btn btn-xs btn-success confirm" title="Enable user"><i class="fa fa-check"></i></a>
						@else
						<a href="{{url('admin/user/unactive',['id'=>$row_am->id])}}" class="btn btn-xs btn-danger confirm" title="Disable user"><i class="fa fa-times"></i></a>
						@endif
					@endif

					@if($row_am->regid) 
						<a href="{{url('admin/user/logout',['id'=>$row_am->id])}}" class="btn btn-xs btn-warning" title="Online Terakhir {{$row_am->last_online_datetime}}. Klik untuk logout"><i class="fa fa-sign-out"></i></a>
					@endif
				</td>
			</tr>
			<?php if($row_am->status == 'disable') continue; ?>
			@php 
				$result_mr = getMRByArea($row_am->id_area);
			@endphp
			@foreach($result_mr as $iMR=>$row_mr)
			@php $noMR = $iMR+1; @endphp
				<tr class="{{$row_mr->status=='disable'?'danger':''}}">
					<td>{{ $noSM.'.'.$noAM.'.'.$noMR }}</td>
					<td>{{$row_mr->username}}</td> 
					<td>{{$row_mr->kode_sales}}</td>
					<td>{{$row_mr->karyawan_nama}}</td>
					<td>{{$row_mr->role_nama}}</td> 
					<td>{{$row_mr->area_kode}}</td>
					<td>{{$row_mr->area_nama}}</td>
					<td>{{$row_mr->kota_nama}}</td>
					<td>{{$row_mr->teritorial_nama}}</td>
					<td align="right"> 							
						@if(getPermission(NULL,'can_update'))<a title="Edit user" href="{{url('admin/user/edit',['id'=>$row_mr->id])}}" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a> @endif
						@if(getPermission(NULL,'can_read'))<a title="Detail user" href="{{url('admin/user/detail',['id'=>$row_mr->id_karyawan])}}" class="btn btn-xs btn-info"><i class="fa fa-eye"></i></a> @endif
						@if(getPermission(NULL,'can_delete'))<a title="Delete user" href="{{url('admin/user/delete',['id'=>$row_mr->id])}}" class="btn btn-xs btn-danger confirm"><i class="fa fa-trash"></i></a> @endif

						@if(getPermission(NULL,'can_update'))
							@if($row_mr->status=='disable')
							<a href="{{url('admin/user/active',['id'=>$row_mr->id])}}" class="btn btn-xs btn-success confirm" title="Enable user"><i class="fa fa-check"></i></a>
							@else
							<a href="{{url('admin/user/unactive',['id'=>$row_mr->id])}}" class="btn btn-xs btn-danger confirm" title="Disable user"><i class="fa fa-times"></i></a>
							@endif
						@endif

						@if($row_mr->regid) 
							<a href="{{url('admin/user/logout',['id'=>$row_mr->id])}}" class="btn btn-xs btn-warning" title="Online Terakhir {{$row_mr->last_online_datetime}}. Klik untuk logout"><i class="fa fa-sign-out"></i></a>
						@endif
					</td>
				</tr>
			@endforeach
		@endforeach
	@endforeach
</tbody>
</table>
<p>{!! urldecode(str_replace("/?","?",$result->appends(Request::all())->render())) !!}</p>