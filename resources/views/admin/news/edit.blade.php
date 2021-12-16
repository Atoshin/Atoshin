@extends('admin.layout.master')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit News</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form  method="post"    action="{{route('news.update', $news->id)}}">
            @method('patch')
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <div>
                    <label for="exampleInputEmail1">Link</label>
                    <input type="text" class="form-control" name="link" placeholder="Link" value="{{$news->link}}">
                    @error('link')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                    </div>
                    <div>
                    <label for="exampleInputEmail1">Title</label>
                    <input type="text" class="form-control" name="title" placeholder="Title" value="{{$news->title}}">
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
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>


@endsection
