@push('scripts')
	<script type="text/javascript">
		function showFilterTeam() {
			$('#modal-filter-team').modal('show');
		}
	</script>
  <style type="text/css">
    .datepicker-days table tbody tr td.disabled {
      cursor: not-allowed !Important;
      color: #dddddd !Important;
    }
    .table-filter tr td {
      padding: 5px;
    }
  </style>
@endpush

<div id="modal-filter-team" class="modal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"> {{$label?:"Filter"}}</h4>
      </div>
      <form method='get' action=''>
      <div class="modal-body table-responsive">
        	<table class="table-filter">            
            <tr>
              <td width="40%"></td><td width="10px"></td><td></td>
            </tr>
            @if($dateFilter=='date_range' || $dateFilter=='range_date')
            <tr>
              <td><strong>Range Tanggal</strong></td><td>:</td><td>
                <input type="text" style="width: 30%;display: inline-block;" placeholder="Dari" class="form-control datepicker" value="{{g('dari_tanggal')}}" name="dari_tanggal"> &nbsp;~&nbsp;
                <input type="text" style="width: 30%;display: inline-block;" placeholder="Sampai" class="form-control datepicker" value="{{g('sampai_tanggal')}}" name="sampai_tanggal">
              </td>
            </tr>            
            @endif

            
            <tr style="{{ ($dateFilter!='month')?"display:none":"" }} ">
              <td><strong>Periode</strong></td><td width="10px">:</td><td>
                <div class="row">
                  <div class="col-sm-8">
                      <select name="bulan" class="form-control">
                        <!-- <option value="">** Pilih Bulan</option> -->
                        <?php 
                          $currentBulan = g('bulan')?:date('n');
                          for($i=1;$i<=12;$i++) {
                            $selected = $currentBulan==$i?"selected":"";
                            $bulan = date('F',strtotime('1970-'.$i.'-1'));
                            echo "<option $selected value='$i'>".$bulan."</option>";
                          }
                        ?>
                      </select>
                  </div>
                  <div class="col-sm-4">
                    <input type="number" class="form-control" value="{{g('tahun')?:date('Y')}}" name="tahun">
                  </div>
                </div>
                
              </td>
            </tr>                       

            @include('admin.filter_team')
          </table>        

          @if($dateFilter=='date_range' || $dateFilter=='range_date')
            @push('scripts')
              <script type="text/javascript">
                $(function() {
                  $('input[name=dari_tanggal]').change(function() {
                      var dariTanggal = $(this).val();
                      $('input[name=sampai_tanggal]').val('').datepicker('setStartDate',dariTanggal);  
                  })                
                })
              </script>
            @endpush
          @endif


          @if($dateFilter=='month')
          @push('scripts')

              @if(in_array(getRole(),["DIRUT","MM","SUPERADMIN","NSM","ADM",]))
                <script type="text/javascript">
                  $(function() {
                    $('#modal-filter-team select[name=bulan],#modal-filter-team input[name=tahun]').change(function() {

                      $('#modal-filter-team').find('select[name=id_sm],select[name=id_am],select[name=id_mr]').val('');

                      var b = $('#modal-filter-team select[name=bulan]').val();
                      var t = $('#modal-filter-team input[name=tahun]').val();
                        $('select[name=id_sm]').html("<option value=''>Memuat data...</option>");
                        $.get("{{action('AdminDashboardController@getAjaxSm')}}?bulan="+b+"&tahun="+t,function(r) {
                          if(r.length>0) {
                            var opt = "<option value=''>** Semua SM</option>";
                            $.each(r,function(i,o) {
                              var select = ("{{g('id_sm')}}"==o.id)?"selected":"";
                              opt += "<option "+select+" value='"+o.id+"'>"+o.karyawan_nama+" - "+o.region_nama+"</option>";
                            })
                            $('select[name=id_sm]').html(opt);
                          }else{
                            $('select[name=id_sm]').html("<option value=''>** Semua SM</option>");  
                          }

                          @if(g('id_sm'))
                            $('select[name=id_sm]').val('{{g('id_sm')}}').trigger('change');
                          @endif
                        });
                    })
                  })
                </script>

              @elseif(getRole() == 'SM')
                @push('scripts')
                  <script type="text/javascript">

                      $(function() {
                        $('#modal-filter-team select[name=bulan],#modal-filter-team input[name=tahun]').change(function() {

                          $('#modal-filter-team').find('select[name=id_sm],select[name=id_am],select[name=id_mr]').val('');
                            var id_sm = "{{getUserId()}}";
                            var b = $('#modal-filter-team select[name=bulan]').val();
                            var t = $('#modal-filter-team input[name=tahun]').val();
                            console.log(id_sm);
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

                        });

                      });


                  </script>
                @endpush
              @elseif(getRole() == 'AM')

                @push('scripts')
                  <script type="text/javascript">

                      $(function() {
                        $('#modal-filter-team select[name=bulan],#modal-filter-team input[name=tahun]').change(function() {

                          $('#modal-filter-team').find('select[name=id_sm],select[name=id_am],select[name=id_mr]').val('');
                            var id_am = "{{getUserId()}}";                            
                            var b = $('#modal-filter-team select[name=bulan]').val();
                            var t = $('#modal-filter-team input[name=tahun]').val();
                            
                            $('select[name=id_mr]').html("<option value=''>Memuat data...</option>");
                            $.get("{{action('AdminDashboardController@getAjaxMrByAm')}}/"+id_am+"?bulan="+b+"&tahun="+t,function(r) {
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

                              @if(g('id_am'))
                                $('select[name=id_am]').val('{{g('id_am')}}').trigger('change');
                              @endif
                            });

                        });

                      });


                  </script>
                @endpush



              @endif
              <!--end else if-->
              
          @endpush
          @endif
          <!--end if dateFilter month-->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Filter</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->