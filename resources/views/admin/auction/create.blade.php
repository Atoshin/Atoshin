@extends('admin.layout.master')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">New Auctions</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" id="myform" action="{{route('auctions.store', $artist_id)}}">

            @csrf
            <div class="card-body">
                <div class="form-group">
                    <div></div>
                    <label for="exampleInputEmail1">Auction Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="auction_name" placeholder="Auction Name" value="{{old('auction_name')}}">
                    @error('auction_name')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div>
                    <label for="exampleInputEmail1">Asset Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="asset_name" placeholder="Asset Name" value="{{old('asset_name')}}">
                    @error('asset_name')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div>
                    <label for="exampleInputEmail1">Material<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="material" placeholder="Material" value="{{old('material')}}">
                    @error('material')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div>
                    <label for="exampleInputEmail1">Size<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="size" placeholder="Size" value="{{old('size')}}">
                    @error('size')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>

                <div>
                    <label for="exampleInputEmail1">Creation Date<span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="creation_date" placeholder="Creation Date" value="{{old('creation_date')}}">
                    @error('creation_date')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div>
                    <label for="exampleInputEmail1">Auction Date<span class="text-danger">*</span></label>
                    <input type="date" class="form-control" name="auction_date" placeholder="Auction Date" value="{{old('auction_date')}}">
                    @error('auction_date')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>

                <div>
                    <label for="exampleInputEmail1">Sold Price<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="sold_price" placeholder="Sold Price" value="{{old('sold_price')}}">
                    @error('sold_price')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>

                <div>
                    <label for="exampleInputEmail1">Estimated Price<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="estimated_price" placeholder="Estimated Price" value="{{old('estimated_price')}}">
                    @error('estimated_price')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div>
                    <label for="exampleInputEmail1">Hammer Price<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="hammer_price" placeholder="Hammer Price" value="{{old('hammer_price')}}">
                    @error('hammer_price')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>

            </div>
        {{--                <div class="form-check">--}}
        {{--                    <input type="checkbox" class="form-check-input" id="exampleCheck1">--}}
        {{--                    <label class="form-check-label" for="exampleCheck1">Check me out</label>--}}
        {{--                </div>--}}
        {{--    </div>--}}
        <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" id="btnSubmit" class="btn btn-primary">Submit</button>
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
