@extends('admin.layout')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Dashboard :: Summary Visit
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url(config('app.adminPath')) }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li>Dashboard</li>
    <li class="active">Summary Visit</li>
  </ol> 
</section>

<!-- Main content -->
<section class="content">
	{!! bootstrapAlert() !!}

	<p>
		<a class="btn btn-default" href="{{ addToUrl(Request::fullUrl(),'exportXLS',1) }}">
			<i class="fa fa-download"></i> Export To XLS</a> 

			@if(
				(g('id_am') && !g('id_mr')) || 
				(getRole() == 'AM' && !g('id_mr'))
				)
				<a href="{{ Request::fullUrlWithQuery(['show_only'=>'am']) }}" class="btn btn-default {{g('show_only')=='am'?'active':''}}">{!!g('show_only')=='am'?"<i class='fa fa-check'></i>":''!!} Data Visit AM</a> 
				<a href="{{ Request::fullUrlWithQuery(['show_only'=>'']) }}" class="btn btn-default {{!g('show_only')?'active':''}}">{!! !g('show_only')?"<i class='fa fa-check'></i>":''!!} Data Visit Bawahan AM</a> 
			@endif

		{!! showFilterTeamButton('Filter','month') !!} 

		

	</p>
	
	
	<table class="table table-striped table-bordered">
		
		<tr>
			<td width="20%">Rencana Kunjungan</td>
			<td width="10px">:</td>
			<td>
				@if(@$visit_plan)
				{{$visit_plan[0]->kode?:'- Belum ada rencana kunjungan -'}}
				@else
				- ALL - 
				@endif
			</td>
		</tr>
	</table>
	

	<div class="row"> 
		<div class="col-sm-8">
			<div class="box box-default">
				<div class="box-body">
					<table class="table table-striped table-bordered">
						<thead>
							<tr>
								<th width="200px">Jenis Kunjungan</th>
								<th>Target</th>
								<th>Terealisasi</th>
								<th>Selisih</th>
								<th>Extracall</th>
								<th>Misscall Waktu</th>
							</tr>
						</thead>
						<tbody>
							@php 
								$table1 = array_splice($items,0,2); 
								$totalTarget = $totalRealisasi = 0;
								$totalExtracall = 0;
								$totalMisscallwaktu = 0;
							@endphp
							@foreach($table1 as $t)
							@php 
								$totalTarget += $t['target'];
								$totalRealisasi += $t['realisasi'];
								$totalExtracall += $t['extracall'];
								$totalMisscallwaktu += $t['misscall_waktu'];
							@endphp
							<tr>
								<td>{{ @$t['label'] }}</td>
								<td>{{ @$t['target'] }}</td>
								<td>{{ @$t['realisasi'] }}</td>
								<td>{{ @$t['selisih'] }}</td>
								<td>{{ @$t['extracall'] }}</td>
								<td>{{ @$t['misscall_waktu'] }}</td>
							</tr>
							@endforeach
							<tr>
								<td><strong>Total</strong></td>
								<td>{{$totalTarget}}</td>
								<td>{{$totalRealisasi}}</td>
								<td>{{$totalTarget-$totalRealisasi}}</td>
								<td>{{$totalExtracall}}</td>
								<td>{{$totalMisscallwaktu}}</td>
							</tr>
							<tr>
								<th colspan="4">&nbsp;</th>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="box box-default">
				<div class="box-body">
					<table class="table table-striped">
						<thead>
							<tr>
								<th colspan="3">Persetujuan</th>								
							</tr>
						</thead>
						<tbody>
							<?php 
								if(@$visit_plan) {									
									$approval = DB::table('approval_request')
									->join('user','user.id','=','to_user')
									->join('role','role.id','=','user.id_role')
									->join('karyawan','karyawan.id','=','user.id_karyawan')
									->where('id_table',$visit_plan[0]->id)
									->where('table_name','visit_plan')									
									->select('approval_request.*','karyawan.nama_lengkap as karyawan_nama')
									->whereNull('approval_request.deleted_at')
									->orderby('approval_request.id','desc')
									->take(1)
									->first();
								}else{
									$approval = null;
								}
							?>
							<tr>
								<td>Oleh</td>
								<td>:</td>
								<td>{{ ($approval)?$approval->karyawan_nama:'ALL' }}</td>
							</tr>

							<tr>
								<td>Tanggal</td>
								<td>:</td>
								<td>{{ ($approval)?$approval->created_at:'ALL' }}</td>
							</tr>

							<tr>
								<td>Status</td>
								<td>:</td>
								<td>{{ ($approval)?$approval->status:'ALL' }}</td>
							</tr>

							<tr>
								<td>Catatan</td>
								<td>:</td>
								<td>{{ ($approval)?$approval->alasan_status:'-' }}</td>
							</tr>	

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="box box-default">
		<div class="box-body">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th width="200px">Keterangan</th>
						<th>Target</th>
						<th>Realisasi</th>
						<th>Selisih</th>
						<th>Extra Call</th>
						<th>Misscall Waktu</th>
					</tr>
				</thead>
				<tbody>
					@php 
						$totalTarget = $totalRealisasi = $totalExtra = 0; 
						$table2 = array_splice($items,0);
					@endphp
					@foreach($table2 as $item)
					@php 
						@$totalTarget += intval($item['target']);
						@$totalRealisasi += intval($item['realisasi']);
						@$totalExtra += intval($item['extracall']);
					@endphp
					<tr>
						<td>{{@$item['label']}}</td>
						<td>{{@$item['target']}}</td>
						<td>{{@$item['realisasi']}}</td>
						<td>{{@$item['selisih']}}</td>
						<td>{{isset($item['extracall'])?$item['extracall']:'-'}}</td>
						<td>{{@$item['misscall_waktu']}}</td>
					</tr>
					@endforeach					
				</tbody>
				
			</table>
		</div>
	</div>

</section>
<!-- /.content -->



@endsection