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
{{--                    <img src="{{asset($user->media->path)}}" class="avatar" alt="" width="100" height="100"/>--}}
                </div>
                <div class="col-sm-6">
                    <h1>{{$auction->asset_name}}</h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="callout callout-info">
                    <div class="row">
                        <div class="col-11">
                            <h5>Auction Name</h5>
                            <p>{{($auction->auction_name)}}</p>
                        </div>

                    </div>


                </div>
                <div class="invoice p-3 mb-3">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-12">
                            <h4>
                                <i ></i>
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
                                <div class="mb-1">   <b>size:</b>  {{$auction->size}}</div>
                                {{--                795 Folsom Ave, Suite 600<br>--}}
                                <div class="mb-1">   <b>material:</b>  {{$auction->material}}<br></div>


                                {{--                Email: info@almasaeedstudio.com--}}
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">

                            <address>
                                {{--                                <div class="mb-1">   <b>Username:</b>  {{$user->username}}<br></div>--}}
                                <div class="mb-1"> <b>creation-date:</b>  {{$auction->creation_date}} <br></div>
                                <div class="mb-1"> <b>auction-date:</b>  {{$auction->auction_date}} <br></div>


                            </address>
                        </div>
                        <div class="col-sm-4 invoice-col">

                            <address>
                                {{--                                <div class="mb-1">   <b>Username:</b>  {{$user->username}}<br></div>--}}
                                <div class="mb-1"> <b>sold-price:</b>  {{$auction->sold_price}} <br></div>
                                <div class="mb-1"> <b>estimated-price:</b>  {{$auction->estimated_price}} <br></div>
                                <div class="mb-1"> <b>hammer-price:</b>  {{$auction->hammer_price}} <br></div>


                            </address>
                        </div>


                    </div>
                    <!-- /.row -->

                </div>

@endsection
