@extends('admin.layout.master')
@section('content')
    {{--<div class="card ">--}}

    {{--    <h3 class="card-title">Location</h3>--}}

    {{--</div>--}}

    <div class="card-header">
        <div class="card-header">
{{--            <a href="" type="button" class="btn btn-success mr-2 float-right"> <i--}}
{{--                    class="fa fa-plus mr-2 "></i> Add Address </a>--}}
            {{--                        <h3 class="card-title">{{$gallery->}}</h3>--}}
            <a href="{{route('galleries.index')}}" type="button"
               class="btn btn-primary mr-2 float-right"> <i
                    class="fa fa-palette mr-2 "></i> Gallery Table</a>
            <h3 class="card-title card-blue">Location for {{$gallery->name}}</h3>

        </div>

        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{route('locations.store', $gallery_id)}}" method="POST" id="myform">
                @csrf
                <div class="row">
                        <div class="col-sm-12 map" id="map" style="height: 500px; margin-bottom: 20px;">
                        </div>
                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Lat <span class="text-danger">*</span></label>
                            <input type="text" id="lat" class="form-control" value="{{$location ? $location->lat : ''}}"
                                   name="lat" placeholder="Lat">
                            @error('lat')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Long <span class="text-danger">*</span></label>
                            <input type="text" id="long" class="form-control" name="long"
                                   value="{{$location ? $location->long : ''}}"
                                   placeholder="Long">
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
                                      placeholder="Address">{{$location ? $location->address : ''}}</textarea>
                            @error('address')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                            <label>Telephone <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" rows="3" name="telephone"
                                   value="{{$location ? $location->telephone : ''}}"
                                      placeholder="Telephone">
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
                <div class="card-footer">
                    <button type="submit" id="btnSubmit" class="btn btn-primary">Submit</button>
                </div>


            </form>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        $(document).ready(function () {
            var map = L.map('map', {
                center: [{{$location ? $location->lat : 35.6892}}, {{$location ? $location->long : 51.3890}}],
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
            const mainMarker = L.marker([{{$location ? $location->lat : 35.6892
}}, {{$location ? $location->long : 51.3890}}], {draggable: true}).addTo(map);
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
