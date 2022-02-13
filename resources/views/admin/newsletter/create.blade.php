@extends('admin.layout.master')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Add Email</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post"  id="myform"   action="{{route('newsletters.store')}}">
            @csrf
            <div class="card-body">

                <div class="form-group">
                    <label >Email <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="email" placeholder="email" value="{{old('email')}}">
                    @error('email')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                {{--                <div class="form-group">--}}
                {{--                    <label for="exampleInputFile">File input</label>--}}
                {{--                    <div class="input-group">--}}
                {{--                        <div class="custom-file">--}}
                {{--                            <input type="file" class="custom-file-input" id="exampleInputFile">--}}
                {{--                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>--}}
                {{--                        </div>--}}
                {{--                        <div class="input-group-append">--}}
                {{--                            <span class="input-group-text">Upload</span>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
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
