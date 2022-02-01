@extends('admin.layout.master')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Auctions</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form  method="post" id="myform"   action="{{route('auctions.update', $auctions->id)}}">
            @method('patch')
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <div></div>
                    <label for="exampleInputEmail1">Auction Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="auction_name" placeholder="Auction Name" value="{{$auctions->auction_name}}">

                    @error('auction_name')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div>
                    <label for="exampleInputEmail1">Asset Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="asset_name" placeholder="Asset Name" value="{{$auctions->asset_name}}">
                    @error('asset_name')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div>
                    <label for="exampleInputEmail1">Material</label>
                    <input type="text" class="form-control" name="material" placeholder="Material" value="{{$auctions->material}}">
                    @error('material')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div>
                    <label for="exampleInputEmail1">Size</label>
                    <input type="text" class="form-control" name="size" placeholder="Size" value="{{$auctions->size}}">
                    @error('size')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>

                <div>
                    <label for="exampleInputEmail1">Creation Date</label>
                    <input type="text" class="form-control" name="creation_date" placeholder="Creation Date" value="{{$auctions->creation_date}}">
                    @error('creation_date')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div>
                    <label for="exampleInputEmail1">Auction Date</label>
                    <input type="text" class="form-control" name="auction_date" placeholder="Auction Date" value="{{$auctions->auction_date}}">
                    @error('auction_date')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>

                <div>
                    <label for="exampleInputEmail1">Sold Price</label>
                    <input type="text" class="form-control" name="sold_price" placeholder="Sold Price" value="{{$auctions->sold_price}}">
                    @error('sold_price')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
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
    <script>
        $("#myform").on('submit',function (){
            $("#btnSubmit").attr("disabled", true);
        });

    </script>
@endsection
