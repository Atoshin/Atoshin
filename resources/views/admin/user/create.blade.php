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
            <h3 class="card-title">New User</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form  method="post"    action="{{route('users.store')}}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">First name</label>
                    <input type="text" class="form-control" name="first_name" placeholder="Firstname" value="{{old('first_name')}}">
                    @error('first_name')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Last name</label>
                    <input type="text" class="form-control" name="last_name" placeholder="Lastname" value="{{old('last_name')}}">
                    @error('last_name')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
               </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Email</label>
                    <input type="text" class="form-control" name="email" placeholder="Email" value="{{old('email')}}">
                    @error('email')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Username" value="{{old('username')}}">
                    @error('username')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Bio</label>
                    <textarea type="text" class="form-control" name="bio" placeholder="Bio">{{old('bio')}}</textarea>
                    @error('bio')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Wallet Address</label>
                    <input type="text" class="form-control" name="wallet_address" placeholder="Wallet Address" value="{{old('wallet_address')}}">
                    @error('wallet_address')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
{{--                <div class="form-check">--}}
{{--                    <input type="checkbox" class="form-check-input" id="exampleCheck1">--}}
{{--                    <label class="form-check-label" for="exampleCheck1">Check me out</label>--}}
{{--                </div>--}}
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="submit" class="btn btn-default float-right">Cancel</button>
            </div>
        </form>
    </div>


@endsection

@section('scripts')

    <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'bio' );
    </script>
@endsection
