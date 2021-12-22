@extends('admin.layout.master')
@section('styles')
    <style>
        .avatar {
            border-radius: 50%;
            margin: 0.5em;
        }
    </style>
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-1">
                    <img src="{{asset($asset->medias->where('mediable_type',\App\Models\Asset::class)->where('mediable_id',$asset->id)->where('main',true)->first()->path)}}" class="avatar" alt="" width="100"
                         height="100"/>
                </div>
                <div class="col-sm-6 py-4">
                    <h1>{{$asset->title}}</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="callout callout-info">
                    <h5><i></i>Back Story:</h5>
                    {!!$asset->bio!!}
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
                                <div class="mb-1"><b>Price:</b> {{$asset->price}}<br></div>
                                {{--                795 Folsom Ave, Suite 600<br>--}}
                                <div class="mb-1"><b>category:</b> {{$asset->category->title}}<br></div>
                                <div class="mb-1"><b> Commission percentage:</b> {{$asset->commission_percentage}}<br>
                                    <div class="mb-1">
                                        <b> Creation:</b>
                                        @if($asset->creation)
                                            {{$asset->creation}}<br></div>
                                    @else
                                        <span>-</span>
                                    @endif
                                </div>
                                <div class="mb-1"><b>creator:</b> <a style="color: white;text-decoration-line: underline"
                                                                     href="{{route('galleries.show', $asset->gallery)}}">{{$asset->gallery->name}}</a><br>
                                </div>

{{--                                <div class="mb-1"><b>Sold Fractions:</b> {{$asset->sold_fractions}}<br></div>--}}


                                {{--                Email: info@almasaeedstudio.com--}}
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">

                            <address>
                                <div class="mb-1"><b>Fractions:</b> {{$asset->sold_fractions.'/'.$asset->total_fractions}}<br></div>


                                <div class="mb-1">
                                    <b> Start Date:</b>
                                    @if($asset->start_date)
                                        {{$asset->start_date}}<br></div>
                                @else
                                    <span>-</span>
                                @endif
                                <div class="mb-1"><b> Ownership Percentage:</b> {{$asset->ownership_percentage}} <br>
                                </div>

                                <div class="mb-1">
                                    <b> Size:</b>
                                    @if($asset->size)
                                        {{$asset->size}}<br></div>
                                @else
                                    <span>-</span>
                                @endif
                                <b>Artist:</b><a style="color: white;text-decoration-line: underline"
                                                 href="{{route('artists.show', $asset->artist)}}">{{$asset->artist->full_name}}</a><br>

                                {{--                Email: john.doe@example.com--}}
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <div class="mb-1"><b> Status:</b> {{$asset->status}}<br></div>
                            <div class="mb-1">
                                <b> End Date:</b>
                                @if($asset->end_date)
                                    {{$asset->end_date}}<br></div>
                            @else
                                <span>-</span>
                            @endif
                            <div class="mb-1"><b> Royalties Percentage:</b> {{$asset->royalties_percentage}} <br>
                            </div>

                            {{--            <b>Account:</b> 968-34567--}}


                            <div class="mb-1">
                                <b> Material:</b>
                                @if($asset->material)
                                    {{$asset->material}}<br></div>
                            @else
                                <span>-</span>
                            @endif
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
                    <!-- /.row -->

{{--                    <div class="row m-4" style="border-top:2px solid whitesmoke">--}}

{{--                        @foreach($asset->medias as $media)--}}
{{--                            <img style="margin-top: 20px; margin-right: 20px" src="{{asset($media->path)}}" alt=""--}}
{{--                                 width="100" height="100"/>--}}

{{--                        @endforeach--}}
{{--                    </div>--}}
                    <div>
                    <div class="row m-4 pb-3"
                         style="border-top:2px solid whitesmoke;">
                        {{--                        <div>--}}
                        <div>
                            <div>
                                <b>Pictures</b>
                            </div>
                            <div>
                                @if(count($asset->medias)>1)
                                    @foreach($asset->medias as $media)
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
                                @if(count($asset->videoLinks)>0)
                                    @foreach($asset->videoLinks as $videoLink)
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

                    <div class="row m-4 pb-3" style="border-top:2px solid whitesmoke">
                        <div>
                            <div>
                                <b>Live Video Links</b>
                            </div>
                            <div>
                            @if(count($asset->videos)>0)
                                <div>
                                    @foreach($asset->videos as $video)
                                        <a style="color: white;text-decoration-line: underline"
                                           href="{{$video->link}}">{{$video->link}}</a><br>

                                    @endforeach
                                </div>
                            @else
                                    <ul style="list-style-type: none">
                                        <li>
                                            No Live Video Link
                                        </li>
                                    </ul>
                            @endif
                            </div>
                        </div>
                    </div>
                    </div>





@endsection
