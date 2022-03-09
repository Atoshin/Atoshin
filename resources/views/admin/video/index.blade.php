
@extends('admin.layout.master')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Video Table</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="card col-sm-12">
                    <div class="card-header">
                        <a href="{{route('videos.create', $asset_id)}}" type="button" class="btn btn-success mr-2 float-right"> <i
                                class="fa fa-plus mr-2 "></i> Add Live Video </a>
                        <a href="{{route('assets.index',$asset_id)}}" type="button"
                           class="btn btn-primary mr-2 float-right"> <i
                                class="fa fa-paint-brush mr-2 "></i> Asset Table</a>
                        <h3 class="card-title">Video for {{$asset->title}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>

                                <th>Link</th>
{{--                                <th>title</th>--}}
                                <th>Operations</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($videos as $video)
                                <tr>
                                    <td>{{$video->link}}</td>
{{--                                    <td>--}}
{{--                                        {{ $video->asset->title}}--}}
{{--                                    </td>--}}
                                    <td>
                                        <div class="row">
                                            <div class="m-1">
                                                <a href="{{ route('videos.edit',$video) }}" type="button"
                                                   class="btn btn-primary "> <i class="fa fa-edit "></i> edit </a>
                                            </div>
                                            <div class="m-1">
                                                <button type="button"
                                                        onclick="deleteModal(this)"
                                                        data-id="{{$video->id}}"
                                                        class="btn btn-danger delete-icon"><i
                                                        class="fa fa-trash mr-2"></i>delete
                                                </button>

                                            </div>

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
                "responsive": true, "lengthChange": false, "autoWidth": false, "ordering": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            // $('#example2').DataTable({
            //     "paging": true,
            //     "lengthChange": false,
            //     "searching": false,
            //     "ordering": true,
            //     "info": true,
            //     "autoWidth": false,
            //     "responsive": true,
            // });
        });
    </script>
    <script>

        $(".delete-icon").on("click", function () {
            var VideoId = $(this).data('id');
            $("#delete-form").attr("action", "/videos/"+VideoId+"/destroy")
        });

    </script>
    <script>
        function deleteModal(element) {
            var VideoID = $(element).data('id');
            document.getElementById('delete-form').action ="/videos/"+VideoID+"/destroy";
            Swal.fire({
                icon: 'warning',
                title: 'Do you want to delete this video?',
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



