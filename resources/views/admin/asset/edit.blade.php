@extends('admin.layout.master')
@section('content')


    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Asset</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form  method="post"  id="myform"  action="{{route('assets.update',$asset->id)}}">
            @csrf
            @method("PATCH")
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Title <span class="text-danger">*</span></label>
                    <input type="text" {{$isMinted ? 'disabled' : ''}} class="form-control" name="title" placeholder="Title" value="{{$asset->title}}">
                    @error('title')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Total Price(Dollar) <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" {{$isMinted ? 'disabled' : ''}} name="price" placeholder="Total Price(Dollar)" value="{{$asset->price}}" >
                    @error('price')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Bio <span class="text-danger">*</span></label>
                    <textarea type="text" class="form-control" {{$isMinted ? 'disabled' : ''}} name="bio" placeholder="Bio" >{{$asset->bio}}</textarea>
                    @error('bio')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Ownership Percentage <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" {{$isMinted ? 'disabled' : ''}} name="ownership_percentage" placeholder="Ownership Percentage" value="{{$asset->ownership_percentage}}">
                    @error('ownership_percentage')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
{{--                <div class="form-group">--}}
{{--                    <label for="exampleInputPassword1">Commission Percentage <span class="text-danger">*</span></label>--}}
{{--                    <input type="text" class="form-control" {{$isMinted ? 'disabled' : ''}} name="commission_percentage" placeholder="Commission Percentage" value="{{$asset->commission_percentage}}" >--}}
{{--                    @error('commission_percentage')--}}
{{--                    <small class="text-danger">{{$message}}</small>--}}
{{--                    @enderror--}}
{{--                </div>--}}
                <div class="form-group">
                    <label for="exampleInputPassword1">Royalties Percentage <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" {{$isMinted ? 'disabled' : ''}} name="royalties_percentage" placeholder="Royalties Percentage" value="{{$asset->royalties_percentage}}">
                    @error('royalties_percentage')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Total Fractions <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" {{$isMinted ? 'disabled' : ''}} name="total_fractions" placeholder="Total Fractions" value="{{$asset->total_fractions}}">
                    @error('total_fractions')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Sold Fractions <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" {{$isMinted ? 'disabled' : ''}} name="sold_fractions" placeholder="Sold Fractions" value="{{$asset->sold_fractions}}">
                    @error('sold_fractions')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Start Date</label>
                    <input type="date" class="form-control" name="start_date" placeholder="Start Date" value="{{$asset->start_date ? $asset->start_date->format('Y-m-d'): ' '}}">
                    @error('start_date')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">End Date</label>
                    <input type="date" class="form-control" name="end_date" placeholder="End Date" value="{{$asset->end_date ? $asset->end_date->format('Y-m-d'): ''}}">
                    @error('end_date')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>

{{--                <div class="form-group">--}}
                {{--                    <label for="exampleInputPassword1">Status</label>--}}
                {{--                    <select name="status" class="form-control" id="">--}}
                {{--                        <option @if($asset->status=='unpublished') selected @endif value="unpublished">unpublished</option>--}}
                {{--                        <option @if($asset->status=='published') selected @endif value="published">published</option>--}}

                {{--                    </select>--}}
                {{--                    @error('status')--}}
                {{--                    <small class="text-danger">{{$message}}</small>--}}
                {{--                    @enderror--}}
                {{--                </div>--}}

                <div class="form-group">
                    <label for="exampleInputPassword1">Category <span class="text-danger">*</span></label>
                    <select name="category_id" class="form-control" id="">
                        <option value="" selected disabled>select</option>
                        @foreach($categories as $category)
                            <option @if($asset->category_id== $category->id) selected @endif value="{{$category->id}}" >{{$category->title}}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Gallery <span class="text-danger">*</span></label>
                    <select name="creator_id" class="form-control" id="">
                        <option value="" selected disabled>select</option>
                        @foreach($galleries as $gallery)
                            <option @if($asset->creator_id==$gallery->id) selected @endif value="{{$gallery->id}}" >{{$gallery->name}}</option>
                        @endforeach
                    </select>
                    @error('creator_id')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Artist <span class="text-danger">*</span></label>
                    <select name="artist_id" class="form-control" id="">
                        <option value="" selected disabled>select</option>
                        @foreach($artists as $artist)
                            <option @if($asset->artist_id == $artist->id) selected @endif value="{{$artist->id}}" >{{$artist->full_name}}</option>
                        @endforeach
                    </select>
                    @error('artist_id')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Material</label>
                    <input type="text" class="form-control" name="material" value="{{$asset->material}}" placeholder="Material">
                    @error('material')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div> <div class="form-group">
                    <label for="exampleInputPassword1">Size</label>
                    <input type="text" class="form-control" name="size" value="{{$asset->size}}" placeholder="Size">
                    @error('size')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Date of Creation</label>
                    <input type="text" class="form-control" name="creation" value="{{$asset->creation}}" placeholder="Date of Creation">
                    @error('creation')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Order(0-4)</label>
                    <input type="text" class="form-control" name="order" value="{{$asset->order}}" placeholder="order">
                    @error('order')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>


{{--                <a  class="btn btn-primary" href="{{route('videoLink.index',['type'=>\App\Models\Asset::class,'id'=>$asset->id])}}">edit asset videos</a>--}}

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit"  id="btnSubmit" class="btn btn-primary">Submit</button>
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
