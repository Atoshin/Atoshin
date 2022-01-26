@extends('admin.layout.master')
@section('styles')
    <style>
        .avatar {
            border-radius: 50%;
        }
        .vid-container{
            display: flex;
            flex-direction: column;
            margin-bottom: 10px
        ;
        }
        .large-picture-container{
            display: flex;
            flex-direction: column;

        }


    </style>
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2" style="align-items: center;">
                @if($gallery->medias->where('mediable_type',\App\Models\Gallery::class)->where('mediable_id',$gallery->id)->where('main',true)->first())
                    <div class="col-1">

                        <img
                            src="{{asset($gallery->medias->where('mediable_type',\App\Models\Gallery::class)->where('mediable_id',$gallery->id)->where('main',true)->first()->path)}}"
                            class="avatar" alt="" width="100"
                            height="100"/>

                    </div>
                @endif
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
                                <div class="mb-1">
                                    <b>Wallet Address:</b>
                                    @if($gallery->wallet)
                                        {{$gallery->wallet->wallet_address}}<br>
                                    @else
                                        -
                                    @endif
                                </div>
                            </address>
                        </div>


                        <div class="col-sm-4 invoice-col">

                            <address>

                            </address>
                        </div>


                    </div>

                    <div class="row invoice-info">
                        <div class="col-sm-6 invoice-col">
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
                                <div class="mb-1"><b> Status:</b> {{$gallery->status}}<br></div>
                            </address>


                        </div>
                    </div>

                    <div class="row m-4 pb-3" style="border-top:2px solid whitesmoke">
                        <div>
                            <div>
                                <b>Assets</b>
                            </div>
                            <div>
                                @if(count($gallery->assets)>0)
                                    @foreach($gallery->assets as $asset)
                                        <ul>

                                            <img src="{{asset($asset->medias->where('main',true)->first()->path)}}"
                                                 alt="" width="100"
                                                 height="100">
                                            {{--                                                {{'http://127.0.0.1:8000/'.$media->path}}--}}
                                            <li>
                                                <b>Title:</b>
                                                <a href="{{route('assets.show',$asset->id)}}">
                                                    {{$asset->title}}
                                                </a>
                                            </li>
                                            <li><b>Artist:</b>
                                                <a href="{{route('artists.show',$asset->artist->id)}}">{{$asset->artist->full_name}}</a>
                                            </li>
                                        </ul>
                                        @if(!$loop->last)
                                            <hr>
                                        @endif
                                    @endforeach
                                @else
                                    <ul style="list-style-type: none">
                                        <li>
                                            No Asset
                                        </li>
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row m-4"
                         style="border-top:2px solid whitesmoke;">
                        <div>
                            <div>
                                <b>Pictures</b>
                            </div>

                            <div>
                                @if(count($gallery->medias)>=1)
                                    <div class="row">
                                        @foreach($gallery->medias as $media)
                                            @if($media ->main==false && $media->gallery_large_picture==false)
                                                <a target="_blank" href="{{'http://127.0.0.1:8000/'.$media->path}}">
                                                    <img src="{{asset($media->path)}}" class="mx-2 mb-2"
                                                         alt="white sample" width="100" height="100"/>
                                                </a>
                                            @elseif($media->gallery_large_picture==true)
                                                <div class="large-picture-container">

                                                <a target="_blank" href="{{'http://127.0.0.1:8000/'.$media->path}}">
                                                    <img src="{{asset($media->path)}}" class="mx-2"
                                                         alt="white sample" width="100" height="100"/>
                                                </a>
                                                <p class="mx-2" >Large Picture</p>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>

                                @else
                                    <ul style="list-style-type: none">
                                        <li>
                                            No Picture

                                        </li>
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row m-4 pb-3"
                         style="border-top:2px solid whitesmoke; border-bottom: 2px solid whitesmoke">

                        <div>
                            <div>
                                <b>Videos</b>
                            </div>
                            <div>

                                @if(count($gallery->videoLinks)>0)
                                    @foreach($gallery->videoLinks as $videoLink)
                                        <div class="vid-container">
                                            @if($videoLink->is_default)

                                                <a target="_blank"
                                                   href="{{'http://127.0.0.1:8000/'.$videoLink->media->path}}">
                                                    Homepage's Video</a>
                                            @endif
                                            {!! ($videoLink->link) !!}
                                        </div>
                                        @endforeach
                                @else
                                    <ul style="list-style-type: none">
                                        <li>
                                            No Video

                                        </li>
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div style="display: flex; flex-direction: row">
                        <div class="col-sm-6 map" id="map"
                             style="height: 500px; margin-bottom: 20px; margin-left: 20px">
                        </div>
                        <div style="margin-left: 50px">
                            <div class="col-sm-4 invoice-col">
                                <address>
                                    <div class="mb-1">
                                        <b>Address:</b> {{$gallery->location ? $gallery->location->address:'-'}}<br><br><br><br><br><br>
                                        <div class="mb-1">
                                            <b>Telephone:</b> {{$gallery->location ? $gallery->location->telephone:'-'}}
                                            <br>
                                        </div>
                                    </div>
                                </address>

                            </div>
                        </div>

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
                </div>
@endsection
