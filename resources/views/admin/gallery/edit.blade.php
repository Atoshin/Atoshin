@extends('admin.layout.master')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Info</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post"    action="{{route('galleries.update',$gallery->id)}}">
            @method('patch')
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" name="name" value="{{$gallery->name}}" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Bio</label>
                    <textarea type="text" class="form-control" name="bio" value="{{$gallery->bio}}" placeholder="Bio">{{$gallery->bio}}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Avatar</label>
                    <input type="text" class="form-control" name="avatar" value="{{$gallery->avatar}}" placeholder="Avatar">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Wallet Address</label>
                    <input type="text" class="form-control" name="wallet_address" value="{{$gallery->wallet ? $gallery->wallet->wallet_address : ''}}" placeholder="Wallet Address">
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
