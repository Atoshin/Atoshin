@extends('admin.layout.master')
@section('styles')

@endsection
@section('content')
    {{--/////--}}
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">New Artist</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" id="myform" action="{{route('artists.store')}}">
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Full name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="full_name" placeholder="Full name"
                           value="{{old('full_name')}}">
                    @error('full_name')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Bio <span class="text-danger">*</span></label>
                    <textarea type="text" class="form-control editor" name="bio" placeholder="Bio"
                              id="editor">{{old('bio')}}</textarea>
                    @error('bio')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Summary <span class="text-danger">*</span></label>
                    <textarea type="text" class="form-control" name="summary"
                              placeholder="Summary">{{old('summary')}}</textarea>

                    @error('summary')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Website</label>
                    <input type="text" class="form-control" name="website" placeholder="Website"
                           value="{{old('website')}}">
                    @error('website')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Youtube</label>
                    <input type="text" class="form-control" name="youtube" placeholder="Youtube"
                           value="{{old('youtube')}}">
                    @error('youtube')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Instagram</label>
                    <input type="text" class="form-control" name="instagram" placeholder="Instagram"
                           value="{{old('instagram')}}">
                    @error('instagram')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Twitter</label>
                    <input type="text" class="form-control" name="twitter" placeholder="Twitter"
                           value="{{old('twitter')}}">
                    @error('twitter')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Facebook</label>
                    <input type="text" class="form-control" name="facebook" placeholder="Facebook"
                           value="{{old('facebook')}}">
                    @error('facebook')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Linkedin</label>
                    <input type="text" class="form-control" name="linkedin" placeholder="Linkedin"
                           value="{{old('linkedin')}}">
                    @error('linkedin')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">World Ranking</label>
                    <input type="text" class="form-control" name="world_ranking" placeholder="World Ranking"
                           value="{{old('world_ranking')}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Iran Ranking</label>
                    <input type="text" class="form-control" name="iran_ranking" placeholder="Iran Ranking"
                           value="{{old('iran_ranking')}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Ranking Link</label>
                    <input type="text" class="form-control" name="ranking_link" placeholder="Ranking Link"
                           value="{{old('ranking_link')}}">
                </div>
                <div class="form-group">

                    <label for="exampleInputEmail1">Order(0-9)</label>
                    <input type="text" class="form-control" name="order" placeholder="Order" value="{{old('order')}}">
                    @error('order')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>


            </div>

            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" id="btnSubmit" class="btn btn-primary">Next</button>
            </div>
        </form>
    </div>


@endsection

@section('scripts')

    <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('bio');
    </script>
    <script>
        $("#myform").on('submit', function () {
            $("#btnSubmit").attr("disabled", true);
        });

    </script>
@endsection
