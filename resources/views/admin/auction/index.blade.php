@extends('admin.layout.master')
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Auctions Table</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="card col-sm-12">
                    <div class="card-header">
                        <a href="{{route('auctions.create', $artist_id)}}" type="button"
                           class="btn btn-success mr-2 float-right"> <i
                                class="fa fa-plus mr-2 "></i> Add Auctions</a>

                        <a href="{{route('artists.index')}}" type="button"
                           class="btn btn-primary mr-2 float-right"> <i
                                class="fa fa-dollar-sign mr-2 "></i> Artist Table</a>
                        <h3 class="card-title">Auctions of {{$artist->full_name}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Auction Name</th>
                                <th>Asset Name</th>
                                <th>Operation</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($auctions as $auction)
                                <tr>

                                    <td><a href="{{route('auctions.show',$auction->id)}}">{{$auction->auction_name}}</a></td>
                                    <td>{{$auction->asset_name}}</td>
                                    <td>
                                        <div class="row">
                                            <div class="m-1">
                                                <a href="{{route('auctions.edit',$auction->id)}}" type="button"
                                                   class="btn btn-primary ">
                                                    <i class="fa fa-edit "></i> edit
                                                </a>
                                            </div>
                                            <div class="m-1">
                                                <a href="{{ route('upload.page',['type'=>\App\Models\Auction::class,'id'=>$auction->id,'edit'=>1]) }}"
                                                   type="button"
                                                   class="btn btn-primary "> <i class="fa fa-film "></i> Edit
                                                    media
                                                </a>
                                            </div>
                                            <div class="m-1">
                                                <button type="button"
                                                        onclick="deleteModal(this)"
                                                        data-id="{{$auction->id}}"
                                                        class="btn btn-danger "><i
                                                        class="fa fa-trash "></i>delete
                                                </button>
                                            </div>

                                            {{--                                            <div class="m-1">--}}
                                            {{--                                                <a href="{{route('locations.create', $gallery->id)}}" type="button"--}}
                                            {{--                                                   class="btn btn-success "> <i class="fa fa-location-arrow "></i> location </a>--}}
                                            {{--                                            </div>--}}
                                        </div>


                                    </td>


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

        <form action="" id="delete-form" method="POST">
            @method('delete')
            @csrf
        </form>

    </section>


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
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>

    <script>
        function deleteModal(element) {
            var auctionsId = $(element).data('id');
            document.getElementById('delete-form').action = "/auctions/"+auctionsId+"/destroy";
            Swal.fire({
                icon: 'warning',
                title: 'Do you want to delete this auction?',
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



@endsection







