<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name='robots' content='noindex,nofollow'>
  <title>{{ $pageTitle }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{asset('css')}}/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('css')}}/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
  <link rel="stylesheet" href="{{asset('css')}}/dist/css/skins/skin-purple-light.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{asset('css')}}/plugins/iCheck/all.css">
  <link rel="stylesheet" type="text/css" href="{{asset('css/plugins/select2/select2.min.css')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style type="text/css">
    .box .box-footer {
      background: #AEB6C5;
      color: #ffffff;
    }
    .box .box-footer .current_page {
      background: #ffffff;
      color: #222222;
      padding: 5px;
      margin: 0px 5px 0px 5px;
      height: 20px;
    }
    .box .box-footer a {
      color: #ffffff;
    }
    .modal-header {
      background: #354052;
      color: #ffffff;
    }

    .btn-primary {
      background: #0A9BFC;
    }
    /*.btn-default {
      background: #ffffff;
      border-color: #0A9BFC;
      color: #0A9BFC;
    }*/
    table tbody tr td {
      cursor: default
    }

    .filter-karyawan-top {
      padding:10px;
      text-align: center;
    }
    .filter-karyawan-top select {
      width:300px;
      display: inline-block;
    }

    input[type=text],
    input[type=password],
    input[type=number],
    select {
      padding: 5px;
      font-size: 14px;
    }

    select {
      cursor: pointer;
    }

    #total{
      font-size: 14px;
      font-weight: bolder;
    }

    #sales{
      background: #f6f3f2;
    }
    }

  </style>
  <style type="text/css">
  .select2-container--default .select2-selection--single {border-radius: 0px !important}
        .select2-container .select2-selection--single {height: 35px}
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
          background-color: #3c8dbc !important;
          border-color: #367fa9 !important;
          color: #fff !important;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
          color: #fff !important;
        }
</style>
@stack('head')

<script type="text/javascript">
function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}

function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    var current_date = checkTime(today.getDate());
    var current_month =checkTime(today.getMonth()+1); //Month starts from 0
    var current_year = today.getFullYear();
    var tanggal = current_year+'-'+current_month+'-'+current_date;
    // add a zero in front of numbers<10
    h = checkTime(h);
    m = checkTime(m);
    s = checkTime(s);
    var jamku = h + ":" + m + ":" + s;

    //Deklarasi jam
    var waktu = document.getElementById('jamku');
    if(waktu){
      document.getElementById('jamku').innerHTML = jamku;
      document.getElementById('jamku').value=jamku;
    }

    //Deklarasi tanggal
    var tgl = document.getElementById('tanggalku');
    if(tgl){
      tgl.innerHTML = tanggal;
      tgl.value = tanggal;
    }

    t = setTimeout(function () {
        startTime()
    }, 500);
}

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

</script>
</head>
<body class="skin-purple-light" onload="startTime();">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="{{url('admin')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>N</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">
        <img src="{{asset('logo.png')}}" style="height: 45px">
      </span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              @if(!empty(getUser()->foto))
              <!-- The user image in the navbar-->
              <img src="{{asset(getUser()->foto)}}" class="user-image" alt="User Image">
              @else
              <img src="uploads/profile.png" class="user-image" alt="User Image">
              @endif
              <!-- hidden-xs hides the nama_lengkap on small devices so only the image appears. -->
              <span class="hidden-xs">{{ getUser()->nama_lengkap?:getRole() }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="{{asset(getUser()->foto)}}" class="img-circle" alt="User Image">

                <p>
                  {{ getUser()->nama_lengkap?:getRole() }}
                </p>
              </li>

              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{ action('AdminUserController@getProfile') }}" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{ action('AdminController@getLogout') }}" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->

        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      @include('admin.sidebar')
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @if(getUserStatus()=='disable')
      <section class="content" style="min-height: 0px;margin-bottom: 0px;">
      <div class="alert alert-warning" style="margin-bottom: 0px;">
        <strong>Perhatian:</strong><br/>
        Saat ini anda masuk dengan akun yang telah dinonktifkan ( {{ getUserSession()->kode_sales.' '.getUserSession()->karyawan_nama }} )
      </div>
    </section>
    @endif

    @yield('content')

  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
     {{ config('app.name') }} v{{ config('app.version') }}
    </div>
    <!-- Default to the left -->
    <strong>&copy; {{date('Y')}} {{ config('app.author') }}</strong>
  </footer>

</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 -->
<script src="{{asset('css')}}/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{asset('css')}}/bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('css')}}/dist/js/app.min.js"></script>

<script type="text/javascript" src="{{asset('css/sweetalert-master/dist/sweetalert.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('css/sweetalert-master/dist/sweetalert.css')}}">

<script type="text/javascript" src="{{asset('css/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('css/plugins/datepicker/datepicker3.css')}}">

<script type="text/javascript" src="{{asset('css/plugins/select2/select2.min.js')}}"></script>


<!-- iCheck 1.0.1 -->
<script src="{{asset('css')}}/plugins/iCheck/icheck.min.js"></script>

<script src="{{asset('js')}}/jqueryValidation/jquery.validate.min.js" type="text/javascript"></script>

<script type="text/javascript">
  $(function() {
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    $('.datepicker').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true
    });
    $('.select2').select2();

    $('.confirm').click(function(event) {
      event.preventDefault();

      var url = $(this).attr('href');
      swal({
        title: "Konfirmasi?",
        text: "Apakah anda yakin melakukan ini?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya",
        cancelButtonText: 'Tidak',
        closeOnConfirm: false,
        showLoaderOnConfirm: true
      },
      function(){
          location.href = url;
      });
    })
    return false;
  })
</script>

<script type="text/javascript" src="{{asset('css/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('css/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('css/plugins/datatables/jquery.dataTables.min.css')}}">
<script type="text/javascript">
  $(function() {
    $('.datatable').DataTable({
      'iDisplayLength': 25,
      "aaSorting": []
    });
  })
</script>

<style type="text/css">
  .dataTables_wrapper .dataTables_paginate .paginate_button {
    padding: 0px 0px 0px 0px;
  }
</style>

@stack('scripts')
@stack('bottom')
</body>
</html>
