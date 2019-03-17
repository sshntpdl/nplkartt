@extends('admin.app')
@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
@endsection
@section('content')
<h2 class="modal-title">Add/Edit Offers</h2>
<form  action="@if(isset($offer)) {{route('admin.offers.update', $offer)}} @else {{route('admin.offers.store')}} @endif" method="post" accept-charset="utf-8" enctype="multipart/form-data">
	<div class="row">
            @if(isset($offer))
            @method('PUT')
            @endif
            @csrf

            <div class="col-lg-9">
                    <div class="form-group row">
                            <div class="col-sm-12">
                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                            </div>
                            <div class="col-sm-12">
                                        @if (session()->has('message'))
                                        <div class="alert alert-success">
                                            {{session('message')}}
                                        </div>
                                        @endif
                            </div>
                    </div>
                </div>
            </div>
            <div class="form-group-row">
                    <div class="col-12">
                            <label class="form-control-label">Title: </label>
                            <input type="text" name="title" class="form-control" value="{{@$offer->title}}" required>
                    </div>
            </div>
            <div class="form-group-row">

                    <div class="col-lg-12">
                        <label class="form-control-label">Description: </label>
                        <textarea name="description" id="editor" class="form-control ">{!! @$offer->description !!}</textarea>
                    </div>
                </div>
            
            <div class="form-group-row">
                <div class="col-lg-12">
                        <label class="form-control-label">Discount: </label>
                        <input type="text" name="discount_price"  class="form-control " value={{ @$offer->discount_price }}>
                </div>
            </div>
            <div class="form-group-row">
                <div class="col-lg-12">
                        <label class="form-control-label">Image: </label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="thumbnail" id="thumbnail">
                            <label class="custom-file-label" for="thumbnail">Choose file</label>
                        </div>
                        <div class="img-thumbnail  text-center">
                            <img src="@if(isset($offer)) {{asset('storage/'.$offer->thumbnail)}} @else {{asset('images/no-thumbnail.jpg')}} @endif" id="imgthumbnail" class="img-fluid" alt="">
                        </div>
                        
                </div>
            </div>
            <div class="form-group row">
                    <div class="col-sm-12">
                        @if(isset($offer))
                        <input type="submit" name="submit" class="btn btn-primary" value="Update Offer" />
                        @else
                        <input type="submit" name="submit" class="btn btn-primary" value="Add Offer" />
                        @endif
                    </div>
            </div>
</form>
@endsection
@section('scripts')
<script type="text/javascript">
	$(function(){
			ClassicEditor.create( document.querySelector( '#editor' ), {
		toolbar: [ 'Heading', 'Link', 'bold', 'italic', 'bulletedList', 'numberedList', 'blockQuote','undo', 'redo' ],
	})
    .then( editor => {
    console.log( editor );
    } )
    .catch( error => {
    console.error( error );
    });
    $('#thumbnail').on('change', function() {
    var file = $(this).get(0).files;
    var reader = new FileReader();
    reader.readAsDataURL(file[0]);
    reader.addEventListener("load", function(e) {
    var image = e.target.result;
    $("#imgthumbnail").attr('src', image);
    });
    });
    })
</script>
@endsection