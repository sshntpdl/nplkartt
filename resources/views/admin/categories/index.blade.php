@extends('admin.app')
@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
<li class="breadcrumb-item active" aria-current="page">Categories</li>
@endsection
@section('content')
    <div class="justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h2 class="h2 float-left">Categories List</h2>
        
            <a href="{{route('admin.category.create')}}" class="btn btn-sm btn-outline-secondary float-left ml-4 mt-1">
                Add Category
            </a>

            <form action="{{route('admin.category.search')}}" method="POST" role="search">
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
       
    </div><br>
    <div class="col-sm-12">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{session('message')}}
                </div>
            @endif
    </div>

    <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Slug</th>
                  <th>Childrens</th>
                  <th>Date Created</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                  @if($categories->count() > 0)
                  @foreach($categories as $category)
                        <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->title}}</td>
                        <td>{!! $category->description !!}</td>
                        <td>{{$category->slug}}</td>
                        <td>
                            @if($category->childrens()->count()>0)
                                @foreach($category->childrens as $children)
                                    {{$children->title}},
                                @endforeach
                            @else
                                <strong>{{"Parent Category"}}</strong>
                            @endif
                        </td>
                        
                       
                
                <td>{{$category->created_at}}</td>
                <td><a class="btn btn-info btn-sm" href="{{route('admin.category.edit',$category->slug)}}">Edit</a> | 
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal-{{$category->id}}">
                        Preview
                      </button>
                   | <a class="btn btn-danger btn-sm" href="javascript:;" onclick="confirmDelete('{{$category->id}}')">Delete</a>
                <form id="delete-category-{{$category->id}}" action="{{ route('admin.category.destroy', $category->slug) }}" method="POST" style="display: none;">
          
                  @method('DELETE')
                  @csrf
                </form>

                               <!-- The Modal -->
               <div class="modal fade" id="myModal-{{$category->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                  
        <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Category Information</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
        <!-- Modal body -->
                    <div class="modal-body">
                      
                      <div class="col-12">
                        <h4 class="mr-5 ml-2"><strong>Information</strong></h4>
                        {{-- table started --}}
                        <div class="row pl-5">
                          <table class="table table-borderless">
    
                              <tbody>
                                  <tr>
                                      <td class="pr-2"><strong>Name:</strong></td>
                                      <td class="pl-2">{{@$category->title}}</td>
                                  </tr>
                                  <tr>
                                      <td class="pr-2"><strong>Description:</strong></td>
                                      <td class="pl-2">{!! @$category->description !!}</td>
                                  </tr>
                                  <tr>
                                      <td class="pr-2"><strong>Childrens:</strong></td>
                                      <td class="pl-2">
                                        @if($category->childrens()->count()>0)
                                        @foreach($category->childrens as $children)
                                            {{$children->title}},
                                        @endforeach
                                        @else
                                            <strong>Parent Category</strong>
                                         @endif
                                      </td>
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
              <td colspan="7" class="alert alert-info">No Categories Found..</td>
            </tr>
            @endif
          
          </tbody>
          
          </table>
    </div>
    <div class="row">
        <div class="col-md-12">
            {{$categories->links()}}
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        function confirmDelete(id){
            let choice = confirm('Are you sure you want to delete this record?')
            if(choice){
                document.getElementById('delete-category-'+id).submit();
            }
        }
    </script>
@endsection