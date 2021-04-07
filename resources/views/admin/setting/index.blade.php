@extends('admin.layout')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Setting    
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url(config('app.adminPath'))}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li>Master</li>
    <li class="active">Setting</li>
  </ol>
</section>
  
<!-- Main content -->
<section class="content"> 
	{!! bootstrapAlert() !!}
	<div class="panel panel-default">
		<div class="panel-heading">Setting Data</div>

		<form method="post" action="{{action('AdminSettingController@postSave')}}" class="form-horizontal" enctype="multipart/form-data">
		{!! csrf_field() !!}
		<div class="panel-body">
			
			<div class="form-group">
				<label class='col-sm-2 control-label'>Mail Type</label>
				<div class="col-sm-10">
					<select class="form-control" name='mail_type'>
						<option value="">** Pilih Mail Tipe</option>
						<option {{ (getSetting('mail_type')=='smtp')?"selected":"" }} value="smtp">SMTP</option>
						<option {{ (getSetting('mail_type')=='mail')?"selected":"" }} value="mail">PHP Mail</option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class='col-sm-2 control-label'>Mail Hostname</label>
				<div class="col-sm-10">
					<input type="text" name="mail_hostname" class="form-control" value="{{ getSetting('mail_hostname') }}" >				
				</div>
			</div>

			<div class="form-group">
				<label class='col-sm-2 control-label'>Mail Port</label>
				<div class="col-sm-10">
					<input type="text" name="mail_port" class="form-control" value="{{ getSetting('mail_port') }}" >				
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label">Mail Username</label>
				<div class="col-sm-10">
					<input type="text" name="mail_username" class="form-control" value="{{ getSetting('mail_username') }}" >				
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label">Mail Password</label> 
				<div class="col-sm-10">
					<input type="text" name="mail_password" class="form-control" value="{{ getSetting('mail_password') }}" >				
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label">Banner</label> 
				<div class="col-sm-10">
					@if(getSetting('banner'))
						<p><i class="fa fa-image"></i> <a href="{{asset(getSetting('banner'))}}" target="_blank">Download Banner</a></p>
					@endif
					<input type="file" name="banner" class="form-control" >				
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label">Alamat E-mail Admin</label> 
				<div class="col-sm-10">
					<input type="text" name="email_admin" class="form-control" value="{{ getSetting('email_admin') }}" >				
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label">Versi Aplikasi Terakhir</label> 
				<div class="col-sm-10">
					<input type="text" name="last_app_version" class="form-control" value="{{ getSetting('last_app_version') }}" >				
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label">Aplikasi Terakhir</label> 
				<div class="col-sm-10">
					@if(getSetting('last_app_version_link'))
						<p>
							<a href="{{asset(getSetting('last_app_version_link'))}}" target="_blank">Download APK</a>
						</p>
					@endif
					<input type="file" name="last_app_version_link" class="form-control" >				
				</div>
			</div>

			<!-- <div class="form-group">
				<label class="col-sm-2 control-label">Alamat E-mail BCC</label> 
				<div class="col-sm-10">
					<input type="text" name="email_bcc" class="form-control" value="{{ getSetting('email_bcc') }}" >				
				</div>
			</div> -->

			<div class="form-group">
				<label class="col-sm-2 control-label">Visit Dokter Baru</label> 
				<div class="col-sm-3">					
					
					<label class="radio-inline">
						<input type="radio" name="visit_dokter_baru" value="1" {{getSetting('visit_dokter_baru')==1?'checked':''}} > Aktif
					</label>
					<label class="radio-inline">
						<input type="radio" name="visit_dokter_baru" value="0" {{getSetting('visit_dokter_baru')==0?'checked':''}} > Non Aktif
					</label>
				</div>				
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label">Auto Closing Visit Plan</label> 
				<div class="col-sm-3">					
					<input type="number" min='1' max="31" class="form-control" name="auto_closing_visit_plan" value="{{getSetting('auto_closing_visit_plan')}}">
				</div>				
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label">Auto Closing Sales Plan</label> 
				<div class="col-sm-3">					
					<input type="number" min='1' max='31' class="form-control" name="auto_closing_sales_plan" value="{{getSetting('auto_closing_sales_plan')}}">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label">Auto Closing Entry Claim</label> 
				<div class="col-sm-3">					
					<input type="number" min='1' max='31' class="form-control" name="auto_closing_entry_claim" value="{{getSetting('auto_closing_entry_claim')}}">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label">Maks Visit Dokter Per Hari</label> 
				<div class="col-sm-3">
					<input type="number" name="max_visit_dokter_per_day" value="{{getSetting('max_visit_dokter_per_day')}}">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label">Maks Visit Outlet Per Hari</label> 
				<div class="col-sm-3">
					<input type="number" name="max_visit_outlet_per_day" value="{{getSetting('max_visit_outlet_per_day')}}">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label">Waktu Visit Siang</label> 
				<div class="col-sm-3">
					<input type="text" name="time_visit_siang_from" class="form-control" value="{{getSetting('time_visit_siang_from')}}">
					<div class="help-block">Waktu Visit Siang Dari</div>
				</div>
				<div class="col-sm-3">
					<input type="text" name="time_visit_siang_to" class="form-control" value="{{getSetting('time_visit_siang_to')}}">
					<div class="help-block">Waktu Visit Siang Sampai</div>
				</div>							
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label">Waktu Visit Malam</label> 
				<div class="col-sm-3">
					<input type="text" name="time_visit_malam_from" class="form-control" value="{{getSetting('time_visit_malam_from')}}">
					<div class="help-block">Waktu Visit Malam Dari</div>
				</div>
				<div class="col-sm-3">
					<input type="text" name="time_visit_malam_to" class="form-control" value="{{getSetting('time_visit_malam_to')}}">
					<div class="help-block">Waktu Visit Malam Sampai</div>
				</div>							
			</div>
			<hr>

			<div class="form-group">
				<div class="col-sm-2"></div>
				<div class="col-sm-10">
					<p><strong>Agar sistem auto closing dapat berjalan otomatis, maka harus ditambahkan cron job berikut:</strong></p>
					<p><code>* * * * * php /projectName/artisan schedule:run >> /dev/null 2>&1</code></p>
				</div>
			</div>

		</div>
		<div class="panel-footer" align="right">			
			<input type="submit" class="btn btn-primary" name="submit" value="Simpan">
		</div>
		</form>
	</div>
</section>
<!-- /.content -->

@endsection