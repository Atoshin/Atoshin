@extends('admin.layout.master')
@section('content')

    {{--    <div class="card card-info">--}}
    {{--        <div class="card-header">--}}
    {{--            <h3 class="card-title">New User</h3>--}}
    {{--        </div>--}}
    {{--        <!-- /.card-header -->--}}
    {{--        <!-- form start -->--}}
    {{--        <form class="form-horizontal"   method="post"    action="{{route('admin.store')}}">--}}
    {{--            @csrf--}}
    {{--            <div class="card-body">--}}
    {{--                <div class="form-group row">--}}
    {{--                    <label for="inputEmail3" class="col-sm-2 col-form-label">first_name</label>--}}
    {{--                    <div class="col-sm-10">--}}
    {{--                        <input type="text" class="form-control" name="first_name" placeholder="first_name">--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="form-group row">--}}
    {{--                    <label for="inputPassword3" class="col-sm-2 col-form-label">last_name</label>--}}
    {{--                    <div class="col-sm-10">--}}
    {{--                        <input type="text" class="form-control" name="last_name" placeholder="last_name">--}}
    {{--                    </div>--}}
    {{--                <div class="form-group row">--}}
    {{--                    <label for="inputPassword3" class="col-sm-2 col-form-label">email</label>--}}
    {{--                    <div class="col-sm-10">--}}
    {{--                        <input type="email" class="form-control" name="email" placeholder="email">--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="form-group row">--}}
    {{--                    <label for="inputPassword3" class="col-sm-2 col-form-label">username</label>--}}
    {{--                    <div class="col-sm-10">--}}
    {{--                        <input type="text" class="form-control" name="username" placeholder="username">--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                </div>--}}
    {{--                <div class="form-group row">--}}
    {{--                    <label for="inputPassword3" class="col-sm-2 col-form-label">avatar</label>--}}
    {{--                    <div class="col-sm-10">--}}
    {{--                        <input type="text" class="form-control" name="avatar" placeholder="avatar">--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            <div class="form-group row">--}}
    {{--                <label for="inputPassword3" class="col-sm-2 col-form-label">bio</label>--}}
    {{--                <div class="col-sm-10">--}}
    {{--                    <input type="text" class="form-control" name="bio" placeholder="bio">--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            </div>--}}
    {{--            <!-- /.card-body -->--}}
    {{--            <div class="card-footer">--}}
    {{--                <button type="submit" class="btn btn-info">Submit</button>--}}
    {{--                <button type="submit" class="btn btn-default float-right">Cancel</button>--}}
    {{--            </div>--}}
    {{--            <!-- /.card-footer -->--}}
    {{--        </form>--}}
    {{--    </div>--}}

    {{--/////--}}
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">New Artist</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form  method="post"    action="{{route('artists.store')}}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Full name</label>
                    <input type="text" class="form-control" name="full_name" placeholder="Full name">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Avatar</label>
                    <input type="text" class="form-control" name="avatar" placeholder="Avatar">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Bio</label>
                    <textarea type="text" class="form-control" name="bio" placeholder="Bio"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Website</label>
                    <input type="url" class="form-control" name="website" placeholder="Website">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Youtube</label>
                    <input type="url" class="form-control" name="youtube" placeholder="Youtube">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Instagram</label>
                    <input type="url" class="form-control" name="instagram" placeholder="Instagram">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Twitter</label>
                    <input type="url" class="form-control" name="twitter" placeholder="Twitter">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Facebook</label>
                    <input type="url" class="form-control" name="facebook" placeholder="Facebook">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Linkedin</label>
                    <input type="url" class="form-control" name="linkdin" placeholder="Linkedin">
                </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="submit" class="btn btn-default float-right">Cancel</button>
            </div>
        </form>
    </div>


@endsection
