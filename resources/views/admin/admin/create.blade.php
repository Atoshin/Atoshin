@extends('admin.layout.master')
@section('content')

{{--    <div class="card card-info">--}}
{{--        <div class="card-header">--}}
{{--            <h3 class="card-title">New Admin</h3>--}}
{{--        </div>--}}
{{--        <!-- /.card-header -->--}}
{{--        <!-- form start -->--}}
{{--        <form class="form-horizontal"   method="post"    action="{{route('admins.store')}}">--}}
{{--            @csrf--}}
{{--            <div class="card-body">--}}
{{--                <div class="form-group row">--}}
{{--                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>--}}
{{--                    <div class="col-sm-10">--}}
{{--                        <input type="email" class="form-control" name="email" placeholder="Email">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="form-group row">--}}
{{--                    <label for="inputPassword3" class="col-sm-2 col-form-label">Username</label>--}}
{{--                    <div class="col-sm-10">--}}
{{--                        <input type="text" class="form-control" name="username" placeholder="Username">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="form-group row">--}}
{{--                    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>--}}
{{--                    <div class="col-sm-10">--}}
{{--                        <input type="password" class="form-control" name="password" placeholder="Password">--}}
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
{{--    //////--}}
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">New Admin</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post"  id="myform"  action="{{route('admins.store')}}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="email" placeholder="Enter email" value="{{old('email')}}">
                    @error('email')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Username <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="username" placeholder="Username" value="{{old('username')}}">
                    @error('username')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                    @error('password')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
{{--                <div class="form-group">--}}
{{--                    <label for="exampleInputFile">File input</label>--}}
{{--                    <div class="input-group">--}}
{{--                        <div class="custom-file">--}}
{{--                            <input type="file" class="custom-file-input" id="exampleInputFile">--}}
{{--                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>--}}
{{--                        </div>--}}
{{--                        <div class="input-group-append">--}}
{{--                            <span class="input-group-text">Upload</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit"  id="btnSubmit" class="btn btn-primary">Submit</button>
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
