@extends('admin.layout.master')
@section('content')
    div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">New Gallery</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form  method="post"  id="myform"  action="{{route('galleries.store')}}">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Name" value="{{old('name')}}">
                @error('name')
                <small class="text-danger">
                    {{$message}}
                </small>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Bio</label>
                <textarea type="text" class="form-control" name="bio" placeholder="Bio">{{old('bio')}}</textarea>
                @error('bio')
                <small class="text-danger">
                    {{$message}}
                </small>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Summary</label>
                <textarea type="text" class="form-control" name="summary" placeholder="Bio">{{old('summary')}}</textarea>
                @error('summary')
                <small class="text-danger">
                    {{$message}}
                </small>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Wallet Address</label>
                <input type="text" class="form-control" name="wallet_address" placeholder="Wallet Address" value="{{old('wallet_address')}}">
                @error('wallet_address')
                <small class="text-danger">
                    {{$message}}
                </small>
                @enderror
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Website</label>
                <input type="text" class="form-control" name="website" placeholder="Website" value="{{old('website')}}">
                @error('website')
                <small class="text-danger">
                    {{$message}}
                </small>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Youtube</label>
                <input type="text" class="form-control" name="youtube" placeholder="Youtube" value="{{old('youtube')}}">
                @error('youtube')
                <small class="text-danger">
                    {{$message}}
                </small>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Instagram</label>
                <input type="text" class="form-control" name="instagram" placeholder="Instagram" value="{{old('instagram')}}">
                @error('instagram')
                <small class="text-danger">
                    {{$message}}
                </small>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Twitter</label>
                <input type="text" class="form-control" name="twitter" placeholder="Twitter" value="{{old('twitter')}}">
                @error('twitter')
                <small class="text-danger">
                    {{$message}}
                </small>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Facebook</label>
                <input type="text" class="form-control" name="facebook" placeholder="Facebook" value="{{old('facebook')}}">
                @error('facebook')
                <small class="text-danger">
                    {{$message}}
                </small>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Linkedin</label>
                <input type="text" class="form-control" name="linkedin" placeholder="Linkedin" value="{{old('linkedin')}}">
                @error('linkedin')
                <small class="text-danger">
                    {{$message}}
                </small>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Status</label>
                <select name="status" class="form-control" id="">
                    <option value="unpublished">unpublished</option>
                    <option value="published">published</option>
                </select>
                @error('status')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>

            {{--                <div class="form-check">--}}
            {{--                    <input type="checkbox" class="form-check-input" id="exampleCheck1">--}}
            {{--                    <label class="form-check-label" for="exampleCheck1">Check me out</label>--}}
            {{--                </div>--}}
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit"  id="btnSubmit" class="btn btn-primary">Next</button>
        </div>
    </form>
    </div>


@endsection

@section('scripts')

    <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'bio' );
    </script>
    <script>
        $("#myform").on('submit',function (){
            $("#btnSubmit").attr("disabled", true);
        });

    </script>
@endsection



