@extends('layouts.app')
@section('content')
    <form  action="{{route('profile.update',$profile)}}"  method="post" accept-charset="utf-8" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="row">

            <div class="col-lg-3 col-xs-12 col-sm-12">
              <div class="row justify-content-center" style="border-right:2px solid yellowgreen;">
                    <img class="profile-image img-thumbnail" src="{{asset('storage/'.@$profile->thumbnail)}}" alt="" style="width:150px;height:150px;border-radius:125px;"  id="imgthumbnail" class="img-fluid" >    

                <div class="input-group mb-3 col-xs-12 col-sm-12">
                    <div class="custom-file ">
                        <input type="file"  class="custom-file-input" name="thumbnail" id="thumbnail" value="{{@$user->profile->thumbnail}}">
                        <label class="custom-file-label" for="thumbnail">Choose file</label>
                    </div>
                </div>
              </div>
            </div>

            <div class="col-lg-9 col-xs-12 col-sm-12">
                
                <div class="form-group-row">
                    <h3 class="mr-5 ml-2"> Information</h3>
                    <div class="row pl-5">
                            <table>
                                <thead>
                                    <th colspan="4" ></th>
                                    <th colspan="8" ></th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="pr-2"><strong>Name:</strong></td>
                                        <td class="pl-2"><input type="text" name="name" class="form-control" value="{{@$profile->name}}"></td>
                                    </tr>
                                    <tr>
                                        <td class="pr-2"><strong>Email:</strong></td>
                                        <td class="pl-2"><input type="text" name="email" class="form-control" value="{{@$user->email}}" required></td>
                                    </tr>
                                    <tr>
                                        <td class="pr-2"><strong>New Password:</strong></td>
                                        <td class="pl-2"><input type="text" name="password" class="form-control" value=""><small>Only fill above if you want to change your password.</small></td>
                                    </tr>
                                    <tr>
                                        <td class="pr-2"><strong>Phone:</strong></td>
                                        <td class="pl-2"><input type="text" name="phone" class="form-control" value="{{@$profile->phone}}"></td>
                                    </tr>
                                    <tr>
                                        <td class="pr-2"><strong>Address:</strong></td>
                                        <td class="pl-2"><input type="text" name="address" class="form-control" value="{{@$profile->address}}"></td>
                                    </tr>
                                    <tr>
                                        <td class="pr-2"></td>
                                        <td class="pl-2"><input type="submit" name="submit" class="btn btn-primary btn-block " value="Update Profile" /></td>
                                    </tr>
                                   
                                </tbody>
                            </table>
                        </div>
                </div>

            </div> 

        </div>
    </form>
@endsection
@section('scripts')
<script type="text/javascript">
$(function(){
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