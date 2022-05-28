@extends('admin.layout.master')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Landing Text</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post"   id="myform" action="{{route('landings.update',\App\Models\Landing::query()->first()->id)}}">
            @method('patch')
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Text</label>
                    <input type="text" class="form-control" name="text" value="{{$landing->text}}">
                    @error('text')
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


