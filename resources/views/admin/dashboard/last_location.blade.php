@extends('admin.layout')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Last Position
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url(config('app.adminPath')) }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li>Dashboard</li>
    <li class="active">Last Position</li>
  </ol> 
</section>

<!-- Main content -->
<section class="content">
	{!! bootstrapAlert() !!}

	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Map</h3>
		</div>
		<div class="box-body">
				@push('scripts')
					<script type="text/javascript">
						var markersVar = {};
						var infowindow = null;
						var markers = [];	      
	      				var map = null;

						$(function() {
							$('select[name=id_region]').change(function() {
								var idRegion = $(this).val();
								$('select[name=id_area]').html("<option value=''>Memuat data...</option>");
								$.get("{{action('AdminDashboardController@getAjaxArea')}}?id_region="+idRegion,function(r) {
									if(r.length) {
										$('select[name=id_area]').html("<option value=''>** Semua Area</option>");
										var v = $('select[name=id_area]').data('value');
										$.each(r,function(i,o) {
											var selected = (v == o.id)?"selected":"";
											$('select[name=id_area]').append("<option "+selected+" value='"+o.id+"'>"+o.nama+"</option>");
										})
									}else{
										$('select[name=id_area]').html("<option value=''>Data area kosong</option>");
									}
								});
							})

							@if(g('id_region') || getRole() == 'AM' || getRole() == 'SM')
								$('select[name=id_region]').trigger('change');
							@endif
						})

						function mapPointTo(id) {
							if(!$('#trTable'+id).data('lat')) return false;

							var lat = parseFloat($('#trTable'+id).data('lat'));
							var lng = parseFloat($('#trTable'+id).data('lng'));
																					
							map.setCenter(new google.maps.LatLng(lat, lng));
							map.setZoom(17);
							google.maps.event.trigger(markersVar[id], 'click');

							$('html,body').animate({scrollTop: 0});
						}
					</script>
				@endpush
				
				<form method="get" action="">
				<table class="table">
					<tr>
						<!-- <td>
							<div class="form-group">
								<label>Lini</label>
								<select class="form-control" name="id_devisi">
									<option value="">** Semua Lini</option>
									@php
										$data = getData('devisi',NULL,'nama asc');
										$id_devisi = g('id_devisi');
										if(getRole() == 'AM') {
											$id_devisi = getUser()->id_devisi;
										}
									@endphp
									@foreach($data as $d)
										<option {{ $id_devisi==$d->id?"selected":"" }} value="{{$d->id}}">{{$d->nama}}</option>
									@endforeach
								</select>
							</div>							
						</td> -->
						<td>
							<div class="form-group">
								<label>Regional</label>
								<select class="form-control" name="id_region">
									<option value="">** Semua Regional</option>	
									@php

										$id_region = g('id_region');
										$id_area = g('id_area');
										$condition = '';
										if(getRole() == 'AM') {
											$condition = "region.id = '".getUser()->region_id."'";
											$id_region = getUser()->region_id;
											$id_area = getUser()->id_area;
										}elseif(getRole() == 'SM') {
											$condition = "region.id = '".getUser()->id_region."'";
											$id_region = getUser()->id_region;											
										}	

										$data = getData('region',$condition,'nama asc');
									@endphp
									@foreach($data as $d)
										<option {{ $id_region==$d->id?"selected":"" }} value="{{$d->id}}">{{$d->nama}}</option>
									@endforeach								
								</select>
							</div>							
						</td>
						<td>
							<div class="form-group">
								<label>Area</label>
								<select class="form-control" data-value="{{$id_area}}" name="id_area">
									<option value="">** Semua Area</option>									
								</select>
							</div>							
						</td>
						<td width="10%">
							<div class="form-group">
								<label>&nbsp;</label>
								<p><input type="submit" class="btn btn-primary btn-block" value="Filter"></p>
							</div>							
						</td>
					</tr>
				</table>
				</form>
			

			<div id="map" style="width: 100%;height: 300px"></div>   
		</div>
	</div>

	@push('scripts')
		<script>
	      
	      function initMap() {
	        var myLatLng = {lat: -2.32009, lng: 118.3837544};

	        map = new google.maps.Map(document.getElementById('map'), {
	          center: myLatLng,
	          scrollwheel: true,
	          zoom: 5
	        });	     

	        loadMarkers();
	        var intervalMarkers = setInterval(function() {
	        	loadMarkers();
	        },60000);   
	      }

	      function loadMarkers() {
	      	clearMarkers();
	      	$.get("{{action('AdminDashboardController@getMarkers')}}?id_devisi={{g('id_devisi')}}&id_region={{g('id_region')}}&id_area={{g('id_area')}}",function(r) {
	      		if(r.items) {
	      			$.each(r.items,function(i,obj) {
	      				var image = {
				          url: obj.marker,	          
				          size: new google.maps.Size(48, 48),	          
				          origin: new google.maps.Point(0, 0),	          
				          anchor: new google.maps.Point(0, 32)
				        };
	      				var marker = new google.maps.Marker({
				          map: map,
				          icon: image,
				          position: {lat: parseFloat(obj.last_latitude),lng: parseFloat(obj.last_longitude) },
				          title: obj.karyawan_nama
				        });
				        markersVar[obj.id] = marker;

				        var status = (obj.status=='Online')?'<span class="label label-success">Online</span>':'<span class="label label-danger">Offline</span>';

				        var contentString = "<table>"+
				        "<tr><td>Login ID</td><td>:</td><td>"+obj.username+"</td></tr>"+
				        "<tr><td>Nama</td><td>:</td><td>"+obj.karyawan_nama+"</td></tr>"+
				        "<tr><td>Status</td><td>:</td><td>"+status+"</td></tr>"+
				        "<tr><td>Waktu</td><td>:</td><td>"+obj.last_online_datetime+"</td></tr>"+
				        "<tr><td>Latitude</td><td>:</td><td>"+obj.last_latitude+"</td></tr>"+
				        "<tr><td>Longitude</td><td>:</td><td>"+obj.last_longitude+"</td></tr>"+
				        "<tr><td>Apps</td><td>:</td><td>"+obj.last_app_version+"</td></tr>"+
				        "</table>";
				        infowindow = new google.maps.InfoWindow({
						    content: contentString
						  });				        
				        markers.push(marker);

				        google.maps.event.addListener(marker, 'click', (function(marker, i) {
					      return function() {
					        infowindow.setContent(contentString);
					        infowindow.open(map, marker);
					        map.setZoom(19);
					        map.setCenter(marker.getPosition());
					      }
					    })(marker, i));
	      			})
	      		}
	      	})
	      }

	      function clearMarkers() {
	      	if(markers.length>0) {
	      		for(var i = 0; i < markers.length; i++) {
		      		markers[i].setMap(null);
		      	}
	      	}
	      	
	      }
	    </script>
	    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_map_api_key') }}}}&callback=initMap"
	        async defer></script>
	@endpush
	
	<div class="box box-default">
		<div class="box-header with-border">
			<h3 class="box-title">Data</h3>
			<div class="pull-right">
				<!-- <a href="javascript:;" onclick="showFindDataModal()" class="btn btn-sm btn-default"><i class="fa fa-search"></i> Cari Data</a> -->
			</div>
		</div>
		<div class="box-body table-responsive no-padding" style="height: 400px; overflow: auto">
			<table id='tableListUser' class="table table-striped table-hover">
				<thead>
					<tr>
						<th>No</th>
						<th>Jabatan</th>
						<th>Login ID</th>
						<th>Nama</th>						
						<th>Area</th>
						<th>Status</th>

						<th>Update Terakhir</th>
						<th>Apps</th>
					</tr>
				</thead>
				<tbody>
					@php $no = 1; @endphp
			
					@foreach($result as $row)					
					<tr class="{{ getStatusActive($row->last_online_datetime)=='Offline'?'danger':'' }}" id="trTable{{$row->id}}" data-lat="{{$row->last_latitude}}" data-lng="{{$row->last_longitude}}" style="cursor: pointer" 
						@if(getRole()!='AM')
						onclick="mapPointTo('{{$row->id}}')"
						@endif
					>				
						<td>{{ $no }}</td>
						<td>{{$row->role_nama}}</td>
						<td>{{$row->username}}</td>						
						<td>{{$row->karyawan_nama}}</td>							
						<td>{{$row->area_nama}}</td> 					
							
						@if(getRole()=='AM')
						<td>-</td>

						<td>-</td>
						@else			
						<td>{{ getStatusActive($row->last_online_datetime) }}</td>	
					
						<td>{{$row->last_online_datetime}}</td>				
						<td>{{$row->last_app_version}}</td>
						@endif
						
					</tr>
						<?php 
							$amNo = 1;
						?>
						@foreach($row->bawahan as $a)
						<tr class="{{ getStatusActive($a->last_online_datetime)=='Offline'?'danger':'' }}" id="trTable{{$a->id}}" data-lat="{{$a->last_latitude}}" data-lng="{{$a->last_longitude}}" style="cursor: pointer" onclick="mapPointTo('{{$a->id}}')">				
							<td>{{ $no.'.'.$amNo }}</td>
							<td>{{$a->role_nama}}</td>
							<td>{{$a->username}}</td>						
							<td>{{$a->karyawan_nama}}</td>							
							<td>{{$a->area_nama}}</td> 					
							<td>{{ getStatusActive($a->last_online_datetime) }}</td>									
							<td>{{$a->last_online_datetime}}</td>			
							<td>{{$a->last_app_version}}</td>
						</tr>

							<?php 								
								$mrNo = 1;
							?>
							@foreach($a->bawahan as $b)
							<tr class="{{ getStatusActive($b->last_online_datetime)=='Offline'?'danger':'' }}" id="trTable{{$b->id}}" data-lat="{{$b->last_latitude}}" data-lng="{{$b->last_longitude}}" style="cursor: pointer" onclick="mapPointTo('{{$b->id}}')">				
								<td>{{ $no.'.'.$amNo.'.'.$mrNo}}</td>
								<td>{{$b->role_nama}}</td>
								<td>{{$b->username}}</td>						
								<td>{{$b->karyawan_nama}}</td>							
								<td>{{$b->area_nama}}</td> 					
								<td>{{ getStatusActive($b->last_online_datetime) }}</td>									
								<td>{{$b->last_online_datetime}}</td>
								<td>{{$b->last_app_version}}</td>
							</tr>
							@php $mrNo++; @endphp
							@endforeach
							
							@php $amNo++; @endphp
						@endforeach
						

						@php $no++; @endphp
					@endforeach
				</tbody>
			</table> 
			
			@if(count($result)==0)
				<div align="center" style="padding:10px"><em>Belum Ada Data</em></div>
			@endif
		</div>
	</div>

