@extends('admin.layout.master')
@section('content')

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Info</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post"   id="myform" action="{{route('gallerying.update',$gallerying->id)}}">
            @method('patch')
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Full name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="full_name" value="{{$gallerying->full_name}}" placeholder="Full name">
                    @error('full_name')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="title" value="{{$gallerying->title}}" placeholder="Title">
                    @error('title')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Email</label>
                    <input type="text" class="form-control" name="email" value="{{$gallerying->email}}" placeholder="Title">
                    @error('email')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Telephone<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="telephone" value="{{$gallerying->telephone}}" placeholder="Telephone">
                    @error('telephone')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div style="margin-top: 15px">
                    <input type="checkbox"
                           @if($gallerying->is_owner==true) checked
                           @endif
                           name="is_owner" id="is_default">
                    <label for="exampleInputEmail1">is-owner</label>
                </div>
                {{--                <div class="form-group">--}}
                {{--                    <label for="exampleInputPassword1">Password</label>--}}
                {{--                    <input type="password" class="form-control" name="password" value="{{$admin->password}}" placeholder="Password">--}}
                {{--                    @error('password')--}}
                {{--                    <small class="text-danger">--}}
                {{--                        {{$message}}--}}
                {{--                    </small>--}}
                {{--                    @enderror--}}
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
    <script>
        $("#myform").on('submit',function (){
            $("#btnSubmit").attr("disabled", true);
        });

    </script>
@endsection
