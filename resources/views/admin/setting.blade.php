@extends('admin.layout.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 border-white border-bottom">
                    <h1 class="m-0">Setting</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            {{--            <div class="row">--}}
            {{--                <div class="col-12 col-sm-6 col-md-3">--}}
            <div class="row">
                <div >
                    <a href="{{route('landings.edit',\App\Models\Landing::query()->first()->id)}}" type="button"
                       class="btn btn-secondary m-2"> <i></i> Landing Text </a>
                </div>
            <div >
                <a href="{{route('commissions.create')}}" type="button"
                   class="btn btn-secondary m-2"> <i></i> Commission Fee </a>
            </div>
            </div>
                {{--                            <span class="info-box-number">--}}
                {{--                  {{$galleries_count}}--}}
                {{--                </span>--}}
            <!-- /.info-box-content -->
        {{--                </div>--}}
        <!-- /.info-box -->
        {{--            </div>--}}
        {{--                <div class="col-12 col-sm-6 col-md-3">--}}
        {{--                    <div class="info-box">--}}
        {{--                        <span class="info-box-icon elevation-1" style="background-color: #CC8D1D"><i--}}
        {{--                                class="fa fa-palette nav-icon"></i></span>--}}

        {{--                        <div class="info-box-content">--}}
        {{--                            <a href="{{route('artists.index')}}">--}}
        {{--                                <span class="info-box-text">Artists</span>--}}
        {{--                            </a>--}}
        {{--                            <span class="info-box-number">--}}
        {{--                  {{$artists_count}}--}}
        {{--                </span>--}}
        {{--                        </div>--}}
        {{--                        <!-- /.info-box-content -->--}}
        {{--                    </div>--}}
        {{--                    <!-- /.info-box -->--}}
        {{--                </div>--}}
        {{--                <div class="col-12 col-sm-6 col-md-3">--}}
        {{--                    <div class="info-box">--}}
        {{--                        <span class="info-box-icon elevation-1" style="background-color: #CC8D1D"><i--}}
        {{--                                class="fas fa-paint-brush nav-icon"></i></span>--}}

        {{--                        <div class="info-box-content">--}}
        {{--                            <a href="{{route('assets.index')}}">--}}
        {{--                                <span class="info-box-text">Assets</span>--}}
        {{--                            </a>--}}
        {{--                            <span class="info-box-number">--}}
        {{--                  {{$assets_count}}--}}
        {{--                </span>--}}
        {{--                        </div>--}}
        {{--                        <!-- /.info-box-content -->--}}
        {{--                    </div>--}}
        {{--                    <!-- /.info-box -->--}}
        {{--                </div>--}}
        {{--                <div class="col-12 col-sm-6 col-md-3">--}}
        {{--                    <div class="info-box">--}}
        {{--                        <span class="info-box-icon elevation-1" style="background-color: #CC8D1D"><i--}}
        {{--                                class="fa fa-user nav-icon"></i></span>--}}

        {{--                        <div class="info-box-content">--}}
        {{--                            <a href="{{route('users.index')}}">--}}
        {{--                                <span class="info-box-text">Users</span>--}}
        {{--                            </a>--}}
        {{--                            <span class="info-box-number">--}}
        {{--                  {{$users_count}}--}}
        {{--                </span>--}}
        {{--                        </div>--}}
        {{--                        <!-- /.info-box-content -->--}}
        {{--                    </div>--}}
        <!-- /.info-box -->
        </div>
        </div>
    {{--            <div class="row">--}}
    {{--                <!-- Left col -->--}}
    {{--                <div class="col-md-12">--}}
    {{--                    <!-- TABLE: LATEST ORDERS -->--}}
    {{--                    <div class="card">--}}
    {{--                        <div class="card-header border-transparent">--}}
    {{--                            <h3 class="card-title">Latest Orders</h3>--}}

    {{--                            <div class="card-tools">--}}
    {{--                                <button type="button" class="btn btn-tool" data-card-widget="collapse">--}}
    {{--                                    <i class="fas fa-minus"></i>--}}
    {{--                                </button>--}}
    {{--                                <button type="button" class="btn btn-tool" data-card-widget="remove">--}}
    {{--                                    <i class="fas fa-times"></i>--}}
    {{--                                </button>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <!-- /.card-header -->--}}
    {{--                        <div class="card-body p-0">--}}
    {{--                            <div class="table-responsive">--}}
    {{--                                <table class="table m-0">--}}
    {{--                                    <thead>--}}
    {{--                                    <tr>--}}
    {{--                                        <th>Order ID</th>--}}
    {{--                                        <th>Item</th>--}}
    {{--                                        <th>Status</th>--}}
    {{--                                        <th>Popularity</th>--}}
    {{--                                    </tr>--}}
    {{--                                    </thead>--}}
    {{--                                    <tbody>--}}
    {{--                                    <tr>--}}
    {{--                                        <td><a href="pages/examples/invoice.html">OR9842</a></td>--}}
    {{--                                        <td>Call of Duty IV</td>--}}
    {{--                                        <td><span class="badge badge-success">Shipped</span></td>--}}
    {{--                                        <td>--}}
    {{--                                            <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>--}}
    {{--                                        </td>--}}
    {{--                                    </tr>--}}
    {{--                                    <tr>--}}
    {{--                                        <td><a href="pages/examples/invoice.html">OR1848</a></td>--}}
    {{--                                        <td>Samsung Smart TV</td>--}}
    {{--                                        <td><span class="badge badge-warning">Pending</span></td>--}}
    {{--                                        <td>--}}
    {{--                                            <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>--}}
    {{--                                        </td>--}}
    {{--                                    </tr>--}}
    {{--                                    <tr>--}}
    {{--                                        <td><a href="pages/examples/invoice.html">OR7429</a></td>--}}
    {{--                                        <td>iPhone 6 Plus</td>--}}
    {{--                                        <td><span class="badge badge-danger">Delivered</span></td>--}}
    {{--                                        <td>--}}
    {{--                                            <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>--}}
    {{--                                        </td>--}}
    {{--                                    </tr>--}}
    {{--                                    <tr>--}}
    {{--                                        <td><a href="pages/examples/invoice.html">OR7429</a></td>--}}
    {{--                                        <td>Samsung Smart TV</td>--}}
    {{--                                        <td><span class="badge badge-info">Processing</span></td>--}}
    {{--                                        <td>--}}
    {{--                                            <div class="sparkbar" data-color="#00c0ef" data-height="20">90,80,-90,70,-61,83,63</div>--}}
    {{--                                        </td>--}}
    {{--                                    </tr>--}}
    {{--                                    <tr>--}}
    {{--                                        <td><a href="pages/examples/invoice.html">OR1848</a></td>--}}
    {{--                                        <td>Samsung Smart TV</td>--}}
    {{--                                        <td><span class="badge badge-warning">Pending</span></td>--}}
    {{--                                        <td>--}}
    {{--                                            <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>--}}
    {{--                                        </td>--}}
    {{--                                    </tr>--}}
    {{--                                    <tr>--}}
    {{--                                        <td><a href="pages/examples/invoice.html">OR7429</a></td>--}}
    {{--                                        <td>iPhone 6 Plus</td>--}}
    {{--                                        <td><span class="badge badge-danger">Delivered</span></td>--}}
    {{--                                        <td>--}}
    {{--                                            <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>--}}
    {{--                                        </td>--}}
    {{--                                    </tr>--}}
    {{--                                    <tr>--}}
    {{--                                        <td><a href="pages/examples/invoice.html">OR9842</a></td>--}}
    {{--                                        <td>Call of Duty IV</td>--}}
    {{--                                        <td><span class="badge badge-success">Shipped</span></td>--}}
    {{--                                        <td>--}}
    {{--                                            <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>--}}
    {{--                                        </td>--}}
    {{--                                    </tr>--}}
    {{--                                    </tbody>--}}
    {{--                                </table>--}}
    {{--                            </div>--}}
    {{--                            <!-- /.table-responsive -->--}}
    {{--                        </div>--}}
    {{--                        <!-- /.card-body -->--}}
    {{--                        <div class="card-footer clearfix">--}}
    {{--                            <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Order</a>--}}
    {{--                            <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All Orders</a>--}}
    {{--                        </div>--}}
    {{--                        <!-- /.card-footer -->--}}
    {{--                    </div>--}}
    {{--                    <!-- /.card -->--}}
    {{--                </div>--}}
    {{--                <!-- /.col -->--}}
    {{--            </div>--}}
    <!-- /.row -->
        {{--        </div><!--/. container-fluid -->--}}
    </section>
    <!-- /.content -->
@endsection
