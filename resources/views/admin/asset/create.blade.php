@extends('admin.layout.master')
@section('content')


    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">New Asset</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form  method="post"  id="myform"  action="{{route('assets.store')}}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="title" placeholder="Title" value="{{old('title')}}">
                    @error('title')
                        <small class="text-danger">
                            {{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Total Price(Dollar) <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="price" placeholder="Total Price(Dollar)" value="{{old('price')}}">
                    @error('price')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Bio <span class="text-danger">*</span></label>
                    <textarea type="text" class="form-control" name="bio" placeholder="Bio">{{old('bio')}}</textarea>
                    @error('bio')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Ownership Percentage <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="ownership_percentage" placeholder="Ownership Percentage" value="{{old('ownership_percentage')}}">
                    @error('ownership_percentage')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
{{--                <div class="form-group">--}}
{{--                    <label for="exampleInputPassword1">Commission Percentage <span class="text-danger">*</span></label>--}}
{{--                    <input type="text" class="form-control" name="commission_percentage" placeholder="Commission Percentage" value="{{old('commission_percentage')}}">--}}
{{--                    @error('commission_percentage')--}}
{{--                    <small class="text-danger">{{$message}}</small>--}}
{{--                    @enderror--}}
{{--                </div>--}}
                <div class="form-group">
                    <label for="exampleInputPassword1">Royalties Percentage <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="royalties_percentage" placeholder="Royalties Percentage" value="{{old('royalties_percentage')}}">
                    @error('royalties_percentage')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Total Fractions <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="total_fractions" placeholder="Total Fractions" value="{{old('total_fractions')}}">
                    @error('total_fractions')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Sold Fractions <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="sold_fractions" placeholder="Sold Fractions" value="{{old('sold_fractions')}}">
                    @error('sold_fractions')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Start Date</label>
                    <input type="date" class="form-control" name="start_date" placeholder="Start Date" value="{{old('start_date')}}">
                    @error('start_date')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">End Date</label>
                    <input type="date" class="form-control" name="end_date" placeholder="End Date" value="{{old('end_date')}}">
                    @error('end_date')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>

{{--                <div class="form-group">--}}
{{--                    <label for="exampleInputPassword1">Status</label>--}}
{{--                    <select name="status" class="form-control" id="">--}}
{{--                        <option value="unpublished">unpublished</option>--}}
{{--                        <option value="published">published</option>--}}

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
                            <option @if(old('category_id')==$category->id)
                                selected
                                    @endif
                                    value="{{$category->id}}" >{{$category->title}}</option>
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
                            <option @if(old('creator_id')==$gallery->id)
                                    selected
                                    @endif
                                    value="{{$gallery->id}}" >{{$gallery->name}}</option>
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
                            <option @if(old('artist_id')==$artist->id)
                                    selected
                                    @endif
                                value="{{$artist->id}}" >{{$artist->full_name}}</option>
                        @endforeach
                    </select>
                    @error('artist_id')
                    <small class="text-danger">{{$message}}</small>
                    @enderror

                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Material</label>
                    <input type="text" class="form-control" name="material" placeholder="Material" value="{{old('material')}}">
                    @error('material')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Size</label>
                    <input type="text" class="form-control" name="size" placeholder="Size" value="{{old('size')}}">
                    @error('size')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Date of Creation</label>
                    <input type="text" class="form-control" name="creation" placeholder="Date of creation" value="{{old('creation')}}">
                    @error('creation')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">

                    <label for="exampleInputEmail1">Order(0-4)</label>
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
