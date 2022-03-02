@extends('admin.layout.master')
@section('content')

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">New Gallery</h3>
        </div>
        <form method="post" id="myform" action="{{route('galleries.store')}}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" placeholder="Name" value="{{old('name')}}">
                    @error('name')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Bio <span class="text-danger">*</span></label>
                    <textarea type="text" class="form-control" name="bio" placeholder="Bio">{{old('bio')}}</textarea>
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
                    <label for="exampleInputPassword1">Wallet Address <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="wallet_address" placeholder="Wallet Address"
                           value="{{old('wallet_address')}}">
                    @error('wallet_address')
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

                    <label for="exampleInputEmail1">Order(0-9)</label>
                    <input type="text" class="form-control" name="order" placeholder="Order" value="{{old('order')}}">
                    @error('order')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <hr>
                <h3>Location:</h3>
                <div class="row">
                    <div class="col-sm-12 map" id="map" style="height: 500px; margin-bottom: 20px;">
                    </div>
                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Lat <span class="text-danger">*</span></label>
                            <input type="text" id="lat" class="form-control"
                                   name="lat" placeholder="Lat" value="{{old('lat')}}">
                            @error('lat')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Long <span class="text-danger">*</span></label>
                            <input type="text" id="long" class="form-control" name="long"
                                   placeholder="Long" value="{{old('long')}}">
                            @error('long')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <!-- textarea -->
                        <div class="form-group">
                            <label>Address <span class="text-danger">*</span></label>

                            <textarea class="form-control" rows="3" name="address"
                                      placeholder="Address" >{{old('address')}}</textarea>
                            @error('address')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Telephone <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" rows="3" name="telephone"
                                   placeholder="Telephone" value="{{old('telephone')}}">
                        </div>
                        @error('telephone')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>


                    {{--                <div class="col-sm-6">--}}
                    {{--                    <div class="form-group">--}}
                    {{--                        <label>Textarea Disabled</label>--}}
                    {{--                        <textarea class="form-control" rows="3" placeholder="Enter ..." disabled></textarea>--}}
                    {{--                    </div>--}}
                    {{--                </div>--}}
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


    <script>
        $(document).ready(function () {
            var map = L.map('map', {
                center: [{{35.6892}}, {{51.3890}}],
                zoom: 13
            });
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                _sizeChanged: true,
                tileSize: 512,
                zoomOffset: -1,
                maxZoom: 18,
                _zoomAnimated: true,
            }).addTo(map);
            setTimeout(function () {
                map.invalidateSize()
            }, 400);
            const mainMarker = L.marker([{{35.6892
}}, {{51.3890}}], {draggable: true}).addTo(map);
            let secondaryMarker;
            map.on('click', function (e) {
                var popLocation = e.latlng;
                $("#lat").val(popLocation.lat);
                $("#long").val(popLocation.lng);
                if (secondaryMarker) {
                    map.removeLayer(secondaryMarker)
                }
                secondaryMarker = L.marker([popLocation.lat, popLocation.lng]);
                map.removeLayer(mainMarker);
                secondaryMarker.addTo(map)

                var popup = L.popup()
                    .setLatLng(popLocation)
                    .setContent(`<p>Lat: ${popLocation.lat}<br />Long: ${popLocation.lng}</p>`)
                    .openOn(map);
            });
        })
    </script>
    <script>
        $("#myform").on('submit',function (){
            $("#btnSubmit").attr("disabled", true);
        });

    </script>
@endsection
