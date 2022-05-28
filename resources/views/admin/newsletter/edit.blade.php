@extends('admin.layout.master')
@section('content')

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Email</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post"  id="myform"  action="{{route('newsletters.update', $newsletter->id)}}">
            @method('patch')
            @csrf
            <div class="card-body">

                <div class="form-group">
                    <label >Email<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="email" placeholder="email" value="{{$newsletter->email}}">
                    @error('email')
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
