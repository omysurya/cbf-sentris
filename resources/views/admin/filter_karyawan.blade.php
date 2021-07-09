@if(getRole()!='MR')
<div class="filter-karyawan-top">
<form method="get" action="">
<select class="form-control select2" onChange="location.href='{{Request::url()}}?id_user='+this.value" name="id_user">
  		<option value="">** Semua Karyawan</option>  
	  	@php
	  		if(getRole() == 'AM') {
	  			$comboUser = getKaryawan("role.nama in ('MR') and user.id_area = '".getUser()->id_area."' or user.id = '".getUserId()."'");	  		
	  		}elseif(getRole() == 'SM') {
	  			$comboUser = getKaryawan("role.nama in ('AM','MR') and user.id_region = '".getUser()->id_region."'");
	  		}else {
	  			$comboUser = getKaryawan("role.nama in ('AM','MR')");
	  		}	  			  		
	  	@endphp
	  	@foreach($comboUser as $c)
  			<option {{ g('id_user')==$c->id_user?'selected':'' }} value="{{ $c->id_user }}"> {{$c->nama}} ({{ $c->role_nama }})</option>
  		@endforeach	
</select>
</form>
</div>
@endif