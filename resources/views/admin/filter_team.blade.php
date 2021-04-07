
@if(in_array(getRole(),["DIRUT","MM","SUPERADMIN","NSM",]))
	@push('scripts')
		<script type="text/javascript">
			var id_sm_get = "{{g('id_sm')}}";
			console.log('id sm '+id_sm_get);
		    $('select[name=id_sm]').change(function() {
		    	var id_sm = (id_sm_get)?id_sm_get:$(this).val();
		    	id_sm_get = null;
		    	if(!id_sm) {
		    		$('select[name=id_am]').html("<option value=''>** Semua AM</option>");	
		    		return false;
		    	}
		    	var b = $('#modal-filter-team select[name=bulan]').val();
                var t = $('#modal-filter-team input[name=tahun]').val();
		    	$('select[name=id_am]').html("<option value=''>Memuat data...</option>");
		    	$.get("{{action('AdminDashboardController@getAjaxAmBySm')}}/"+id_sm+"?bulan="+b+"&tahun="+t,function(r) {
		    		if(r.length>0) {
		    			var opt = "<option value=''>** Semua AM</option>";
		    			$.each(r,function(i,o) {
		    				var select = ("{{g('id_am')}}"==o.id)?"selected":"";
		    				opt += "<option "+select+" value='"+o.id+"'>"+o.kode_sales+' - '+o.karyawan_nama+"</option>";
		    			})
		    			$('select[name=id_am]').html(opt);
		    		}else{
		    			$('select[name=id_am]').html("<option value=''>** Semua AM</option>");	
		    		}

		    		@if(g('id_am'))
				    	$('select[name=id_am]').val('{{g('id_am')}}').trigger('change');
				    @endif
		    	});
		    })

		    @if(g('id_sm'))
		    	$('select[name=id_sm]').trigger('change');
		    @endif

		    var id_am_get = "{{g('id_am')}}";
		    $('select[name=id_am]').change(function() {
		    	var id_am = (id_am_get)?id_am_get:$(this).val();
		    	id_am_get = null;
		    	if(!id_am) {
		    		$('select[name=id_mr]').html("<option value=''>** Semua MR</option>");	
		    		return false;
		    	}
		    	var id_sm = $('select[name=id_sm]').val(); 
		    	var b = $('#modal-filter-team select[name=bulan]').val();
                        var t = $('#modal-filter-team input[name=tahun]').val();
		    	$('select[name=id_mr]').html("<option value=''>Memuat data...</option>");
		    	$.get("{{action('AdminDashboardController@getAjaxMrByAm')}}/"+id_am+"/"+id_sm+"?bulan="+b+"&tahun="+t,function(r) {
		    		if(r.length>0) {
		    			var opt = "<option value=''>** Semua MR</option>";
		    			$.each(r,function(i,o) {
		    				var select = ("{{g('id_mr')}}"==o.id)?"selected":"";
		    				opt += "<option "+select+" value='"+o.id+"'>"+o.kode_sales+' - '+o.karyawan_nama+"</option>";
		    			})
		    			$('select[name=id_mr]').html(opt);
		    		}else{
		    			$('select[name=id_mr]').html("<option value=''>** Semua MR</option>");	
		    		}
		    	});
		    })

		    
		</script>
	@endpush

	@if(@!in_array('SM', $disableTeam))
	<tr>
		<td><strong>Filter By SM</strong></td><td width='10px'>:</td><td>
			<select name='id_sm' class='form-control'>
				<option value="">** Semua SM</option>
				@php $karyawan = teamSM($filterGetIdSm = false); @endphp
				@foreach($karyawan as $k)
					<option {{ g('id_sm')==$k->id?"selected":"" }} value="{{$k->id}}">{{$k->karyawan_nama}} - {{$k->region_nama}}</option>
				@endforeach
			</select>
		</td>
	</tr>
	@endif

	@if(@!in_array('AM', $disableTeam))
	<tr>
		<td><strong>Filter By AM</strong></td><td width='10px'>:</td><td>
			<select name='id_am' class='form-control'>
				<option value="">** Semua AM</option>					
			</select>
		</td>
	</tr>
	@endif

	@if(@!in_array('MR', $disableTeam))
	<tr>
		<td><strong>Filter By MR</strong></td><td width='10px'>:</td><td>
			<select name='id_mr' class='form-control'>
				<option value="">** Semua MR</option>
			</select>
		</td>
	</tr>
	@endif

