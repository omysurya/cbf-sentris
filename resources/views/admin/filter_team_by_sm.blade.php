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

        	<table class="table table-striped">
            @include('admin.filter_team_sm')

            @if($dateFilter=='date_range' || $dateFilter=='range_date')
            <tr>
              <td><strong>Range Tanggal</strong></td><td>:</td><td>
                <input type="text" style="width: 30%;display: inline-block;" placeholder="Dari" class="form-control datepicker" value="{{g('dari_tanggal')}}" name="dari_tanggal"> &nbsp;~&nbsp;
                <input type="text" style="width: 30%;display: inline-block;" placeholder="Sampai" class="form-control datepicker" value="{{g('sampai_tanggal')}}" name="sampai_tanggal">
              </td>
            </tr>            
            @endif

            @if($dateFilter=='month')
            <tr>
              <td><strong>Filter Bulan</strong></td><td>:</td><td>
                <select name="bulan" class="form-control">
                  <option value="">** Pilih Bulan</option>
                  <?php 
                    for($i=1;$i<=12;$i++) {
                      $selected = g('bulan')==$i?"selected":"";
                      $bulan = \DateTime::createFromFormat('n',$i)->format('F');
                      echo "<option $selected value='$i'>".$bulan."</option>";
                    }
                  ?>
                </select>
              </td>
            </tr>   
            <tr>
              <td><strong>Filter Tahun</strong></td><td>:</td><td>
                <select name="tahun" class="form-control">
                  <option value="">** Pilih Tahun</option>
                  <?php 
                    for($i=date('Y');$i>=2013;$i--) {
                      $selected = g('tahun')==$i?"selected":"";                      
                      echo "<option $selected value='$i'>".$i."</option>";
                    }
                  ?>
                </select>
              </td>
            </tr>         
            @endif
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

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Filter</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->