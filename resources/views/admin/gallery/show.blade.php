@extends('admin.layout.master')
@section('styles')
    <style>
        .avatar {
            border-radius: 50%;
        }
    </style>
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2" style="align-items: center;">
                <div class="col-1">
                    <img src="{{asset($gallery->medias->first()->path)}}" class="avatar" alt="" width="100"
                         height="100"/>
                </div>
                {{--            <div class="row mb-2" >--}}
                <div class="col-sm-6">
                    <h1>{{$gallery->name}}</h1>
                </div>

                {{--            </div>--}}
            </div><!-- /.container-fluid -->
        </div>
    </section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="callout callout-info ckeditor-text">
                    <h5><i></i>Bio:</h5>
                    {!!$gallery->bio!!}
                </div>
                <div class="callout callout-info ckeditor-text">
                    <h5><i></i>Summary:</h5>
                    {!!$gallery->summary!!}
                </div>
                <div class="invoice p-3 mb-3">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-12">
                            <h4>
                                <i></i>
                                <small class="float-right"></small>
                            </h4>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            <address>
                                <div class="mb-1"><b>Wallet Address:</b> {{$gallery->wallet->wallet_address}}<br>
                                </div>
                            </address>
                        </div>


                        <div class="col-sm-4 invoice-col">

                            <address>
                                {{--                                <div class="mb-1"> <b>Wallet Address:</b>  {{$gallery->wallet->wallet_address}}<br></div>--}}

                            </address>
                        </div>
                        <!-- /.col -->

                    </div>

                    <div class="row invoice-info">
                        <div class="col-sm-6 invoice-col">
                            {{--      <div class="mb-1"><b>Bio:</b> {{$asset->bio}}</div>--}}
                            <address>
                                <div class="mb-1"><b>Website:</b>
                                    @if($gallery->website)
                                        <a href="{{$gallery->website}}">{{substr($gallery->website,0,25) . '...'}}</a>
                                </div>
                                @else
                                    <span>-</span>
                                @endif

                                {{--                795 Folsom Ave, Suite 600<br>--}}
                                <div class="mb-1"><b> Instagram:</b>
                                    @if($gallery->instagram)
                                        <a href="{{$gallery->instagram}}">{{substr($gallery->instagram,0,25) . '...'}}</a>
                                </div>
                                @else
                                    <span>-</span>
                                @endif
                                <div class="mb-1"><b>Youtube:</b>
                                    @if($gallery->youtube)

                                        <a
                                            href="{{$gallery->youtube}}">{{substr($gallery->youtube,0,25) . '...'}}</a>
                                </div>
                                @else
                                    <span>-</span>
                                @endif

                                {{--                Email: info@almasaeedstudio.com--}}
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6 invoice-col">

                            <address>
                                <div class="mb-1"><b>Facebook:</b>

                                    @if($gallery->facebook)
                                        <a
                                            href="{{$gallery->facebook}}">{{substr($gallery->facebook,0,25) . '...'}}</a>
                                </div>
                                @else
                                    <span>-</span>
                                @endif
                                <div class="mb-1"><b>Linkedin:</b>
                                    @if($gallery->linkedin)
                                        <a
                                            href="{{$gallery->linkedin}}">{{substr($gallery->linkedin,0,25) . '...'}}</a>
                                </div>
                                @else
                                    <span>-</span>
                                @endif
                                <div class="mb-1"><b> Twitter:</b>

                                    @if($gallery->twitter)
                                        <a
                                            href="{{$gallery->twitter}}">{{substr($gallery->twitter,0,25) . '...'}}</a>
                                </div>
                                @else
                                    <span>-</span>
                                @endif
                                {{--                                <div class="mb-1"> <b> Royalties Percentage:</b>  {{$asset->royalties_percentage}} <br></div>--}}
                                {{--                                <div class="mb-1">  <b> Start Date:</b> {{$asset->start_date}}<br></div>--}}
                                {{--                                <div class="mb-1">  <b> End Date:</b> {{$asset->end_date}}<br></div>--}}
                                {{--                Email: john.doe@example.com--}}
                            </address>
                        </div>
                        <!-- /.col -->
                    {{--                        <div class="col-sm-4 invoice-col">--}}
                    {{--                            <div class="mb-1"> <b>creator:</b> {{$asset->gallery->name}}<br></div>--}}
                    {{--                            <div class="mb-1"> <b>category:</b> {{$asset->category->title}}<br></div>--}}
                    {{--                            <b>Artist:</b> {{$asset->artist->full_name}}<br>--}}
                    {{--                            --}}{{--            <b>Account:</b> 968-34567--}}
                    {{--                        </div>--}}
                    <!-- /.col -->
                    </div>


                    <div class="row m-4 pb-3" style="border-top:2px solid whitesmoke; border-bottom: 2px solid whitesmoke">

                        @foreach($gallery->medias as $media)
                            @if($loop->index>0)
                                <img style="margin-top: 20px; margin-right: 20px" src="{{asset($media->path)}}"
                                     alt=""
                                     width="100" height="100"/>
                            @endif
                        @endforeach
                    </div>
{{--                    <div>--}}
{{--                        <h5>Location:</h5>--}}
{{--                    </div>--}}

                    <div class="col-sm-6 map" id="map" style="height: 500px; margin-bottom: 20px;">
                    </div>
                    @endsection
                    @section('scripts')
                        <script>
                            $(document).ready(function () {
                                var map = L.map('map', {
                                    center: [{{$gallery->location ? $gallery->location->lat : 35.6892}}, {{$gallery->location ? $gallery->location->long : 51.3890}}],
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
                                const mainMarker = L.marker([{{$gallery->location ? $gallery->location->lat : 35.6892}}, {{$gallery->location ? $gallery->location->long : 51.3890}}], {draggable: false}).addTo(map);
                            })
                        </script>

@endsection
