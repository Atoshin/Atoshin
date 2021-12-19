@extends('admin.layout.master')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">New News</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" id="myform" action="{{route('news.store', $artist_id)}}">

            @csrf
            <div class="card-body">
                <div class="form-group">
                    <div></div>
                    <label for="exampleInputEmail1">Link</label>
                    <input type="text" class="form-control" name="link" placeholder="Link" value="{{old('link')}}">
                    @error('link')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div>
                    <label for="exampleInputEmail1">Title</label>
                    <input type="text" class="form-control" name="title" placeholder="Title" value="{{old('title')}}">
                    @error('link')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
            </div>
        {{--                <div class="form-check">--}}
        {{--                    <input type="checkbox" class="form-check-input" id="exampleCheck1">--}}
        {{--                    <label class="form-check-label" for="exampleCheck1">Check me out</label>--}}
        {{--                </div>--}}
{{--    </div>--}}
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
