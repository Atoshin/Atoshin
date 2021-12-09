@extends('admin.layout.master')
@section('content')

    {{--    <div class="card card-info">--}}
    {{--        <div class="card-header">--}}
    {{--            <h3 class="card-title">New User</h3>--}}
    {{--        </div>--}}
    {{--        <!-- /.card-header -->--}}
    {{--        <!-- form start -->--}}
    {{--        <form class="form-horizontal"   method="post"    action="{{route('admin.store')}}">--}}
    {{--            @csrf--}}
    {{--            <div class="card-body">--}}
    {{--                <div class="form-group row">--}}
    {{--                    <label for="inputEmail3" class="col-sm-2 col-form-label">first_name</label>--}}
    {{--                    <div class="col-sm-10">--}}
    {{--                        <input type="text" class="form-control" name="first_name" placeholder="first_name">--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="form-group row">--}}
    {{--                    <label for="inputPassword3" class="col-sm-2 col-form-label">last_name</label>--}}
    {{--                    <div class="col-sm-10">--}}
    {{--                        <input type="text" class="form-control" name="last_name" placeholder="last_name">--}}
    {{--                    </div>--}}
    {{--                <div class="form-group row">--}}
    {{--                    <label for="inputPassword3" class="col-sm-2 col-form-label">email</label>--}}
    {{--                    <div class="col-sm-10">--}}
    {{--                        <input type="email" class="form-control" name="email" placeholder="email">--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="form-group row">--}}
    {{--                    <label for="inputPassword3" class="col-sm-2 col-form-label">username</label>--}}
    {{--                    <div class="col-sm-10">--}}
    {{--                        <input type="text" class="form-control" name="username" placeholder="username">--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                </div>--}}
    {{--                <div class="form-group row">--}}
    {{--                    <label for="inputPassword3" class="col-sm-2 col-form-label">avatar</label>--}}
    {{--                    <div class="col-sm-10">--}}
    {{--                        <input type="text" class="form-control" name="avatar" placeholder="avatar">--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            <div class="form-group row">--}}
    {{--                <label for="inputPassword3" class="col-sm-2 col-form-label">bio</label>--}}
    {{--                <div class="col-sm-10">--}}
    {{--                    <input type="text" class="form-control" name="bio" placeholder="bio">--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            </div>--}}
    {{--            <!-- /.card-body -->--}}
    {{--            <div class="card-footer">--}}
    {{--                <button type="submit" class="btn btn-info">Submit</button>--}}
    {{--                <button type="submit" class="btn btn-default float-right">Cancel</button>--}}
    {{--            </div>--}}
    {{--            <!-- /.card-footer -->--}}
    {{--        </form>--}}
    {{--    </div>--}}

    {{--/////--}}
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">New Artist</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form  method="post"    action="{{route('assets.update',$asset->id)}}">
            @csrf
            @method("PATCH")
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Title</label>
                    <input type="text" class="form-control" name="title" placeholder="Title" value="{{$asset->title}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Price</label>
                    <input type="text" class="form-control" name="price" placeholder="Price" value="{{$asset->price}}" >
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Bio</label>
                    <textarea type="text" class="form-control" name="bio" placeholder="Bio" value="{{$asset->bio}}"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Ownership Percentage</label>
                    <input type="text" class="form-control" name="ownership_percentage" placeholder="Ownership Percentage" value="{{$asset->ownership_percentage}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Commission Percentage</label>
                    <input type="text" class="form-control" name="commission_percentage" placeholder="Commission Percentage" value="{{$asset->commission_percentage}}" >
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Royalties Percentage</label>
                    <input type="text" class="form-control" name="royalties_percentage" placeholder="Royalties Percentage" value="{{$asset->royalties_percentage}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Total Fractions</label>
                    <input type="text" class="form-control" name="total_fractions" placeholder="Total Fractions" value="{{$asset->total_fractions}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Sold Fractions</label>
                    <input type="text" class="form-control" name="sold_fractions" placeholder="Sold Fractions" value="{{$asset->sold_fractions}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Start Date</label>
                    <input type="date" class="form-control" name="start_date" placeholder="Start Date" value="{{$asset->start_date->format('Y-m-d')}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">End Date</label>
                    <input type="date" class="form-control" name="end_date" placeholder="End Date" value="{{$asset->end_date->format('Y-m-d')}}">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Status</label>
                    <select name="status" class="form-control" id="">
                        <option @if($asset->status=='published') selected @endif value="published">published</option>
                        <option @if($asset->status=='unpublished') selected @endif value="unpublished">unpublished</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Category</label>
                    <select name="category_id" class="form-control" id="">
                        <option value="" selected disabled>select</option>
                        @foreach($categories as $category)
                            <option @if($asset->category_id== $category->id) selected @endif value="{{$category->id}}" >{{$category->title}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Gallery</label>
                    <select name="creator_id" class="form-control" id="">
                        <option value="" selected disabled>select</option>
                        @foreach($galleries as $gallery)
                            <option @if($asset->creator_id==$gallery->id) selected @endif value="{{$gallery->id}}" >{{$gallery->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Artist</label>
                    <select name="artist_id" class="form-control" id="">
                        <option value="" selected disabled>select</option>
                        @foreach($artists as $artist)
                            <option @if($asset->artist_id == $artist->id) selected @endif value="{{$artist->id}}" >{{$artist->full_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="submit" class="btn btn-default float-right">Cancel</button>
            </div>
        </form>
    </div>


@endsection
