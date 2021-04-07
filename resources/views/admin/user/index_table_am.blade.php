<?php $tahun=dateConvert(g('tanggal'),'Y'); $bulan=dateConvert(g('tanggal'),'n'); $created_at=now(); ?>
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
		@foreach($result as $iAM=>$row_am)
		@php $noAM = (($result->currentPage() - 1 ) * $result->perPage() ) + $loop->iteration; @endphp

		<?php
		if(g('search_type')=='AM' && g('fetch')=='yes')
		{
			if($row_am->status=='enable'){
				$cekam = DB::table('user_jabatan')
					->where('id_user',$row_am->id)
					->where('tahun',$tahun)
					->where('bulan',$bulan)
					->get();
   
				if(count($cekam)<1){
										
					$reg_sm = DB::table('user_view')
						->where('id',$row_am->id_sm)
						->where('status','enable')
						->select(
							'kode_sales as sm_kode',
							'karyawan_nik as sm_nik',
							'karyawan_nama as sm_nama',
							'region_nama as sm_region',
							'id_region')
						->orderby('id','DESC')
						->first();

					$uj_amid = DB::table('user_jabatan')->insertGetId([
						'created_at' => $created_at,
						'tahun' => $tahun,
						'bulan' => $bulan,
						'id_user' => $row_am->id,
						'kode_sales' => $row_am->kode_sales,
						'nik' => $row_am->karyawan_kode,
						'id_karyawan' => $row_am->id_karyawan,
						'karyawan_nama' =>$row_am->karyawan_nama,
						'id_role' =>$row_am->id_role,
						'role_nama' => $row_am->role_nama,					
						'id_region' => $reg_sm->id_region,
						'region_nama' => $reg_sm->sm_region,												
						'id_sm' => $row_am->id_sm,
						'sm_nama' => $reg_sm->sm_nama,
						'sm_nik' => $reg_sm->sm_nik,
						'sm_kode_sales' => $reg_sm->sm_kode,

						'id_area' => $row_am->id_area,
						'area_nama' => $row_am->area_nama,
						'is_active' =>1
					]);

					DB::table('user')->where('id',$row_am->id)->update(['id_user_jabatan' => $uj_amid]);
				}
			}
		}
		?>
			<tr class="{{$row_am->status=='disable'?'danger':''}}">
				<td>{{ $noAM }}</td>
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

			<?php
			if(g('search_type')=='AM' && g('fetch')=='yes')
			{  
				if($row_mr->status=='enable'){
					$cekmr = DB::table('user_jabatan')
						->where('id_user',$row_mr->id)
						->where('tahun',$tahun)
						->where('bulan',$bulan)
						->get();
					
					//Get detail SM
					$get_sm = DB::table('user_view')
						->where('id_region',$row_mr->id_region)
						->where('role_nama','SM')
						->where('status','enable')
						->select(
							'id as sm_id',
							'kode_sales as sm_kode',
							'karyawan_nik as sm_nik',
							'karyawan_nama as sm_nama',
							'region_nama as sm_region',
							'id_region')
						->orderby('id','DESC')
						->first();

					//Get detail AM
					$get_am = DB::table('user_view')
						->where('id_area',$row_mr->id_area)
						->where('role_nama','AM')
						->where('status','enable')
						->select(
							'kode_sales as am_kode',
							'id as am_id',
							'karyawan_nik as am_nik',
							'karyawan_nama as am_nama',
							'area_nama as am_area',
							'id_area'
						)
						->orderby('id','DESC')
						->first();

					if(count($cekmr)<1){
						$uj_mrid = DB::table('user_jabatan')->insertGetId([
							'created_at' => $created_at,
							'tahun' => $tahun,
							'bulan' => $bulan,
							'id_user' => $row_mr->id,
							'kode_sales' => $row_mr->kode_sales,
							'nik' => $row_mr->karyawan_kode,
							'id_karyawan' => $row_mr->id_karyawan,
							'karyawan_nama' =>$row_mr->karyawan_nama,
							'id_role' =>$row_mr->id_role,
							'role_nama' => $row_mr->role_nama,					
							'id_region' => $row_mr->id_region,														
							'id_area' => $row_mr->id_area,
							'area_nama' => $row_mr->area_nama,
							'id_teritorial' => $row_mr->id_teritorial,
							'teritorial_nama' => $row_mr->teritorial_nama,						

							'region_nama' => $get_sm->sm_region,
							'id_sm' => $get_sm->sm_id,
							'sm_nama' => $get_sm->sm_nama,
							'sm_nik' => $get_sm->sm_nik,
							'sm_kode_sales' => $get_sm->sm_kode,

							'id_am' => $get_am->am_id,
							'am_nama' => $get_am->am_nama,
							'am_nik' => $get_am->am_nik,
							'am_kode_sales' => $get_am->am_kode,
							'is_active' =>1
						]);

						DB::table('user')->where('id',$row_mr->id)->update(['id_user_jabatan' => $uj_mrid]);
					}
					
					if(count($cekmr)<=1){
						//update data yang ada
						DB::table('user_jabatan')
							->where('id_karyawan',$row_mr->id_karyawan)
							->where('id_user',$row_mr->id)
							->where('tahun',$tahun)
							->where('bulan',$bulan)
							->where('role_nama','MR')
							->update([
								'id_region' => $row_mr->id_region,														
								'id_area' => $row_mr->id_area,
								'area_nama' => $row_mr->area_nama,
								'id_teritorial' => $row_mr->id_teritorial,
								'teritorial_nama' => $row_mr->teritorial_nama,						

								'region_nama' => $get_sm->sm_region,
								'id_sm' => $get_sm->sm_id,
								'sm_nama' => $get_sm->sm_nama,
								'sm_nik' => $get_sm->sm_nik,
								'sm_kode_sales' => $get_sm->sm_kode,

								'id_am' => $get_am->am_id,
								'am_nama' => $get_am->am_nama,
								'am_nik' => $get_am->am_nik,
								'am_kode_sales' => $get_am->am_kode,
								'is_active' => 1
							]);

						//update approval
						DB::table('approval_request')
							->where('created_by_user',$row_mr->id)
							->whereYear('created_at',$tahun)
							->whereMonth('created_at',$bulan)
							->update(['to_user' => $get_am->am_id]);

						//update sales plan
						/*
						DB::table('sales_plan')
							->where('tahun_bulan',$tahun)
							->where('bulan_ke',$bulan)
							->where('id_user',$row_mr->id)
							->update(['id_am' => $get_am->am_id,
									  'id_sm' => $get_sm->sm_id
									]);
                        */
                        
						//update visit plan
						DB::table('visit_plan')
							->where('tahun_bulan',$tahun)
							->where('bulan_ke',$bulan)
							->where('id_officer',$row_mr->id)
							->update(['id_am' => $get_am->am_id,
									  'id_sm' => $get_sm->sm_id,
									  'id_supervisor' => $get_am->am_id]);
					}
				}
			}
			?>

				<tr class="{{$row_mr->status=='disable'?'danger':''}}">
					<td>{{ $noAM.'.'.$noMR }}</td>
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
</tbody>
</table>
<p>{!! urldecode(str_replace("/?","?",$result->appends(Request::all())->render())) !!}</p>