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
                    <img src="{{asset($artist->medias->where('mediable_type',\App\Models\Artist::class)->where('mediable_id',$artist->id)->where('main',true)->first()->path)}}" class="avatar" alt="" width="100"
                         height="100"/>
                </div>
                <div class="col-sm-6">
                    <h1>{{$artist->full_name}}</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="callout callout-info">
                    <div class="row">

                        <div class="col-11 ckeditor-text">
                            <h5>Bio:</h5>
                            <p>{!!$artist->bio!!}</p>
                        </div>
                    </div>
                </div>
                <div class="callout callout-info">
                    <div class="row">

                        <div class="col-11">
                            <h5>Summary:</h5>
                            <p>{!!$artist->summary!!}</p>
                        </div>
                    </div>
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
                            {{--      <div class="mb-1"><b>Bio:</b> {{$asset->bio}}</div>--}}
                            <address>
                                <div class="mb-1"><b>Website:</b>
                                    @if($artist->website)
                                        <a href="{{$artist->website}}">{{substr($artist->website,0,25) . '...'}}</a>
                                </div>
                                @else
                                    <span>-</span>
                                @endif

                                {{--                795 Folsom Ave, Suite 600<br>--}}
                                <div class="mb-1"><b> Instagram:</b>
                                    @if($artist->instagram)
                                        <a href="{{$artist->instagram}}">{{substr($artist->instagram,0,25) . '...'}}</a>
                                </div>
                                @else
                                    <span>-</span>
                                @endif
                                {{--                                <div class="mb-1"><b>Youtube:</b>--}}
                                {{--                                    @if($artist->youtube)--}}

                                {{--                                    <a--}}
                                {{--                                        href="{{$artist->youtube}}">{{$artist->youtube}}</a></div>--}}
                                {{--                                @else--}}
                                {{--                                    <span>-</span>--}}
                                {{--                                @endif--}}

                                {{--                Email: info@almasaeedstudio.com--}}
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">

                            <address>
                                <div class="mb-1"><b>Facebook:</b>

                                    @if($artist->facebook)
                                        <a
                                            href="{{$artist->facebook}}">{{substr($artist->facebook,0,25) . '...'}}</a>
                                </div>
                                @else
                                    <span>-</span>
                                @endif
                                <div class="mb-1"><b>Linkedin:</b>
                                    @if($artist->linkedin)
                                        <a
                                            href="{{$artist->linkedin}}">{{substr($artist->linkedin,0,25) . '...'}}</a>
                                </div>
                                @else
                                    <span>-</span>
                                @endif
                                {{--                                <div class="mb-1"><b> Twitter:</b>--}}

                                {{--                                   @if($artist->twitter)--}}
                                {{--                                    <a--}}
                                {{--                                        href="{{$artist->twitter}}">{{$artist->twitter}}</a></div>--}}
                                {{--                                @else--}}
                                {{--                                    <span>-</span>--}}
                                {{--                                @endif--}}
                                {{--                                <div class="mb-1"> <b> Royalties Percentage:</b>  {{$asset->royalties_percentage}} <br></div>--}}
                                {{--                                <div class="mb-1">  <b> Start Date:</b> {{$asset->start_date}}<br></div>--}}
                                {{--                                <div class="mb-1">  <b> End Date:</b> {{$asset->end_date}}<br></div>--}}
                                {{--                Email: john.doe@example.com--}}
                            </address>

                            <!-- /.col -->
                        {{--                        <div class="col-sm-4 invoice-col">--}}
                        {{--                            <div class="mb-1"> <b>creator:</b> {{$asset->gallery->name}}<br></div>--}}
                        {{--                            <div class="mb-1"> <b>category:</b> {{$asset->category->title}}<br></div>--}}
                        {{--                            <b>Artist:</b> {{$asset->artist->full_name}}<br>--}}
                        {{--                            --}}{{--            <b>Account:</b> 968-34567--}}
                        {{--                        </div>--}}
                        <!-- /.col -->
                        </div>
                        <div class="col-sm-4 invoice-col">

                            <address>

                                <div class="mb-1"><b>Youtube:</b>
                                    @if($artist->youtube)

                                        <a
                                            href="{{$artist->youtube}}">{{substr($artist->youtube,0,25) . '...'}}</a>
                                </div>
                                @else
                                    <span>-</span>
                                @endif
                                <div class="mb-1"><b> Twitter:</b>

                                    @if($artist->twitter)
                                        <a href="{{$artist->twitter}}">{{substr($artist->twitter,0,25) . '...'}}</a>
                                </div>

                                @else
                                    <span>-</span>
                                @endif
                            </address>
                        </div>
                    </div>
                    <div class="row m-4" style="border-top:2px solid whitesmoke">

