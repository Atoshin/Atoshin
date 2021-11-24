@extends('admin.layout.master')
@section('content')
    {{--@foreach()--}}
    {{--<div class="card-body table-responsive p-0">--}}
    {{--    --}}{{--<button type="button" href="{{route('categories.create')}}" class="btn btn-secondary btn-sm">Create</button>--}}
    {{--    <a href="{{route('categories.create')}}" class="btn btn-secondary btn-sm">Create</a>--}}
    {{--    <table class="table table-striped table-valign-middle">--}}
    {{--        <thead>--}}
    {{--        <tr>--}}
    {{--            <th>Title</th>--}}
    {{--            <th>Parent category</th>--}}
    {{--            --}}{{--<th>Sales</th>--}}
    {{--            <th>More</th>--}}
    {{--        </tr>--}}
    {{--        </thead>--}}
    {{--        <tbody>--}}
    {{--        @foreach($categories as $category)--}}
    {{--            <tr>--}}
    {{--                <td>--}}
    {{--                    {{$category->title}}--}}
    {{--                </td>--}}
    {{--                <td>--}}
    {{--                    {{$category->parent ? $category->parent->title : "-"}}--}}
    {{--                </td>--}}
    {{--                <td>--}}
    {{--                    --}}{{--<a href="#" class="text-muted">--}}
    {{--                        --}}{{--<i class="fas fa-search"></i>--}}
    {{--                    --}}{{--</a>--}}
    {{--                    <button type="button" class="btn btn-primary btn-sm">Edit</button>--}}
    {{--                    <button type="button" class="btn btn-danger btn-sm">Delete</button>--}}
    {{--                </td>--}}
    {{--            </tr>--}}
    {{--            @endforeach--}}
    {{--        </tbody>--}}
    {{--    </table>--}}
    {{--</div>--}}


    {{--<section class="content-header">--}}
    {{--    <div class="container-fluid">--}}
    {{--        <div class="row mb-2">--}}
    {{--            <div class="col-sm-6">--}}
    {{--                <h1>DataTables</h1>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div><!-- /.container-fluid -->--}}
    {{--</section>--}}

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="card col-sm-12">
                    <div class="card-header" style="display: inline;">
                        <div>
                            <h3 class="card-title">Categories</h3>
                        </div>
                        <div style="float: inline-end ">
                            <a href="{{route('categories.create')}}" class="btn btn-secondary btn-sm">Create</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Parent category</th>
                                <th>More</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>
                                        {{$category->title}}
                                    </td>
                                    <td>
                                        {{$category->parent ? $category->parent->title : "-"}}
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm">Edit</button>
                                        <button type="button" class="btn btn-danger btn-sm">Delete</button>
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
        // const element = document.getElementById("example1_filter");
    </script>
@endsection

