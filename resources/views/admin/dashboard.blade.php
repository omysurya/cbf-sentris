@extends('admin.layout')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Dashboard
    <small>Pharmasolindo</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{Request::url()}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Here</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
	{!! bootstrapAlert() !!}
  

</section>
<!-- /.content -->

@endsection