</section>
<!-- /.content -->

@push('scripts')
	<script type="text/javascript">
		function showFindDataModal() {			
			$('#find-data-modal').modal('show');
		}
	</script>
	<div id='find-data-modal' class="modal fade" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Pencarian Data</h4>
	      </div>
	      <form method="get" action="">
	      <div class="modal-body">
	        	<div class="form-group">
	        		<label>Kode</label>
	        		<input class="form-control" type="text" name="search[area.kode]" value="{{ @g('search')['area.kode'] }}">
	        	</div>
	        	<div class="form-group">
	        		<label>Nama</label>
	        		<input class="form-control" type="text" name="search[area.nama]" value="{{ @g('search')['area.nama'] }}">
	        	</div>
	        	<div class="form-group">
	        		<label>Filter By Region</label>
	        		<select name="where[area.id_region]" class="form-control">
	        			<option value="">** Semua Region</option>
	        			@php $region = getData('region',NULL,'nama asc'); @endphp
	        			@foreach($region as $w)
	        				<option value="{{$w->id}}" {{ @$w->id==g('where')['area.id_region']?'selected':''}} >{{$w->nama}}</option>
	        			@endforeach
	        		</select>
	        	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
	        <button type="submit" class="btn btn-primary">Cari</button>
	      </div>
	      </form>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
@endpush

@endsection