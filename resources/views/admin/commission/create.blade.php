@extends('admin.layout.master')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Commission Fee</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        <div id="market-abi" data-content="{{json_encode($MarketAbi)}}"></div>
        <div id="market-address" data-content="{{$marketAddress}}"></div>
        <div id="provider" data-content="{{$provider}}"></div>
        <div id="commissions-root">

        </div>
    </div>
@endsection



@section('scripts')
    <script src="{{asset('admin/mint/commissions/app.js')}}"></script>
@endsection
