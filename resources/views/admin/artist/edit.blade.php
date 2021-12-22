@extends('admin.layout.master')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Info</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post"  id="myform"  action="{{route('artists.update',$artist->id)}}">
            @method('patch')
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Full name</label>
                    <input type="text" class="form-control" name="full_name" value="{{$artist->full_name}}" placeholder="Full name">
                    @error('full_name')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Bio</label>
                    <textarea type="text" class="form-control" name="bio" value="{{$artist->bio}}" placeholder="Bio">{{$artist->bio}}</textarea>

                    @error('bio')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Summary</label>
                    <textarea type="text" class="form-control" name="summary" value="{{$artist->summary}}" placeholder="Summary">{{$artist->summary}}</textarea>

                    @error('summary')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Website</label>
                    <input type="text" class="form-control" name="website" value="{{$artist->website}}" placeholder="Website">
                    @error('website')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Youtube</label>
                    <input type="text" class="form-control" name="youtube" value="{{$artist->youtube}}" placeholder="Youtube">
                    @error('youtube')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Instagram</label>
                    <input type="text" class="form-control" name="instagram" value="{{$artist->instagram}}" placeholder="Instagram">
                    @error('instagram')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Twitter</label>
                    <input type="text" class="form-control" name="twitter" value="{{$artist->twitter}}" placeholder="Twitter">
                    @error('twitter')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Facebook</label>
                    <input type="text" class="form-control" name="facebook" value="{{$artist->facebook}}" placeholder="Facebook">
                    @error('facebook')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Linkedin</label>
                    <input type="text" class="form-control" name="linkedin" value="{{$artist->linkedin}}" placeholder="Linkedin">
                    @error('linkedin')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Order(0-9)</label>
                    <input type="text" class="form-control" name="order" value="{{$artist->order}}" placeholder="order">
                    @error('order')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>

                <a  class="btn btn-primary" href="{{route('upload.page.main.edit',['type'=>\App\Models\Artist::class,'id'=>$artist->id])}}">edit artist avatar</a>
                <a  class="btn btn-primary" href="{{route('upload.page.edit',['type'=>\App\Models\Artist::class,'id'=>$artist->id])}}">edit artist photos</a>
                <div style="margin-top: 15px">
                    <input type="checkbox"
                           @if($artist->homepage==true) checked
                           @endif
                           name="homepage" id="is_default">
                    <label for="exampleInputEmail1">Show this artist in Home page</label>
                </div>
            </div>

            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" id="btnSubmit" class="btn btn-primary">Submit</button>
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
