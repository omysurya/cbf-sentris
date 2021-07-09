@extends('admin.layout')
@section('content')

<!-- Content Header (Page header) -->

<section class="content-header"> 

  <h1>
    Dashboard :: Summary Sales
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url(config('app.adminPath')) }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li>Dashboard</li>
    <li class="active">Summary Sales</li>
  </ol> 
</section>
@push('head')
	<style type="text/css">
		.selectYear {
			padding: 5px;
		    font-size: 26px;
		    width: 100%;
		    text-align: center;
		    border: 0px;
		    font-weight: bold;
		    color: #999999;
		}
		.month-select-title {
			font-size: 20px;
			font-weight: bold;
			color: #999999;
			margin-top: 0px;
		}
		.month-select-year-area {
			padding-left: 25px;
			border-left: 2px solid #dddddd;
		}
	</style>
@endpush
@push('scripts')
	<!-- ChartJS 1.0.1 -->
	<script src="{{asset('css')}}/plugins/chartjs/Chart.min.js"></script>
	<script type="text/javascript">
		$(function() {
			//-------------
		    //- BAR CHART -
		    //-------------

		    var areaChartData = {
	      labels: {!! $produk_groups !!},
	      datasets: [
	        {
	          label: "Target",
	          fillColor: "rgba(210, 214, 222, 1)",
	          strokeColor: "rgba(210, 214, 222, 1)",
	          pointColor: "rgba(210, 214, 222, 1)",
	          pointStrokeColor: "#c1c7d1",
	          pointHighlightFill: "#fff",
	          pointHighlightStroke: "rgba(220,220,220,1)",
	          data: {!! $targets !!}
	        }, 
	        {
	          label: "Realisasi",
	          fillColor: "rgba(60,141,188,0.9)",
	          strokeColor: "rgba(60,141,188,0.8)",
	          pointColor: "#3b8bba",
	          pointStrokeColor: "rgba(60,141,188,1)",
	          pointHighlightFill: "#fff",
	          pointHighlightStroke: "rgba(60,141,188,1)",
	          data: {!! $realisasis !!}
	        }
	      ]
	    };

		    var barChartCanvas = $("#barChart").get(0).getContext("2d");
		    var barChart = new Chart(barChartCanvas);
		    var barChartData = areaChartData;
		    barChartData.datasets[1].fillColor = "#00a65a";
		    barChartData.datasets[1].strokeColor = "#00a65a";
		    barChartData.datasets[1].pointColor = "#00a65a";
		    var barChartOptions = {
		      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
		      scaleBeginAtZero: true,
		      //Boolean - Whether grid lines are shown across the chart
		      scaleShowGridLines: true,
		      //String - Colour of the grid lines
		      scaleGridLineColor: "rgba(0,0,0,.05)",
		      //Number - Width of the grid lines
		      scaleGridLineWidth: 1,
		      //Boolean - Whether to show horizontal lines (except X axis)
		      scaleShowHorizontalLines: true,
		      //Boolean - Whether to show vertical lines (except Y axis)
		      scaleShowVerticalLines: true,
		      //Boolean - If there is a stroke on each bar
		      barShowStroke: true,
		      //Number - Pixel width of the bar stroke
		      barStrokeWidth: 2,
		      //Number - Spacing between each of the X value sets
		      barValueSpacing: 5,
		      //Number - Spacing between data sets within X values
		      barDatasetSpacing: 1,
		      //String - A legend template
		      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
		      //Boolean - whether to make the chart responsive
		      responsive: true,
		      maintainAspectRatio: true
		    };

		    barChartOptions.datasetFill = false;
		    barChart.Bar(barChartData, barChartOptions);		    
		})
	</script>
@endpush

