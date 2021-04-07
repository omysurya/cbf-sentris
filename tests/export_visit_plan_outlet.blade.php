<!DOCTYPE html>
<html>
<head>
	<title>Visit Plan Outlet</title>
</head>
<body>
	<p><strong>{{$visit_plan->kode}} / {{$visit_plan->nama_bulan.' / '.$visit_plan->tahun_bulan}}</strong></p>
	<table>
		<thead>
			<tr>
				<th width="3">No</th>
				<th width="25">Nama Outlet</th>				
				<th width="30">Alamat Outlet</th>				
				@for($i=1;$i<=31;$i++)
					<th width="3.15">{{ $i }}</th>
				@endfor
			</tr>
		</thead>
		<tbody>
			@php $no = 1; @endphp
			@foreach($result as $row)			
			<tr>
				<td>{{$no++}}</td>
				<td>{{$row->nama}}</td>
				<td>{{$row->alamat}}</td>				
				@for($i=1;$i<=31;$i++)
					@php @$arrayTanggal = json_decode($row->array_tanggal,true); @endphp
					<td>
						<?php echo @(in_array($i, $arrayTanggal))?1:0; ?>		
					</td>
				@endfor
			</tr>
			@endforeach
		</tbody>
	</table>
</body>
</html>