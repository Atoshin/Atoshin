@extends('admin.layout.master')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Info</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post"    action="{{route('users.update',$user->id)}}">
            @method('patch')
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">First name</label>
                    <input type="text" class="form-control" name="first_name" value="{{$user->first_name}}" placeholder="Firstname">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Last name</label>
                    <input type="text" class="form-control" name="last_name" value="{{$user->last_name}}" placeholder="Lastname">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Avatar</label>
                    <input type="text" class="form-control" name="avatar" value="{{$user->avatar}}" placeholder="Avatar">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Email</label>
                    <input type="email" class="form-control" name="email" value="{{$user->email}}" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Username</label>
                    <input type="text" class="form-control" name="username" value="{{$user->username}}" placeholder="Username">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Bio</label>
                    <input type="text" class="form-control" name="bio" value="{{$user->bio}}" placeholder="Bio">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Wallet Address</label>
                    <input type="text" class="form-control" name="wallet_address" value="{{$user->wallet ? $user->wallet->wallet_address : ''}}" placeholder="Wallet Address">
                </div>
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
