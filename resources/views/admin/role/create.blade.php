@extends('admin.layout.master')
@section('content')
    <div class="card card-primary">
        <div class="card-header">

            <h3 class="card-title">Add Role</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post"  id="myform"   action="{{route('roles.store')}}">
            @csrf
            <div class="card-body">

                <div class="form-group">
                    <label >Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" placeholder="name" value="{{old('name')}}">
                    @error('name')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>

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
