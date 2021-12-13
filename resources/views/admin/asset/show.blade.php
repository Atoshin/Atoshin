@extends('admin.layout.master')
@section('styles')
    <style>
        img {
            border-radius: 50%;
            margin: 0.5em;
        }
    </style>
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{$asset->title}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
{{--                        <li class="breadcrumb-item"><a href="#">Home</a></li>--}}
                        <li class="breadcrumb-item active"></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="callout callout-info">
                    <h5><i ></i>Bio:</h5>
                    {{strip_tags($asset->bio)}}
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
                <div class="mb-1">   <b>Price:</b> {{$asset->price}}<br></div>
{{--                795 Folsom Ave, Suite 600<br>--}}
                <div class="mb-1">   <b> Total Fractions:</b>  {{$asset->total_fractions}}<br></div>
                <div class="mb-1"> <b>Sold Fractions:</b> {{$asset->sold_fractions}}<br></div>
                <div class="mb-1"> <b> Status:</b> {{$asset->status}}<br></div>

{{--                Email: info@almasaeedstudio.com--}}
            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">

            <address>
                <div class="mb-1">   <b> Commission percentage:</b>  {{$asset->commission_percentage}}<br></div>
                <div class="mb-1"> <b> Ownership Percentage:</b>  {{$asset->ownership_percentage}} <br></div>
                <div class="mb-1"> <b> Royalties Percentage:</b>  {{$asset->royalties_percentage}} <br></div>
                <div class="mb-1">
                    <b> Start Date:</b>
                        @if($asset->start_date)
                    {{$asset->start_date}}<br></div>
                @else
                    <span>-</span>
                @endif
                <div class="mb-1">
                    <b> End Date:</b>
                    @if($asset->end_date)
                    {{$asset->end_date}}<br></div>
                @else
                    <span>-</span>
                @endif
{{--                Email: john.doe@example.com--}}
            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <div class="mb-1"> <b>creator:</b> {{$asset->gallery->name}}<br></div>
            <div class="mb-1"> <b>category:</b> {{$asset->category->title}}<br></div>
            <b>Artist:</b> {{$asset->artist->full_name}}<br>
{{--            <b>Account:</b> 968-34567--}}
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

        <div class="row">
            @foreach($asset->medias as $media)
                <img src="{{asset($media->path)}}" alt="" width="100" height="100"/>
            @endforeach
        </div>





</div>



@endsection
