@extends('admin.layout.master')
@section('content')

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">New User</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        <form  method="post"  id="myform"  action="{{route('users.store')}}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">First name </label>
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
                    <input type="email" class="form-control" name="email" placeholder="Email" value="{{old('email')}}">
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
                    <label for="exampleInputPassword1">Wallet Address <span class="text-danger">*</span></label>
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
@endsection
