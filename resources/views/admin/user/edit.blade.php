@extends('admin.layout.master')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Info</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post"   id="myform" action="{{route('users.update',$user->id)}}">
            @method('patch')
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">First name </label>
                    <input type="text" class="form-control" name="first_name" value="{{$user->first_name}}" placeholder="Firstname">
                    @error('first_name')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Last name</label>
                    <input type="text" class="form-control" name="last_name" value="{{$user->last_name}}" placeholder="Lastname">
                    @error('last_name')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Email</label>
                    <input type="text" class="form-control" name="email" value="{{$user->email}}" placeholder="Email">
                    @error('email')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Username</label>
                    <input type="text" class="form-control" name="username" value="{{$user->username}}" placeholder="Username">
                    @error('username')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Bio</label>
                    <textarea type="text" class="form-control" name="bio" value="{{$user->bio}}" placeholder="Bio">{{$user->bio}}</textarea>
                    @error('bio')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Wallet Address <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="wallet_address" value="{{$user->wallet ? $user->wallet->wallet_address : ''}}" placeholder="Wallet Address">
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
{{--                <a  class="btn btn-primary" href="{{route('upload.page.main.edit',['type'=>\App\Models\User::class,'id'=>$user->id])}}">edit user avatar</a>--}}
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" id="btnSubmit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')

    <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'bio' );
    </script>
    <script>
        $("#myform").on('submit',function (){
            $("#btnSubmit").attr("disabled", true);
        });

    </script>

    @if(\Illuminate\Support\Facades\Session::has('success'))
        @if(\Illuminate\Support\Facades\Session::get('success') == 'true')
            <script type="text/javascript">
                const buttons = `<a class="btn btn-outline-info float-left" href="{{route('users.index')}}">
                    <span class="row">
                        <i class="material-icons">arrow_back</i>
                        Back to Users
                    </span>

                </a>

                <a href="{{route('upload.page',['type'=>\App\Models\User::class,'id'=>$user->id,'edit'=>1])}}" id="continue" class="btn btn-outline-info float-right">
                    <span class="row">
                            Go to Media section
                            <i class="material-icons">arrow_forward</i>
                    </span>

                </a>`
                Swal.fire({
                    target: 'body',
                    icon: '{{\Illuminate\Support\Facades\Session::has('icon') ? \Illuminate\Support\Facades\Session::get('icon') : 'success'}}',
                    title: '{{\Illuminate\Support\Facades\Session::get('title')}}',
                    showCancelButton: false,
                    showConfirmButton: false,
                    timer: 100000,
                    html: buttons


                })
            </script>
        @endif
    @endif
@endsection
