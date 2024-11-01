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
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Contracts for {{$asset->title}} asset</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="card col-sm-12">
                        <div class="card-header">
                            <h3 class="card-title">Fraction this asset</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{route('asset.nft.fraction',$asset_id)}}" id="myform" method="POST" style="display: inline" onsubmit="showLoading('Your NFT is being fractioned. Please wait...')">
                                @CSRF
                                <div class="form-group">
                                    <label >token name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="tokenName" placeholder="tokenName">
                                    @error('tokenName')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label >token symbol <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="tokenSymbol" placeholder="tokenSymbol">
                                    @error('tokenSymbol')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                    <button type="submit" class="btn btn-primary" id="btnSubmit">Fraction</button>


                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="card col-sm-12">

                    <div class="card-header">
                        <a href="{{route('contracts.create',$asset_id)}}" type="button"
                           class="btn btn-success mr-2 float-right"> <i
                                class="fa fa-plus mr-2 "></i> Add contract</a>
                        <div class="float-right mr-2">
                            <form action="{{ route('asset.ipfs.mint',$asset_id) }}" myform="myform" method="POST" style="display: inline;" onsubmit="showLoading('Your NFT is being minted. Please wait...')">
                                @csrf
                                <button id="btnSubmit" type="submit" class="btn btn-primary">Mint</button>

                            </form>

                        </div>

                        <h3 class="card-title">Contract</h3>
                        <br>
                        <h6>
                            Total Fraction(s): {{$asset->total_fractions}}
                        </h6>



                        <div id="loading">

                                <div class="spinner"></div>
                                <div id="loading-text">
                                    @if(session('status'))
                                        {{ session('status') }}
                                    @else
                                        Your NFT is being minted. Please wait...
                                    @endif
                                </div>
                        </div>




                    </div>

                {{--                    <div class="card col-sm-12">--}}
                {{--                        <div class="card-header">--}}
                {{--                            <h3 class="card-title">Contract</h3>--}}
                {{--                        </div>--}}
                <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Contract Number</th>
                                <th>Hash</th>
                                <th>Image</th>
                                <th>Asset</th>
                                <th>created at</th>
                                <th>Minted At</th>
                                <th>Signer Wallet Address</th>

                                <th>
                                    Operation
                                </th>

{{--                                <th>Operations</th>--}}
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($contracts as $contract)
                                <tr>
                                    <td>
                                        {{$contract->contract_number}}
                                    </td>
                                    <td>
                                        {{$contract->hash}}
                                    </td>
                                    <td>
                                        <img src="https://ipfs.infura.io/ipfs/{{$contract->hash}}" alt="">
                                    </td>
                                    <td>
                                        {{$contract->asset->title}}
                                    </td>
                                    <td>
                                        {{$contract->created_at}}
                                    </td>
                                    <td>
                                        {{$contract->minted ? $contract->minted->created_at : ''}}
                                    </td>
                                    <td>
                                        {{$contract->minted ? $contract->minted->wallet->wallet_address : ''}}
                                    </td>
                                    <td>
                                        @if($contract->hash == null)

                                            <div class="m-1">
                                                <button type="button"
                                                        onclick="deleteModal(this)"
                                                        data-id="{{$contract->id}}"
                                                        class="btn btn-danger "><i
                                                        class="fa fa-trash "></i>delete
                                                </button>
                                            </div>
                                        @endif
                                    </td>
{{--                                    <td>--}}
{{--                                        @if(!$contract->minted)--}}
{{--                                            <div data-contractId="{{$contract->id}}" id="single-mint"></div>--}}
{{--                                        @endif--}}
{{--                                    </td>--}}
                                    {{--                                        <td>--}}
                                    {{--                                            --}}{{--<a href="#" class="text-muted">--}}
                                    {{--                                            --}}{{--<i class="fas fa-search"></i>--}}
                                    {{--                                            --}}{{--</a>--}}
                                    {{--                                            <div class="row">--}}
                                    {{--                                                <div class="col-md-3">--}}
                                    {{--                                                    <a href="{{route('contracts.edit',$contract->id)}}" type="button"--}}
                                    {{--                                                       class="btn btn-primary "> <i class="fa fa-edit "></i> edit </a>--}}
                                    {{--                                                </div>--}}

                                    {{--                                            </div>--}}
                                    {{--                                        </td>--}}
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>

        <!-- /.row -->
        </div>
        <form action="" id="delete-form" method="POST">
            @method('delete')
            @csrf
        </form>

    </section>
{{--    <form action="" id="delete-form" method="POST">--}}
{{--        @method('delete')--}}
{{--        @csrf--}}
{{--    </form>--}}


@endsection

@section('scripts')
    <!-- DataTables  & Plugins -->
    <script src="{{asset('admin/js/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/js/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/js/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('admin/js/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/js/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('admin/js/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/js/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('admin/js/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('admin/js/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('admin/js/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('admin/js/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('admin/js/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('admin/mint/app.js')}}"></script>
    <script src="{{asset('admin/mint/single/app.js')}}"></script>
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false, "ordering": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
    <script>
        $(document).ready(function () {
            const element = document.getElementById("example1_filter");
            element.style.float = 'inline-end';
        });
    </script>

    <script>
        $(document).ready(function () {
            const element = document.getElementById("example1_filter");
            element.style.float = 'inline-end';
        });
    </script>
    <script>
        function deleteModal(element) {
            var contractsId = $(element).data('id');
            document.getElementById('delete-form').action = "/contracts/"+contractsId+"/destroy";
            Swal.fire({
                icon: 'warning',
                title: 'Do you want to delete this contract?',
                showCancelButton: true,
                showConfirmButton: true,
                confirmButtonText: `yes`,
                cancelButtonText: `no`,
                confirmButtonColor: '#22303d',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.value) {
                    $("#delete-form").submit();
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        title: 'the removal request was canceled',
                        icon: 'info',
                        confirmButtonText: 'ok',
                        confirmButtonColor: '#22303d'
                    });

                }
            })
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            window.showLoading = function(text) {
                var loadingElement = document.getElementById('loading');
                var loadingText = document.getElementById('loading-text');
                if (!loadingElement) {
                    console.error("Loading element not found!");
                    return;
                }

                // Show the loading element
                loadingElement.style.display = 'flex';
                loadingText.innerHTML = text;
            };
        });
    </script>

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




@endsection