<!-- Main content -->
<section class="content">
	{!! bootstrapAlert() !!}

	<p align="right">
		{!! buttonMutakhir() !!} 
		{!! showFilterTeamButton('Filter','month') !!}
	</p>	
	<div class="box box-default">
		<div class="box-body">
			<div class="row">
				<div class="col-sm-12"> 
					<div class="pull-left" style="display: inline-block;">
						<h3 class="month-select-title" style="margin-left: 15px">Month</h3>
						<ul class="nav nav-pills" style="display: inline-block;"> 
						  @for($i=1;$i<=12;$i++)
						  @php 
						  	$currentMonth = (g('bulan'))?:date('n');
						  	$monthId = str_pad($i,2,0,STR_PAD_LEFT);
						  	$monthName = date('F',strtotime('1970-'.$monthId.'-1'));
						  @endphp
						  <li role="presentation" class="{{$currentMonth==$monthId?'active':'' }}"><a href="{{ Request::fullUrlWithQuery([
							'bulan'=>$i,
							'tahun'=>g('tahun')?:date('Y'),
							'id_sm'=>g('id_sm'),
							'id_am'=>g('id_am'),
							'id_mr'=>g('id_mr')
						  	])}}">{{$monthName}}</a></li>
						  @endfor					  
						</ul>	 
					</div>
					
					<div class="pull-right month-select-year-area" style="width: 150px">
						<h3 class="month-select-title">Year</h3>
						<select class="selectYear" onchange="location.href='{{Request::url()}}?bulan={{g('bulan')?:date('n')}}&tahun='+this.value+'&id_user={{g('id_user')}}'">
							@for($i=date('Y');$i>=1990;$i--)
							<option {{ ($current_year == $i)?"selected":"" }} value="{{ $i }}">{{ $i }}</option>
							@endfor
						</select>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-sm-6">
			<div class="box box-default">
				<div class="box-header">
					<h3 class="box-title"><i class="fa fa-bar-chart"></i> Realisasi Group Produk Grafik</h3>
				</div>
				<div class="box-body">
					<div class="chart">
		                <canvas id="barChart" style="height:590px"></canvas>
		              </div>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="box box-default">
				<div class="box-header">
					<h3 class="box-title"><i class="fa fa-table"></i> Realisasi Group Produk Tabel</h3>
				</div>
				<div class="box-body" style="max-height: 700px;overflow: auto;">
					<table class="table table-bordered">
						<thead>
							<tr>
                                <th rowspan="2" style="vertical-align : middle;">Group Produk</th>
                                <th colspan="2" style="text-align:center;">Target</th>
                                <th colspan="2" style="text-align:center;">Realisasi</th>
                            </tr>
                            <tr style="text-align:center;">
                                <th>Unit</th>
                                <th>Value</th>
                                <th>Unit</th>
                                <th>Value</th>
                            </tr>
						</thead>
						<tbody>
							<?php $total_target_unit = $total_target_value = $total_real_unit = $total_real_value = 0; ?>
							@foreach($result as $r)
							<?php 
								$total_target_unit += $r->target_unit;
								$total_target_value += $r->target_value;
								$total_real_unit += $r->real_unit;
								$total_real_value += $r->real_value;
							 ?>
							<tr>
								<td>{{$r->nama}}</td>
								<td style="text-align: right;">{{number_format($r->target_unit)}}</td>
								<td style="text-align: right;">{{number_format($r->target_value)}}</td>
								<td style="text-align: right;">{{number_format($r->real_unit)}}</td>
								<td style="text-align: right;">{{number_format($r->real_value)}}</td>
							</tr>
							@endforeach
							@if(count($result)==0)
							<tr>
								<td colspan="5" align="center">Belum Ada Data</td>
							</tr>
							@endif	
						</tbody>
						<tfoot>
							<tr>
								<th style="border-top: 1px solid #222222">Total</th>
								<th style="border-top: 1px solid #222222;text-align: right;">{{ number_format($total_target_unit) }}</th>
								<th style="border-top: 1px solid #222222;text-align: right;">{{ number_format($total_target_value) }}</th>
								<th style="border-top: 1px solid #222222;text-align: right;">{{ number_format($total_real_unit) }}</th>
								<th style="border-top: 1px solid #222222;text-align: right;">{{ number_format($total_real_value) }}</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
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