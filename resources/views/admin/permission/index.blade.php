@extends('admin.layout.master')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Permission Table</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="card col-sm-12">
                    <div class="card-header">
                        <a href="{{route('permissions.create')}}" type="button" class="btn btn-success mr-2 float-right"> <i
                                class="fa fa-plus mr-2 "></i> Add permission</a>
                        <h3 class="card-title">Permission</h3>
                    </div>

                {{--                    <div class="card col-sm-12">--}}
                {{--                        <div class="card-header">--}}
                {{--                            <h3 class="card-title">Category</h3>--}}
                {{--                        </div>--}}
                <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                {{--                                    <th>Parent category</th>--}}
                                <th>Options</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($permissions as $permission)
                                <tr>
                                    <td>
                                        {{$permission->name}}
                                    </td>
                                    {{--                                        <td>--}}
                                    {{--                                            {{$category->parent ? $category->parent->title : "-"}}--}}
                                    {{--                                        </td>--}}
                                    <td>
                                        {{--<a href="#" class="text-muted">--}}
                                        {{--<i class="fas fa-search"></i>--}}
                                        {{--</a>--}}
                                        <div class="row">
                                            <div class="m-1">
                                                <a href="{{route('permissions.edit',$permission->id)}}" type="button"
                                                   class="btn btn-primary "> <i class="fa fa-edit "></i> edit </a>
                                            </div>
                                            <div class="m-1">
                                                <button type="button"
                                                        onclick="deleteModal(this)"
                                                        data-id="{{$permission->id}}"
                                                        class="btn btn-danger "><i
                                                        class="fa fa-trash "></i>delete
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
        <form action="" id="delete-form" method="POST">
            @method('delete')
            @csrf
        </form>
        <!-- /.row -->
        </div>

    </section>


    {{--    <section class="content">--}}
    {{--        <div class="container-fluid">--}}
    {{--            <div class="row">--}}
    {{--                <div class="card col-sm-12">--}}
    {{--                    <div class="card-header" style="display: inline;">--}}
    {{--                        <div>--}}
    {{--                            <h3 class="card-title">Categories</h3>--}}
    {{--                        </div>--}}
    {{--                        <div style="float: inline-end ">--}}
    {{--                            <a href="{{route('categories.create')}}" class="btn btn-secondary btn-sm">Create</a>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                    <!-- /.card-header -->--}}
    {{--                    <div class="card-body">--}}
    {{--                        <table id="example1" class="table table-bordered table-striped">--}}
    {{--                            <thead>--}}
    {{--                            <tr>--}}
    {{--                                <th>Title</th>--}}
    {{--                                <th>Parent category</th>--}}
    {{--                                <th>More</th>--}}
    {{--                            </tr>--}}
    {{--                            </thead>--}}
    {{--                            <tbody>--}}
    {{--                            @foreach($categories as $category)--}}
    {{--                                <tr>--}}
    {{--                                    <td>--}}
    {{--                                        {{$category->title}}--}}
    {{--                                    </td>--}}
    {{--                                    <td>--}}
    {{--                                        {{$category->parent ? $category->parent->title : "-"}}--}}
    {{--                                    </td>--}}
    {{--                                    <td>--}}
    {{--                                        <button type="button" class="btn btn-primary btn-sm">Edit</button>--}}
    {{--                                        <button type="button" class="btn btn-danger btn-sm">Delete</button>--}}
    {{--                                    </td>--}}
    {{--                                </tr>--}}
    {{--                            @endforeach--}}
    {{--                            </tbody>--}}
    {{--                        </table>--}}
    {{--                    </div>--}}
    {{--                    <!-- /.card-body -->--}}
    {{--                </div>--}}
    {{--                <!-- /.card -->--}}
    {{--            </div>--}}
    {{--            <!-- /.col -->--}}
    {{--        </div>--}}
    {{--        <!-- /.row -->--}}
    {{--        </div>--}}
    {{--    </section>--}}
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
                "responsive": true, "lengthChange": false, "autoWidth": false,"ordering": false,
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

        $(".delete-icon").on("click", function () {
            var PermissionId = $(this).data('id');
            $("#delete-form").attr("action", "/permissions/" + PermissionId)
        });

    </script>
    <script>
        function deleteModal(element) {
            var PermissionID = $(element).data('id');

            document.getElementById('delete-form').action = "/permissions/" + PermissionID;
            Swal.fire({
                icon: 'warning',
                title: 'Do you want to delete this permission?',
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
        $(document).ready(function () {
            const element = document.getElementById("example1_filter");
            element.style.float = 'inline-end';
        });
    </script>

@endsection

