@extends('admin.layout.master')
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
                        <a href="{{route('contracts.create',$asset_id)}}" type="button"
                           class="btn btn-success mr-2 float-right"> <i
                                class="fa fa-plus mr-2 "></i> Add contract</a>
                        <div id="mint-button" data-assetId="{{$asset_id}}"></div>
                        <h3 class="card-title">Contract</h3>

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
                                <th>Asset</th>
                                <th>created at</th>
                                <th>Minted At</th>
                                <th>Signer Wallet Address</th>
                                <th>Operations</th>
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
                                        @if(!$contract->minted)
                                            <div data-contractId="{{$contract->id}}" id="single-mint"></div>
                                        @endif
                                    </td>
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

    </section>
    <form action="" id="delete-form" method="POST">
        @method('delete')
        @csrf
    </form>


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

@endsection

