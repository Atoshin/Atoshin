@extends('admin.layout.master')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Info</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post"    action="{{route('artists.update',$artist->id)}}">
            @method('patch')
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Full name</label>
                    <input type="text" class="form-control" name="full_name" value="{{$artist->full_name}}" placeholder="Full name">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Avatar</label>
                    <input type="text" class="form-control" name="avatar" value="{{$artist->avatar}}" placeholder="Avatar">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Bio</label>
                    <input type="text" class="form-control" name="bio" value="{{$artist->bio}}" placeholder="Bio">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Website</label>
                    <input type="url" class="form-control" name="website" value="{{$artist->website}}" placeholder="Website">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Youtube</label>
                    <input type="url" class="form-control" name="youtube" value="{{$artist->youtube}}" placeholder="Youtube">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Instagram</label>
                    <input type="url" class="form-control" name="instagram" value="{{$artist->instagram}}" placeholder="Instagram">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Twitter</label>
                    <input type="url" class="form-control" name="twitter" value="{{$artist->twitter}}" placeholder="Twitter">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Facebook</label>
                    <input type="url" class="form-control" name="facebook" value="{{$artist->facebook}}" placeholder="Facebook">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Linkedin</label>
                    <input type="url" class="form-control" name="linkedin" value="{{$artist->linkedin}}" placeholder="Linkedin">
                </div>
{{--                <div class="form-group">--}}
{{--                    <label for="exampleInputPassword1">Wallet Address</label>--}}
{{--                    <input type="text" class="form-control" name="wallet_address" value="{{$user->wallet ? $user->wallet->wallet_address : ''}}" placeholder="Wallet Address">--}}
{{--                </div>--}}
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
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
