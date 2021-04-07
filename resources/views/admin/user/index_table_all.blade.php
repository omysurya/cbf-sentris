<table class="table table-striped table-bordered">
				<thead>
					<tr class="active">
						<th style="vertical-align: middle;text-align: center" rowspan="2">LoginID</th>
						<th style="vertical-align: middle;text-align: center" rowspan="2">Kode Sales</th>
						<th style="vertical-align: middle;text-align: center" rowspan="2">Nama</th>
						<th style="vertical-align: middle;text-align: center" rowspan="2">Position</th>
						<th style="vertical-align: middle;text-align: center" colspan="2">Area</th>						
						<th style="vertical-align: middle;text-align: center" rowspan="2">Kota</th>
						<th style="vertical-align: middle;text-align: center" rowspan="2">Teritorial</th>						
						<th style="vertical-align: middle;text-align: center" rowspan="2" style="width:26%">Fungsi</th>
					</tr>
					<tr class="active">
						<th style="vertical-align: middle;text-align: center">Kode</th>
						<th style="vertical-align: middle;text-align: center">Nama</th>
					</tr>
				</thead>
				<tbody>
					@foreach($result as $row)
					<?php 
						$trInfo = (in_array(g('search_type'), ['SM','AM']))?"info":"";
						$trInfo = ($row->status == 'disable')?"danger":$trInfo;
					?>
					<tr class="{{$trInfo}}">
						<td>{{$row->username}}</td> 
						<td>{{$row->kode_sales}}</td>
						<td>{{$row->karyawan_nama}}</td>
						<td>{{$row->role_nama}}</td> 
						<td>{{$row->area_kode}}</td>
						<td>{{$row->area_nama}}</td>						
						<td>{{$row->kota_nama}}</td>
						<td>{{$row->teritorial_nama}}</td>						
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

					@if(in_array(g('search_type'),['SM','AM']) && $row->status=='enable')
					<?php 
						$sub = DB::table('user');
				        $sub->leftjoin('karyawan','karyawan.id','=','id_karyawan');
				        $sub->leftjoin('kota','kota.id','=','user.id_kota');
				        $sub->leftjoin('role','role.id','=','user.id_role');				        
				        $sub->leftjoin('area','area.id','=','user.id_area');
				        $sub->leftjoin('teritorial','teritorial.id','=','user.id_teritorial'); 				        
				        $sub->select('user.*',
				        	'karyawan.regid',
				        	'karyawan.kode as karyawan_kode',
				        	'karyawan.nama_lengkap as karyawan_nama',
				            'role.nama as role_nama',
				            'area.nama as area_nama',
				            'area.kode as area_kode',	
				            'teritorial.nama as teritorial_nama',			            
				            'kota.nama as kota_nama');
				        $sub->whereNull('user.deleted_at');
				        $sub->orderby('user.id','desc');

				        if(g('search_type') == 'SM') {
				        	$sub->where('role.nama','AM');
				        	$sub->where('user.id_region',$row->id_region);
				        }elseif (g('search_type') == 'AM') {
				        	$sub->where('role.nama','MR');
				        	$sub->where('user.id_area',$row->id_area);
				        }

				        $subResult = $sub->get();				        
					?>
						@foreach($subResult as $sub)							
							<tr class="{{$sub->status=='disable'?'danger':''}}">
								<td>&nbsp;&nbsp;&nbsp;{{$sub->username}}</td> 
								<td>&nbsp;&nbsp;&nbsp;{{$sub->kode_sales}}</td>
								<td>&nbsp;&nbsp;&nbsp;{{$sub->karyawan_nama}}</td>
								<td>{{$sub->role_nama}}</td> 
								<td>{{$sub->area_kode}}</td>						
								<td>{{$sub->area_nama}}</td>						
								<td>{{$sub->kota_nama}}</td>
								<td>{{$sub->teritorial_nama}}</td>
								<td align="right"> 							
 
									@if(getPermission(NULL,'can_update'))<a title="Edit user" href="{{url('admin/user/edit',['id'=>$sub->id])}}" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a> @endif
									@if(getPermission(NULL,'can_read'))<a title="Detail user" href="{{url('admin/user/detail',['id'=>$sub->id_karyawan])}}" class="btn btn-xs btn-info"><i class="fa fa-eye"></i></a> @endif
									@if(getPermission(NULL,'can_delete'))<a title="Delete user" href="{{url('admin/user/delete',['id'=>$sub->id])}}" class="btn btn-xs btn-danger confirm"><i class="fa fa-trash"></i></a> @endif

									@if(getPermission(NULL,'can_update'))
										@if($sub->status=='disable')
										<a href="{{url('admin/user/active',['id'=>$sub->id])}}" class="btn btn-xs btn-success confirm" title="Enable user"><i class="fa fa-check"></i></a>
										@else
										<a href="{{url('admin/user/unactive',['id'=>$sub->id])}}" class="btn btn-xs btn-danger confirm" title="Disable user"><i class="fa fa-times"></i></a>
										@endif
									@endif

									@if($sub->regid) 
										<a href="{{url('admin/user/logout',['id'=>$sub->id])}}" class="btn btn-xs btn-warning" title="Online Terakhir {{$sub->last_online_datetime}}. Klik untuk logout"><i class="fa fa-sign-out"></i></a>
									@endif
								</td>
							</tr>
						@endforeach
					@endif

					@endforeach
				</tbody>
			</table>
			<p>{!! urldecode(str_replace("/?","?",$result->appends(Request::all())->render())) !!}</p>