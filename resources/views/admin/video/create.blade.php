@extends('admin.layout.master')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">New Video</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form  method="post"    action="{{route('videos.store', $asset_id)}}">

            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Link</label>
                    <input type="url" class="form-control" name="link" placeholder="Link">
                </div>
{{--                <div class="form-check">--}}
{{--                    <input type="checkbox" class="form-check-input" id="exampleCheck1">--}}
{{--                    <label class="form-check-label" for="exampleCheck1">Check me out</label>--}}
{{--                </div>--}}
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="submit" class="btn btn-default float-right">Cancel</button>
            </div>
        </form>
    </div>


@endsection
