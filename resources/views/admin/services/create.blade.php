@extends('admin.app')
@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
@endsection
@section('content')
<h2 class="modal-title">Add/Edit Service Centers</h2>
<form  action="@if(isset($service)) {{route('admin.service.update', $service)}} @else {{route('admin.service.store')}} @endif" method="post" accept-charset="utf-8">
	<div class="row">
		
        @if(isset($service))
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
            <label class="form-control-label">City: </label>
            <input type="text" id="txturl" name="city" class="form-control " value="{{@$service->city}}" required>
        </div>
    </div><br>
    <div class="form-group-row">
        <div class="col-12">
            <label class="form-control-label">Location: </label>
            <input type="text" id="txturl" name="location" class="form-control " value="{{@$service->location}}" required>
        </div>
    </div><br>
    <div class="form-group-row">
        <div class="col-12">
            <label class="form-control-label">Contact: </label>
            <input type="text" id="txturl" name="contact" class="form-control " value="{{@$service->contact}}" required>
        </div>
    </div><br>
    <div class="form-group row">
        <div class="col-sm-12">
            @if(isset($service))
            <input type="submit" name="submit" class="btn btn-primary" value="Update Center" />
            @else
            <input type="submit" name="submit" class="btn btn-primary" value="Add Center" />
            @endif
        </div>

    </div>
</form>
@endsection