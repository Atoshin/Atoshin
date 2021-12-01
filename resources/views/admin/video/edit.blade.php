@extends('admin.layout.master')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Info</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post"    action="{{route("videos.update",$video->id)}}">
            @method('patch')
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Link</label>
                    <input type="text" class="form-control" name="link" value="{{$video->link}}" placeholder="Link">
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="submit" class="btn btn-default float-right">Cancel</button>
            </div>
        </form>
    </div>
@endsection
