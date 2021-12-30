@extends('admin.layout.master')
@section('content')

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">New Manager</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        <form  method="post"  id="myform"  action="{{route('store.gallerying', $gallery_id)}}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Full name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="full_name" placeholder="Fullname" value="{{old('full_name')}}">
                    @error('full_name')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Title <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="title" placeholder="Title" value="{{old('title')}}">
                    @error('title')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Email </label>
                    <input type="text" class="form-control" name="email" placeholder="Email" value="{{old('email')}}">
                    @error('email')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Telephone <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="telephone" placeholder="Telephone" value="{{old('telephone')}}">
                    @error('telephone')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div style="margin-top: 15px">
                    <input type="checkbox" name="is_owner" id="is_default">
                    <label for="exampleInputEmail1">This entity owns the gallery</label>
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

@section('scripts')

{{--    <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>--}}
{{--    <script>--}}
{{--        CKEDITOR.replace( 'bio' );--}}
{{--    </script>--}}
    <script>
        $("#myform").on('submit',function (){
            $("#btnSubmit").attr("disabled", true);
        });

    </script>
@endsection
