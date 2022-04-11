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
                    <label for="exampleInputEmail1">Full name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="full_name" value="{{$artist->full_name}}" placeholder="Full name">
                    @error('full_name')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Bio <span class="text-danger">*</span></label>
                    <textarea type="text" class="form-control" name="bio" value="{{$artist->bio}}" placeholder="Bio">{{$artist->bio}}</textarea>

                    @error('bio')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Summary <span class="text-danger">*</span></label>
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
                    <label for="exampleInputPassword1">World Ranking</label>
                    <input type="text" class="form-control" name="world_ranking" value="{{$artist->world_ranking}}" placeholder="World Ranking">

                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Iran Ranking</label>
                    <input type="text" class="form-control" name="iran_ranking" value="{{$artist->iran_ranking}}" placeholder="Iran Ranking">

                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Ranking Link</label>
                    <input type="text" class="form-control" name="ranking_link" value="{{$artist->ranking_link}}" placeholder="Ranking Link">
                    @error('ranking_link')
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


{{--                <a  class="btn btn-primary" href="{{route('videoLink.index',['type'=>\App\Models\Artist::class,'id'=>$artist->id])}}">edit artist videos</a>--}}
{{--                <div style="margin-top: 15px">--}}
{{--                    <input type="checkbox"--}}
{{--                           @if($artist->homepage==true) checked--}}
{{--                           @endif--}}
{{--                           name="homepage" id="is_default">--}}
{{--                    <label for="exampleInputEmail1">Show this artist in Home page</label>--}}
{{--                </div>--}}
{{--            </div>--}}

            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" id="btnSubmit" class="btn btn-primary">Submit</button>
            </div>
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


    @if(\Illuminate\Support\Facades\Session::has('success'))
        @if(\Illuminate\Support\Facades\Session::get('success') == 'true')
            <script type="text/javascript">
                const buttons = `<a class="btn btn-outline-info float-left" href="{{route('artists.index')}}">
                    <span class="row">
                        <i class="material-icons">arrow_back</i>
                        Back to Artists
                    </span>

                </a>

                <a href="{{route('upload.page',['type'=>\App\Models\Artist::class,'id'=>$artist->id,'edit'=>1])}}" id="continue" class="btn btn-outline-info float-right">
                    <span class="row">
                            Go to Media section
                            <i class="material-icons">arrow_forward</i>
                    </span>

                </a>`
                Swal.fire({
                    target: 'body',
                    icon: '{{\Illuminate\Support\Facades\Session::has('icon') ? \Illuminate\Support\Facades\Session::get('icon') : 'success'}}',
                    title: '{{\Illuminate\Support\Facades\Session::get('title')}}',
                    showCancelButton: false,
                    showConfirmButton: false,
                    timer: 100000,
                    html: buttons


                })
            </script>
        @endif
    @endif

@endsection
