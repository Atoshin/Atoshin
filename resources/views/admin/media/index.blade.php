@extends('admin.layout.master')
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Media Table</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="card col-sm-12">
                    <div class="card-header">

                        <h3 class="card-title">Media</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>path</th>

                                <th>show in homepage</th>
                                {{--                                <th>operations</th>--}}
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($medias as $media)
                                <tr>
                                    <td>
                                        <a target="_blank" href="{{'http://127.0.0.1:8000/'.$media->path}}">

                                            <img src="{{asset($media->path)}}" class="avatar" alt="" width="100"
                                                 height="100"/>

                                        </a>

                                    </td>
                                    <td><a target="_blank" href="{{'http://127.0.0.1:8000/'.$media->path}}">{{substr($media->path,13,50)}}</a></td>
                                    <td>{{$media->path}}</td>
                                    {{--                                    <td>{{$gallery->wallet ? $gallery->wallet->wallet_address : '-'}}</td>--}}

                                    <td>
                                        <form action="{{route('homepage.media',$media->id)}}" method="post">
                                            @csrf
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input"@if($media->homeapage_picture == true) checked @endif id="customSwitch-{{$media->id}}" onchange="submitForm(event)">
                                                <label class="custom-control-label" for="customSwitch-{{$media->id}}" ></label>
                                            </div>
                                        </form>
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
        </div>
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
            var GalleryId = $(this).data('id');
            $("#delete-form").attr("action", "/users/" + GalleryId)
        });

    </script>
    <script>
        function deleteModal(element) {
            var GalleryID = $(element).data('id');
            document.getElementById('delete-form').action = `/galleries/${GalleryID}`;
            Swal.fire({
                icon: 'warning',
                title: 'Do you want to delete this Gallery?',
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
        function submitForm(e)
        {
            const checkbox = e.target;
            console.log(checkbox.value)
            const form = checkbox.parentElement.parentElement
            form.submit()
        }
    </script>



@endsection







