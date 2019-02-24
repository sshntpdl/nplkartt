@extends('admin.app')
@section('breadcrumbs')
  <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
 <li class="breadcrumb-item active" aria-current="page">users</li>
@endsection
@section('content')
  <div class="row d-block">
    <div class="col-sm-12">
      @if (session()->has('message'))
      <div class="alert alert-success">
        {{session('message')}}
      </div>
      @endif
    </div>
  </div>
<div class="justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
  <h2 class="h2 float-left">Users List</h2>

  
    <a href="{{route('admin.profile.create')}}" class="btn btn-sm btn-outline-secondary float-left ml-4 mt-1">
      Add user
    </a>

  
  <form action="{{route('admin.profile.search')}}" method="POST" role="search">
      @csrf
      <div class="input-group col-3 float-right">
          <input type="text" class="form-control" name="q" id="txtSearch" placeholder="Search Product" value="{{@$value}}">
           <span class="input-group-btn">
              <button type="submit" class="btn btn-default">
                  <span data-feather="search"></span>
              </button>
          </span>
      </div>
  </form>
 
</div>
<div class="table-responsive">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th>role</th>
        <th>Address</th>
        <th>Thumbnail</th>
        <th>Date Created</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @if(isset($users) && $users->count() > 0)
      @foreach($users as $user)
      <tr>
        <td>{{@$user->id}}</td>
        <td>{{@$user->profile->name}}</td>
        <td>{{@$user->email}}</td>
        <td>{{$user->role->name}}</td>
        <td>{{@$user->profile->address}}</td>
        <td><img src="{{asset('storage/'.@$user->profile->thumbnail)}}" alt="{{@$user->profile->name}}" class="img-responsive" height="50"/></td>
       
        <td>{{$user->created_at}}</td>
        <td><a class="btn btn-info btn-sm" href="{{route('admin.profile.edit', $user->profile->slug)}}">Edit</a> |
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal-{{$user->id}}">
              Preview
            </button>
            | <a class="btn btn-danger btn-sm"href="javascript:;" onclick="confirmDelete('{{$user->id}}')">Delete</a> 
              <form id="delete-user-{{$user->id}}" action="{{ route('admin.profile.destroy', $user->profile) }}" method="POST" style="display: none;">

              @method('DELETE')
              @csrf  
              </form>


        <!-- The Modal -->
              <div class="modal fade" id="myModal-{{$user->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                  
        <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">User Information</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
        <!-- Modal body -->
                    <div class="modal-body">
                      <div class="col-4 float-left"  style="border-right:2px solid yellowgreen;height:100%;">
                        <div class="row justify-content-center">
                          <img class="profile-image" src="{{asset('storage/'.@$user->profile->thumbnail)}}" alt="" style="width:100px;height:100px;border-radius:125px;">    
                        </div>
                        <div class="row justify-content-center">
                          <h5>@<strong>{{@$user->profile->name}}</strong></h5>
                        </div>
                        <div class="row justify-content-center">
                          <strong>{{@$user->role->name}}</strong><br>
                        </div>
                      </div>
                      <div class="col-8 float-left">
                        <h4 class="mr-5 ml-2"><strong>Information</strong></h4>
                        {{-- table started --}}
                        <div class="row pl-5">
                          <table class="table table-borderless">
    
                              <tbody>
                                  <tr>
                                      <td class="pr-2"><strong>Name:</strong></td>
                                      <td class="pl-2">{{@$user->profile->name}}</td>
                                  </tr>
                                  <tr>
                                      <td class="pr-2"><strong>Status:</strong></td>
                                      <td class="pl-2"> @if((@$user->status) == 1) Active User @else Blocked @endif </td>
                                  </tr>
                                  <tr>
                                      <td class="pr-2"><strong>Role:</strong></td>
                                      <td class="pl-2">{{@$user->role->name}}</td>
                                  </tr>
                                  <tr>
                                      <td class="pr-2"><strong>Email:</strong></td>
                                      <td class="pl-2">{{@$user->email}}</td>
                                  </tr>
                                  <tr>
                                      <td class="pr-2"><strong>Phone:</strong></td>
                                      <td class="pl-2">{{@$user->profile->phone}}</td>
                                  </tr>
                                  <tr>
                                      <td class="pr-2"><strong>Address:</strong></td>
                                      <td class="pl-2">{{@$user->profile->address}}</td>
                                  </tr>
                                 
                              </tbody>
                          </table>
                      </div>
                      <!-- table closed -->
                      </div>
                    </div>
                    
        <!-- Modal footer -->
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                    
                  </div>
                </div>
              </div>
            {{-- model closed --}}

        </td>
      
      </tr>
      @endforeach
      @else
      <tr>
        <td colspan="7" class="alert alert-info">No users Found..</td>
      </tr>
      @endif

    </tbody>

  </table>
</div>
<div class="row">
  <div class="col-md-12">
    {{$users->links()}}
  </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
  function confirmDelete(id){
    let choice = confirm("Are You sure, You want to Delete this user ?")
    if(choice){
      document.getElementById('delete-user-'+id).submit();
    }
  }
</script>
@endsection 