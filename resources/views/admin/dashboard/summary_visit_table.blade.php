 					<h1>Summary Visit Report</h1>
					<table class="table table-striped table-bordered" border="1" width="100%">
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


			<table class="table table-striped table-bordered" border="1" width="100%">
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