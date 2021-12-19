@extends('admin.layout.master')
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>News Table</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="card col-sm-12">
                    <div class="card-header">
                        <a href="{{route('news.create', $artist_id)}}" type="button"
                           class="btn btn-success mr-2 float-right"> <i
                                class="fa fa-plus mr-2 "></i> Add News</a>
                        <h3 class="card-title">News</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Link</th>
                                <th>Operation</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($news as $a_news)
                                <tr>
                                    <td>{{$a_news->title}}</td>
                                    <td><a href="{{$a_news->link}}">{{$a_news->link}}</a></td>
                                    <td>
                                        <div class="row">
                                            <div class="m-1">
                                                <a href="{{route('news.edit',$a_news->id)}}" type="button"
                                                   class="btn btn-primary ">
                                                    <i class="fa fa-edit "></i> edit
                                                </a>
                                            </div>
                                            <div class="m-1">
                                                <button type="button"
                                                        onclick="deleteModal(this)"
                                                        data-id="{{$a_news->id}}"
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
            var newsId = $(element).data('id');
            document.getElementById('delete-form').action = "/news/"+newsId+"/destroy";
            Swal.fire({
                icon: 'warning',
                title: 'Do you want to delete this news?',
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







