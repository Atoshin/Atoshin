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
                <div class="callout callout-info">
                    <div class="row">
                        {{--                        <div class="col-1">--}}
                        {{--                            <img src="{{asset($gallery->medias->first()->path)}}" alt="" width="100" height="100"/>--}}
                        {{--                        </div>--}}
                        <div class="col-11 ckeditor-text">
                            <h5>Bio:</h5>
                            <p>{!! $gallery->bio !!}</p>
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
                            <address>
                                <div class="mb-1"><b>Wallet Address:</b> {{$gallery->wallet->wallet_address}}<br></div>
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
                                        <a href="{{$gallery->website}}">{{$gallery->website}}</a></div>
                                @else
                                    <span>-</span>
                                @endif

                                {{--                795 Folsom Ave, Suite 600<br>--}}
                                <div class="mb-1"><b> Instagram:</b>
                                    @if($gallery->instagram)
                                        <a   href="{{$gallery->instagram}}">{{$gallery->instagram}}</a></div>
                                @else
                                    <span>-</span>
                                @endif
                                <div class="mb-1"><b>Youtube:</b>
                                    @if($gallery->youtube)

                                        <a
                                            href="{{$gallery->youtube}}">{{$gallery->youtube}}</a></div>
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
                                            href="{{$gallery->facebook}}">{{$gallery->facebook}}</a></div>
                                @else
                                    <span>-</span>
                                @endif
                                <div class="mb-1"><b>Linkedin:</b>
                                    @if($gallery->linkedin)
                                        <a
                                            href="{{$gallery->linkedin}}">{{$gallery->linkedin}}</a></div>
                                @else
                                    <span>-</span>
                                @endif
                                <div class="mb-1"><b> Twitter:</b>

                                    @if($gallery->twitter)
                                        <a
                                            href="{{$gallery->twitter}}">{{$gallery->twitter}}</a></div>
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


                    <div class="row m-4" style="border-top:2px solid whitesmoke">

                        @foreach($gallery->medias as $media)
                            <img style="margin-top: 20px; margin-right: 20px" src="{{asset($media->path)}}" alt=""
                                 width="100" height="100"/>

                        @endforeach
                    </div>



@endsection
