@extends('admin.layout.master')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <a href="{{route('admins.index')}}" type="button"
               class="btn btn-success mr-2 float-right"> <i
                    class="fa fa-certificate mr-2 "></i> Admin Table</a>
            <h3 class="card-title">Add Role</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post"  id="myform"   action="{{route('admin.roles.store',$admin)}}">
            @csrf
            <div class="card-body">

                <div class="form-group">
                    <label >Roles for {{$admin->username}}<span class="text-danger">*</span></label>
                    <select class="js-example-basic-multiple form-control" name="roles[]" multiple="multiple">
                        @foreach($roles as $role)
                            <option @if(in_array($role->name,$admin_roles)) selected @endif value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                    </select>
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
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>


@endsection
