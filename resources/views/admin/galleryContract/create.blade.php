@extends('admin.layout.master')
@section('styles')
    <style>
        #loading {
            display: none; /* Initially hidden */
            margin: 1%;
            background-color: #9d1e15;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            flex-direction: row;
            justify-content: left;
            align-items: center;

        }

        .spinner {
            border: 5px solid #003e80; /* Light grey */
            border-top: 5px solid #FFFFFF; /* Blue */
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            /*margin: 0 auto;*/
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        #loading-text {
            margin-left: 1%;
            font-size: 18px;
            color: #fff;
        }
    </style>

@endsection
@section('content')
    @if(!$gallery->galleryContract)
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Deploy {{$gallery->name}} Contract</h3>
        </div>
            <form action="{{route('gallery.contract.store',[$gallery->id])}}" method="POST" id="myform" onsubmit="showLoading()">
                @CSRF
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">wallet address</label>
                        <input type="text" class="form-control" disabled readonly name="wallet_address" placeholder="address" value="{{$gallery->wallet->wallet_address}}">
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" id="btnSubmit" class="btn btn-primary">Deploy Contract</button>
                </div>
            </form>
    </div>

    @else
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">{{$gallery->name}} Contract info</h3>
            </div>
            <div class="card-body">

                <div class="callout callout-success ckeditor-text">
                    <h5><i></i>contract address:</h5>
                    {!!$gallery->GalleryContract->contract_address!!}
                    <a class="text text-olive" href="https://sepolia.etherscan.io/address/{!!$gallery->GalleryContract->contract_address!!}">view in etherscan</a>

                </div>
                <div class="callout callout-success">
                    <h5><i></i>contract deployment transaction hash number:</h5>
                    @if($gallery->GalleryContract->transaction)
                        {!!$gallery->GalleryContract->transaction->txn_hash!!}
                        <a class="text text-olive" href="https://sepolia.etherscan.io/tx/{!!$gallery->GalleryContract->transaction->txn_hash!!}">view in etherscan</a>
                    @endif
                </div>
            </div>
        </div>
    @endif



    <div id="loading">

        <div class="spinner"></div>
        <div id="loading-text">
            {{$gallery->name}}'s contract is being deployed. Please wait...
        </div>
    </div>


@endsection

@section('scripts')

    <script>
        $("#myform").on('submit',function (){
            $("#btnSubmit").attr("disabled", true);
        });

    </script>

    @if(\Illuminate\Support\Facades\Session::has('success'))
        @if(\Illuminate\Support\Facades\Session::get('success') == 'true')
            <script type="text/javascript">
                Swal.fire({
                    target: 'body',
                    icon: '{{\Illuminate\Support\Facades\Session::has('icon') ? \Illuminate\Support\Facades\Session::get('icon') : 'success'}}',
                    title: '{{\Illuminate\Support\Facades\Session::get('title')}}',
                    showCancelButton: false,
                    showConfirmButton: false,
                    timer: 100000,
                })
            </script>
        @else
            <script type="text/javascript">
                Swal.fire({
                    target: 'body',
                    icon: 'warning',
                    title: '{{\Illuminate\Support\Facades\Session::get('error')}}',
                    showCancelButton: false,
                    showConfirmButton: false,
                    timer: 100000,
                })
            </script>
        @endif

    @endif

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            window.showLoading = function() {
                var loadingElement = document.getElementById('loading');
                if (!loadingElement) {
                    console.error("Loading element not found!");
                    return;
                }

                // Show the loading element
                loadingElement.style.display = 'flex';
            };
        });
    </script>
@endsection
