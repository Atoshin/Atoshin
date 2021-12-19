@extends('admin.layout.master')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Info</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post"  id="myform"  action="{{route('galleries.update',$gallery->id)}}">
            @method('patch')
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" name="name" value="{{$gallery->name}}" placeholder="Name">
                    @error('name')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Bio</label>
                    <textarea type="text" class="form-control" name="bio" value="{{$gallery->bio}}" placeholder="Bio">{{$gallery->bio}}</textarea>
                    @error('bio')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Summary</label>
                    <textarea type="text" class="form-control" name="summary" value="{{$gallery->summary}}" placeholder="Bio">{{$gallery->summary}}</textarea>
                    @error('summary')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="exampleInputPassword1">Wallet Address</label>
                    <input type="text" class="form-control" name="wallet_address" value="{{$gallery->wallet ? $gallery->wallet->wallet_address : ''}}" placeholder="Wallet Address">
                    @error('wallet_address')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Website</label>
                    <input type="text" class="form-control" name="website" value="{{$gallery->website}}" placeholder="Website">
                    @error('website')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Youtube</label>
                    <input type="text" class="form-control" name="youtube" value="{{$gallery->youtube}}" placeholder="Youtube">
                    @error('youtube')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Instagram</label>
                    <input type="text" class="form-control" name="instagram" value="{{$gallery->instagram}}" placeholder="Instagram">
                    @error('instagram')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Twitter</label>
                    <input type="text" class="form-control" name="twitter" value="{{$gallery->twitter}}" placeholder="Twitter">
                    @error('twitter')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Facebook</label>
                    <input type="text" class="form-control" name="facebook" value="{{$gallery->facebook}}" placeholder="Facebook">
                    @error('facebook')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Linkedin</label>
                    <input type="text" class="form-control" name="linkedin" value="{{$gallery->linkedin}}" placeholder="Linkedin">
                    @error('linkedin')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Status</label>
                    <select name="status" class="form-control" id="">
                        <option @if($gallery->status=='published') selected @endif value="published">published</option>
                        <option @if($gallery->status=='unpublished') selected @endif value="unpublished">unpublished</option>
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
                <button type="submit" id="btnSubmit" class="btn btn-primary">Next</button>
                <button type="submit" class="btn btn-primary">Next</button>

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
