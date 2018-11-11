@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
           Update Profile
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        @if(session()->has('success'))
            <div class="alert alert-success" id="successMessage">
                {{ session()->get('success') }}
            </div>
        @endif
    <div class="box box-primary">

        <div class="box-body">
            <!--<b>GENERAL SETTINGS</b>-->
            <form role="form"  action="{{ url('admin/update-profile') }}" method="post" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="row">

                    <div class="box-body">
                        <div class="col-md-6">

                            <div class="form-group">

                                <label  class="col-sm-4 control-label">  @if($user_detail->is_admin == 2)First Name*@else Name* @endif :</label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="name" name="name" value="{{$user_detail->name}}" placeholder="Enter Name" type="text">
                                </div>
                            </div>
                            @if($user_detail->is_admin == 2)
                            <br/> <br/>
                            <div class="form-group">
                                <label  class="col-sm-4 control-label">Last Name* :</label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="last_name" name="last_name" value="{{$user_detail->last_name}}" placeholder="Enter Name" type="text">
                                </div>
                            </div>
                            @endif
                            <br/> <br/>
                            <div class="form-group">
                                <label  class="col-sm-4 control-label">Phone Number* :</label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="phone" name="phone"  value="{{$user_detail->phone}}"  placeholder="Enter Phone Number" type="text">
                                </div>
                            </div>
                            <br/> <br/>
                            <div class="form-group">
                                <label  class="col-sm-4 control-label">Email* :</label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="email" name="email"  value="{{$user_detail->email}}" placeholder="Enter Email Address" type="text">
                                </div>
                            </div>
                            @if($user_detail->is_admin == 2)
                            <br/> <br/>

                            <div class="form-group">
                                <label class="col-sm-4 control-label">Gender* : </label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="gender" name="gender">
                                        <option value="Male" @if($user_detail->gender == "Male") selected @endif>Male</option>
                                        <option value="Female" @if($user_detail->gender == "Female") selected @endif>Female</option>
                                    </select>
                                </div>
                            </div>
                            <br/> <br/>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Language* : </label>
                                <div class="col-sm-8">
                                        <input name="language[]" type="checkbox" value="English" @if(in_array("English", $languages)) checked @endif > English
                                        <input name="language[]" type="checkbox" value="Spanish" @if(in_array("Spanish", $languages)) checked @endif> Spanish
                                </div>
                            </div>
                            @endif

                            <br/> <br/>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Profile Photo</label>
                                <div class="col-sm-5">
                                    <input style="margin-top:7px;" class="form-control"  name="profile" type="file" id="profile">
                                </div>
                                <div class="col-sm-3">
                                    <div class="profile_photo_preview">
                                        @if($user_detail->profile !=NULL)
                                            <img src="{{asset('uploads/admin/'.$user_detail->profile) }}" alt="profile Photo" style="height: 80px;width: 80px;">
                                        @else
                                            <img src="{{asset('assets/images/profile.jpg') }}" alt="profile Photo" style="height: 80px;width: 80px;">
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" value="{{$user_detail->id}}" name="id">
                            <input type="hidden" value="{{$user_detail->profile}}" name="old_image_name">
                            <br/> <br/>

                        </div>
                        <div class="col-md-3"></div>


                    </div>
                    <div class="box-footer">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-8">
                            <input type="submit" class="btn btn-primary" value="Update Profile">
                            <a href="{!! route('admin.dashboard') !!}" class="btn btn-danger">Cancel</a>
                        </div>
                    </div>
                </div>

            </form>

        </div>
    </div>
    </div>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {

                setTimeout(function() {
                    $('#successMessage').fadeOut('fast');
                    console.log("hii");
                }, 2000); // <-- time in milliseconds

            //$(document).ajaxStart(function() { Pace.restart(); });
            if (window.File && window.FileList && window.FileReader) {
                $("#profile").on("change", function (e) {

                    var fileReader = new FileReader();
                    fileReader.onload = (function (e) {
                        var file = e.target;
                        $(".profile_photo_preview").html("<span class=\"pip\">" +
                            "<img style=\"height: 80px;width: 80px;\" class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                            "</span>")
                    });
                    fileReader.readAsDataURL(this.files[0]);

                });
            } else {
                alert("Your browser doesn't support to File API")
            }
        });

    </script>

@endsection
