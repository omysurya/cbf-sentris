@extends('admin.layout')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Info Pusat
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url(config('app.adminPath')) }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li>Dashboard</li>
    <li class="active">Info Pusat</li>
  </ol> 
</section>

<!-- Main content -->
<section class="content">
	{!! bootstrapAlert() !!}

	<ul class="timeline">
            
			@php $lastDate = null; @endphp
            @foreach($result as $r)

            @if(!$lastDate || $lastDate != date('Y-m-d',strtotime($r->created_at)) )
	            @php
	            	$lastDate = date('Y-m-d',strtotime($r->created_at));
	            @endphp
	            <!-- timeline time label -->
	            <li class="time-label">
	                  <span class="bg-red">
	                    {{ date('d F Y',strtotime($lastDate)) }}
	                  </span>
	            </li>
	            <!-- /.timeline-label -->
            @endif

            <!-- timeline item -->
            <li>
              <i class="fa fa-info bg-blue"></i>

              <div class="timeline-item">
                <span class="time">
                  <i class="fa fa-user"></i> Dipublish oleh {{$r->karyawan_nama}} &nbsp;&nbsp;
                  <i class="fa fa-tags"></i> {{ $r->berita_kategori_nama }}
                </span>

                <h3 class="timeline-header"><a href="{{url(config('app.adminPath').'/dashboard/info/detail/'.$r->id)}}">{{$r->judul}}</a></h3>

                <div class="timeline-body">
                  {{ Str::limit(strip_tags($r->isi),200) }}
                </div>
                <div class="timeline-footer">
                  <a href="{{url(config('app.adminPath').'/dashboard/info/detail/'.$r->id)}}" class="btn btn-primary btn-xs">Read more</a>                  
                </div>
              </div>
            </li>
            <!-- END timeline item -->
            @endforeach
            
            <li>
              <i class="fa fa-clock-o bg-gray"></i>
            </li>
          </ul>

</section>
<!-- /.content -->

@endsection