@elseif(getRole() == 'SM')
	@push('scripts')
		<script type="text/javascript">
		    var id_am_get = "{{g('id_am')}}";
		    $('select[name=id_am]').change(function() {
		    	var id_am = (id_am_get)?id_am_get:$(this).val();
		    	id_am_get = null;
		    	if(!id_am) {
		    		$('select[name=id_mr]').html("<option value=''>** Semua MR</option>");	
		    		return false;
		    	}
		    	var id_sm = "{{getUserId()}}";
		    	var b = $('#modal-filter-team select[name=bulan]').val();
                        var t = $('#modal-filter-team input[name=tahun]').val();
		    	$('select[name=id_mr]').html("<option value=''>Memuat data...</option>");
		    	$.get("{{action('AdminDashboardController@getAjaxMrByAm')}}/"+id_am+"/"+id_sm+"?bulan="+b+"&tahun="+t,function(r) {
		    		if(r.length>0) {
		    			var opt = "<option value=''>** Semua MR</option>";
		    			$.each(r,function(i,o) {
		    				var select = ("{{g('id_mr')}}"==o.id)?"selected":"";
		    				opt += "<option "+select+" value='"+o.id+"'>"+o.kode_sales+' - '+o.karyawan_nama+"</option>";
		    			})
		    			$('select[name=id_mr]').html(opt);
		    		}else{
		    			$('select[name=id_mr]').html("<option value=''>** Semua MR</option>");	
		    		}
		    	});
		    })

		    @if(g('id_am'))
		    	$('select[name=id_am]').trigger('change');
		    @endif
		</script>
	@endpush

	<tr style="display: none">
		<td><strong>Filter By SM</strong></td><td width='10px'>:</td><td>
			<select name='id_sm' class='form-control'>
				<option selected value="{{getUserId()}}">SELECTED</option>
			</select>
		</td>
	</tr>

	@if(@!in_array('AM', $disableTeam))
	<tr>
		<td><strong>Filter By AM</strong></td><td width='10px'>:</td><td>
			<select name='id_am' class='form-control'>
				<option value="">** Semua AM</option>
				@php $resultAm = teamAM( getUserSession()->id_sm ); @endphp					
				@foreach($resultAm as $am)
					<option {{g('id_am')==$am->id?"selected":""}} value="{{$am->id}}">{{$am->kode_sales}} - {{$am->karyawan_nama}}</option>
				@endforeach
			</select>
		</td>
	</tr>
	@endif

	@if(@!in_array('MR', $disableTeam))
	<tr>
		<td><strong>Filter By MR</strong></td><td width='10px'>:</td><td>
			<select name='id_mr' class='form-control'>
				<option value="">** Semua MR</option>
			</select>
		</td>
	</tr>
	@endif

@elseif(getRole() == 'AM')
	@if(@!in_array('MR', $disableTeam))
	<tr>
		<td><strong>Filter By MR</strong></td><td width='10px'>:</td><td>
			<select name='id_mr' class='form-control'>
				<option value="">** Semua MR</option>
				@php $resultMr = teamMR(getUserSession()->id_user,getUserSession()->id_sm); @endphp					
				@foreach($resultMr as $mr)
					<option {{g('id_mr')==$mr->id?"selected":""}} value="{{$mr->id}}">{{$mr->kode_sales}} - {{$mr->karyawan_nama}}</option>
				@endforeach
			</select>
		</td>
	</tr>
	@endif
@endif
<?php 
	if(isset($callback)) {		
		echo call_user_func($callback);
	}
?>