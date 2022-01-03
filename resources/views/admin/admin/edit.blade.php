@extends('admin.layout.master')
@section('content')
{{--    <div class="card card-info">--}}
{{--        <div class="card-header">--}}
{{--            <h3 class="card-title">Edit Info</h3>--}}
{{--        </div>--}}
{{--        <!-- /.card-header -->--}}
{{--        <!-- form start -->--}}
{{--        <form class="form-horizontal"  method="post"   action="{{route('admins.update',$admin->id)}}">--}}
{{--            @method('patch')--}}
{{--            @csrf--}}
{{--            <div class="card-body">--}}
{{--                <div class="form-group row">--}}
{{--                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>--}}
{{--                    <div class="col-sm-10">--}}
{{--                        <input type="email" class="form-control" name="email" value="{{$admin->email}}" placeholder="Email">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="form-group row">--}}
{{--                    <label for="inputPassword3" class="col-sm-2 col-form-label">Username</label>--}}
{{--                    <div class="col-sm-10">--}}
{{--                        <input type="text" class="form-control" name="username" value="{{$admin->username}}" placeholder="Username">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="form-group row">--}}
{{--                    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>--}}
{{--                    <div class="col-sm-10">--}}
{{--                        <input type="password" class="form-control" name="password" value="{{$admin->password}}"  placeholder="Password">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- /.card-body -->--}}
{{--            <div class="card-footer">--}}
{{--                <button type="submit" class="btn btn-info">Submit</button>--}}
{{--                <button type="submit" class="btn btn-default float-right">Cancel</button>--}}
{{--            </div>--}}
{{--            <!-- /.card-footer -->--}}
{{--        </form>--}}
{{--    </div>--}}
{{--    ///--}}
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Info</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post"   id="myform" action="{{route('admins.update',$admin->id)}}">
            @method('patch')
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="email" value="{{$admin->email}}" placeholder="Enter email">
                    @error('email')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Username <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="username" value="{{$admin->username}}" placeholder="Username">
                    @error('username')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>

{{--                <div class="form-group">--}}
{{--                    <label for="exampleInputPassword1">Password</label>--}}
{{--                    <input type="password" class="form-control" name="password" value="{{$admin->password}}" placeholder="Password">--}}
{{--                    @error('password')--}}
{{--                    <small class="text-danger">--}}
{{--                        {{$message}}--}}
{{--                    </small>--}}
{{--                    @enderror--}}
{{--                </div>--}}

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" id="btnSubmit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
    <script>
        $("#myform").on('submit',function (){
            $("#btnSubmit").attr("disabled", true);
        });

    </script>
@endsection
