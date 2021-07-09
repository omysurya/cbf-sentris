@extends('admin.layout_sign')
@section('content')
<p class="login-box-msg">Input username anda untuk meminta ulang password</p>

<!-- <form action="" method="post">
 {!! csrf_field() !!}
  <div class="form-group has-feedback">    
    <input type="text" class="form-control" name="username" placeholder="Username">
    <span class="glyphicon form-control-feedback"></span>
  </div>
  <div class="row">
    
    <div class="col-xs-4">
      <button type="submit" class="btn btn-primary btn-block btn-flat">Kirim</button>
    </div>
    
  </div>
</form> -->
<div class="alert alert-warning">
  Saat ini fitur reset password belum dapat digunakan. Silahkan kontak ADMIN untuk meminta password ulang.
</div>
<p></p>
<a href="{{action('AdminController@getLogin')}}">Login kembali</a><br> 

@endsection