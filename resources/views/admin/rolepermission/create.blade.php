@extends('admin.layout.master')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Add Role</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post"  id="myform"   action="{{route('role.permissions.store',$role->id)}}">
            @csrf
            <div class="card-body">

                <div class="form-group">
                    <label >Permissions<span class="text-danger">*</span></label>
                    <select class="js-example-basic-multiple form-control" name="permissions[]" multiple="multiple">
                        @foreach($permissions as $permission)
                        <option value="{{$permission->id}}">{{$permission->name}}</option>
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
