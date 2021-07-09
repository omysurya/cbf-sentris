@extends('admin.layout')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Berita    
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url(config('app.adminPath'))}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li>Master</li>
    <li class="active">Berita</li>
  </ol>
</section>
  
<!-- Main content -->
<section class="content"> 
	{!! bootstrapAlert() !!}
	<div class="panel panel-default">
		<div class="panel-heading">Edit Data</div>

		<form method="post" action="" class="form-horizontal" enctype="multipart/form-data">
		{!! csrf_field() !!}
		<div class="panel-body">

			<!-- <div class="form-group">
				<label class="control-label col-sm-2">Devisi</label>
				<div class="col-sm-10">	 				
					<select class="form-control" name='id_devisi' required >
						<option value="">** Pilih Devisi</option>
						@php $combo = getData('devisi',NULL,'nama asc'); @endphp
						@foreach($combo as $c)
							<option {{$c->id==$row->id_devisi?"selected":""}} value="{{$c->id}}">{{$c->nama}}</option>
						@endforeach
					</select>
				</div>
			</div> -->
			
			<div class="form-group">
				<label class="control-label col-sm-2">Judul</label>
				<div class="col-sm-10">					
					<input type="text" name="judul" class="form-control" value="{{ old('judul')?:$row->judul }}" required >				
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2">Isi</label>
				<div class="col-sm-10">					
					<textarea name='isi' id='isi' class="form-control">{{ old('isi')?:$row->isi }}</textarea>
				</div>
			</div>

			@push('scripts')
				<!-- include summernote css/js-->
				<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.css" rel="stylesheet">
				<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.js"></script>		
				<script type="text/javascript">
					$(document).ready(function() {
				        $('#isi').summernote({
				        	height: ($(window).height() - 300),
						    callbacks: {
						        onImageUpload: function(image) {
						            uploadImage(image[0]);
						        }
						    }
				        });
				    });
				    function uploadImage(image) {
					    var data = new FormData();
					    data.append("userfile", image);
					    data.append("_token","{{csrf_token()}}");
					    $.ajax({
					        url: '{{action("AdminBeritaController@postUploadImage")}}',
					        cache: false,
					        contentType: false,
					        processData: false,
					        data: data,
					        type: "post",
					        success: function(url) {
					            var image = $('<img>').attr('src',url);
					            $('#isi').summernote("insertNode", image[0]);
					        },
					        error: function(data) {
					            console.log(data);
					        }
					    });
					}
				</script>
			@endpush

			<div class="form-group">
				<label class="control-label col-sm-2">Kategori</label>
				<div class="col-sm-10">					
					<select class="form-control" name='id_berita_kategori' required >
						<option value="">** Pilih Kategori</option>
						@php $combo = getData('berita_kategori',NULL,'nama asc'); @endphp
						@foreach($combo as $c)
							<option {{$row->id_berita_kategori==$c->id?"selected":""}} value="{{$c->id}}">{{$c->nama}}</option>
						@endforeach
					</select>
				</div>
			</div>
			
			<div class="form-group hidden">
				<label class="control-label col-sm-2">Distribution</label>
				<div class="col-sm-10">					
					<select class="form-control" name='distribution' required >
						<option {{$row->distribution=='ALL'?"selected":""}} value="ALL">ALL</option>
						<option {{$row->distribution=='SM'?"selected":""}} value="SM">SM</option>
						<option {{$row->distribution=='AM'?"selected":""}} value="AM">AM</option>
						<option {{$row->distribution=='MR'?"selected":""}} value="MR">MR</option>
						<option {{$row->distribtuion=='PM'?"selected":""}} value="PM">PM</option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2">Status</label>
				<div class="col-sm-10">					
					<select class="form-control" name='status' required >
						<option value="">** Pilih Status</option>
						<option {{$row->status=='pending'?"selected":""}} value="pending">Pending</option>
						<option {{$row->status=='publish'?"selected":""}} value="publish">Publish</option>
					</select>
				</div>
			</div>

		</div>
		<div class="panel-footer" align="right">
			<a href="{{action('AdminBeritaController@getIndex')}}" class="btn btn-default">Back</a>
			<input type="submit" class="btn btn-primary" name="submit" value="Simpan Data">
		</div>
		</form>
	</div>
</section>
<!-- /.content -->

@endsection