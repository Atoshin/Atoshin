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
            <h3 class="card-title">Add Category</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post"  id="myform"   action="{{route('categories.store')}}">
            @csrf
            <div class="card-body">

                <div class="form-group">
                    <label >Title</label>
                    <input type="text" class="form-control" name="title" placeholder="title" value="{{old('title')}}">
                    @error('title')
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
                <button type="submit" id="btnSubmit" class="btn btn-primary">Submit</button>
{{--                <button type="submit" class="btn btn-default float-right">Cancel</button>--}}
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
