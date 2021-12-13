@extends('admin.layout.master')
@section('styles')
    <style>
        textarea{
            color: #000000 !important;
            background-color: #000000 !important;
        }
    </style>
@endsection
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
                    <input type="text" class="form-control" name="full_name" placeholder="Full name" value="{{old('full_name')}}">
                    @error('full_name')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Bio</label>
                    <textarea type="text" class="form-control editor" name="bio" placeholder="Bio" id="editor" >{{old('bio')}}</textarea>
                    @error('bio')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Website</label>
                    <input type="text" class="form-control" name="website" placeholder="Website" value="{{old('website')}}">
                    @error('website')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Youtube</label>
                    <input type="text" class="form-control" name="youtube" placeholder="Youtube" value="{{old('youtube')}}">
                    @error('youtube')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Instagram</label>
                    <input type="text" class="form-control" name="instagram" placeholder="Instagram" value="{{old('instagram')}}">
                    @error('instagram')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Twitter</label>
                    <input type="text" class="form-control" name="twitter" placeholder="Twitter" value="{{old('twitter')}}">
                    @error('twitter')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Facebook</label>
                    <input type="text" class="form-control" name="facebook" placeholder="Facebook" value="{{old('facebook')}}">
                    @error('facebook')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Linkedin</label>
                    <input type="text" class="form-control" name="linkedin" placeholder="Linkedin" value="{{old('linkedin')}}">
                    @error('linkedin')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
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

@section('scripts')

    <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'bio' );
    </script>
@endsection
