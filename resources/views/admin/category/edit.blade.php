@extends('admin.layout.master')
@section('content')

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Category</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post"  id="myform"  action="{{route('categories.update', $category->id)}}">
            @method('patch')
            @csrf
            <div class="card-body">

                <div class="form-group">
                    <label >Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="title" placeholder="title" value="{{$category->title}}">
                    @error('title')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
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
