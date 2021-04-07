@extends('admin.layout_sign')
@section('content')
<!--
<p class="login-box-msg">Masuk untuk memulai sesi anda</p>
-->
<a href="{{ url(config('app.adminPath')) }}">
  <img src="{{asset('logo.png')}}" style="width: 100%">
</a>
<form action="" method="post">
 {!! csrf_field() !!}
  <div class="form-group has-feedback">    
    <input type="text" class="form-control" name="username" placeholder="Username" autocomplete="off" autofocus="true">
    <span class="glyphicon glyphicon-user form-control-feedback"></span>
  </div>
  <div class="form-group has-feedback">
    <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="off">
    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
  </div>
  <div class="row">

    <!-- /.col -->
    <div class="col-xs-6">
      <button type="submit" class="btn btn-default btn-block btn-flat">Masuk</button>
    </div>
    <!-- /.col -->
  </div>
</form>
<p></p>
<!--
<a href="{{action('AdminController@getForgot')}}">Saya lupa password</a><br> 
-->

@endsection