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
                            {{--      <div class="mb-1"><b>Bio:</b> {{$asset->bio}}</div>--}}
                            <address>
                                <div class="mb-1"><b>Wallet Address:</b> {{$gallery->wallet->wallet_address}}<br></div>

                                {{--                795 Folsom Ave, Suite 600<br>--}}
                                {{--                                <div class="mb-1">   <b> Avatar:</b>  {{$gallery->avatar}}<br></div>--}}


                                {{--                Email: info@almasaeedstudio.com--}}
                            </address>
                        </div>
                        <!-- /.col -->

                        <div class="col-sm-4 invoice-col">

                            <address>
                                {{--                                <div class="mb-1"> <b>Wallet Address:</b>  {{$gallery->wallet->wallet_address}}<br></div>--}}

                            </address>
                        </div>
                        <!-- /.col -->

                    </div>


                    <div class="row m-4" style="border-top:2px solid whitesmoke">

                        @foreach($gallery->medias as $media)
                            @if($loop->index>0)
                            <img style="margin-top: 20px; margin-right: 20px" src="{{asset($media->path)}}" alt=""
                                 width="100" height="100"/>
                            @endif
                        @endforeach
                    </div>



@endsection