{{--                        @foreach($artist->assets as $asset)--}}
{{--                            <ul>--}}
{{--                                <li><b>Asset:</b>--}}
{{--                                    <a href="{{route('assets.show',$asset->id)}}">--}}
{{--                                        {{$asset->title}}--}}
{{--                                    </a>--}}

{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        @endforeach--}}

                            <div>
                                <div>
                                    <b>Assets</b>
                                </div>
                                <div>
                                    @if(count($artist->assets)>0)
                                        @foreach($artist->assets as $asset)
                                            <ul>
                                                <img src="{{asset($asset->medias->where('main',true)->first()->path)}}" alt="" width="100"
                                                     height="100">
                                                <li>
                                                    <b>Title:</b>
                                                    <a href="{{route('assets.show',$asset->id)}}">
                                                        {{$asset->title}}
                                                    </a>
                                                </li>
                                                <li><b>Gallery:</b>
                                                    <a href="{{route('galleries.show',$asset->gallery->id)}}">{{$asset->gallery->name}}</a>
                                                </li>
                                            </ul>
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

{{--                    <div class="row m-4" style="border-top:2px solid whitesmoke">--}}

{{--                        @foreach($artist->medias as $media)--}}
{{--                            @if($loop->index>0)--}}
{{--                                <img style="margin-top: 20px; margin-right: 20px" src="{{asset($media->path)}}" alt=""--}}
{{--                                     width="100" height="100"/>--}}
{{--                            @endif--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
                    <div class="row m-4 pb-3"
                         style="border-top:2px solid whitesmoke;">
                        {{--                        <div>--}}
                        <div>
                            <div>
                                <b>Pictures</b>
                            </div>
                            <div>
                                @if(count($artist->medias)>1)
                                    @foreach($artist->medias as $media)
                                        @if($media->main==false)

                                            <a target="_blank" href="{{'http://127.0.0.1:8000/'.$media->path}}" >
                                                <img  src="{{asset($media->path)}}" class="mx-2 mb-2" alt="white sample" width="100" height="100"/>
                                            </a>
                                        @endif
                                    @endforeach
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
                         style="border-top:2px solid whitesmoke;">

                        <div>
                            <div>
                                <b>Videos</b>
                            </div>
                            <div>
                                @if(count($artist->videoLinks)>0)
                                    @foreach($artist->videoLinks as $videoLink)
                                        {!! ($videoLink->link) !!}
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


                    <div class="row m-4" style="border-top: 2px solid whitesmoke ">
                        <div>
                            <b>News</b>
                        </div>
{{--                            <p class="lead"><b>News</b></p>--}}
                        <div class="col-12">
                            @if(count($artist->news)>0)
                            <div class="table-responsive">
                                <table class="">
                                    @foreach($artist->news as $a_news)
                                        <tr>
                                            <th style="width:50%">{{$a_news->title}}</th>
                                            <td><a href="{{$a_news->link}}">{{$a_news->link}}</a></td>
                                        </tr>
                                    @endforeach
                                                                    </table>
                            </div>
                            @else
                                <ul style="list-style-type: none">
                                    <li>
                                        No News

                                    </li>
                                </ul>
                            @endif
                        </div>
                    </div>


@endsection
