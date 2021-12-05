@extends('admin.layout.master')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{$artist->full_name}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        {{--                        <li class="breadcrumb-item"><a href="#">Home</a></li>--}}
                        <li class="breadcrumb-item active"></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="callout callout-info">
                    <h5><i ></i>Bio:</h5>
                    {{$artist->bio}}
                </div>
                <div class="invoice p-3 mb-3">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-12">
                            <h4>
                                <i ></i>
                                <small class="float-right"></small>
                            </h4>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            {{--      <div class="mb-1"><b>Bio:</b> {{$asset->bio}}</div>--}}
                            <address>
                                <div class="mb-1">   <b>Website:</b>  <a href="{{$artist->website}}">{{$artist->website}}</a></div>
                                {{--                795 Folsom Ave, Suite 600<br>--}}
                                <div class="mb-1">   <b> Instagram:</b>  <a href="{{$artist->instagram}}">{{$artist->instagram}}</a></div>
                                <div class="mb-1"> <b>Youtube:</b> <a href="{{$artist->youtube}}">{{$artist->youtube}}</a></div>

                                {{--                Email: info@almasaeedstudio.com--}}
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">

                            <address>
                                <div class="mb-1">   <b>Facebook:</b> <a href="{{$artist->facebook}}">{{$artist->facebook}}</a></div>
                                <div class="mb-1"> <b>Linkedin:</b>  <a href="{{$artist->linkedin}}">{{$artist->linkedin}}</a></div>
                                <div class="mb-1"> <b> Twitter:</b>  <a href="{{$artist->twitter}}">{{$artist->twitter}}</a></div>
                                {{--                                <div class="mb-1"> <b> Royalties Percentage:</b>  {{$asset->royalties_percentage}} <br></div>--}}
{{--                                <div class="mb-1">  <b> Start Date:</b> {{$asset->start_date}}<br></div>--}}
{{--                                <div class="mb-1">  <b> End Date:</b> {{$asset->end_date}}<br></div>--}}
                                {{--                Email: john.doe@example.com--}}
                            </address>
                        </div>
                        <!-- /.col -->
{{--                        <div class="col-sm-4 invoice-col">--}}
{{--                            <div class="mb-1"> <b>creator:</b> {{$asset->gallery->name}}<br></div>--}}
{{--                            <div class="mb-1"> <b>category:</b> {{$asset->category->title}}<br></div>--}}
{{--                            <b>Artist:</b> {{$asset->artist->full_name}}<br>--}}
{{--                            --}}{{--            <b>Account:</b> 968-34567--}}
{{--                        </div>--}}
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Table row -->
                    <!--              <div class="row">-->
                    <!--                <div class="col-12 table-responsive">-->
                    <!--                  <table class="table table-striped">-->
                    <!--                    <thead>-->
                    <!--                    <tr>-->
                    <!--                      <th>Qty</th>-->
                    <!--                      <th>Product</th>-->
                    <!--                      <th>Serial #</th>-->
                    <!--                      <th>Description</th>-->
                    <!--                      <th>Subtotal</th>-->
                    <!--                    </tr>-->
                    <!--                    </thead>-->
                    <!--                    <tbody>-->
                    <!--                    <tr>-->
                    <!--                      <td>1</td>-->
                    <!--                      <td>Call of Duty</td>-->
                    <!--                      <td>455-981-221</td>-->
                    <!--                      <td>El snort testosterone trophy driving gloves handsome</td>-->
                    <!--                      <td>$64.50</td>-->
                    <!--                    </tr>-->
                    <!--                    <tr>-->
                    <!--                      <td>1</td>-->
                    <!--                      <td>Need for Speed IV</td>-->
                    <!--                      <td>247-925-726</td>-->
                    <!--                      <td>Wes Anderson umami biodiesel</td>-->
                    <!--                      <td>$50.00</td>-->
                    <!--                    </tr>-->
                    <!--                    <tr>-->
                    <!--                      <td>1</td>-->
                    <!--                      <td>Monsters DVD</td>-->
                    <!--                      <td>735-845-642</td>-->
                    <!--                      <td>Terry Richardson helvetica tousled street art master</td>-->
                    <!--                      <td>$10.70</td>-->
                    <!--                    </tr>-->
                    <!--                    <tr>-->
                    <!--                      <td>1</td>-->
                    <!--                      <td>Grown Ups Blue Ray</td>-->
                    <!--                      <td>422-568-642</td>-->
                    <!--                      <td>Tousled lomo letterpress</td>-->
                    <!--                      <td>$25.99</td>-->
                    <!--                    </tr>-->
                    <!--                    </tbody>-->
                    <!--                  </table>-->
                    <!--                </div>-->
                    <!--                &lt;!&ndash; /.col &ndash;&gt;-->
                    <!--              </div>-->
                    <!-- /.row -->

                    <!--              <div class="row">-->
                    <!--                &lt;!&ndash; accepted payments column &ndash;&gt;-->
                    <!--                <div class="col-6">-->
                    <!--                  <p class="lead">Payment Methods:</p>-->
                    <!--                  <img src="../../dist/img/credit/visa.png" alt="Visa">-->
                    <!--                  <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">-->
                    <!--                  <img src="../../dist/img/credit/american-express.png" alt="American Express">-->
                    <!--                  <img src="../../dist/img/credit/paypal2.png" alt="Paypal">-->

                    <!--                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">-->
                    <!--                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem-->
                    <!--                    plugg-->
                    <!--                    dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.-->
                    <!--                  </p>-->
                    <!--                </div>-->
                    <!--                &lt;!&ndash; /.col &ndash;&gt;-->
                    <!--                <div class="col-6">-->
                    <!--                  <p class="lead">Amount Due 2/22/2014</p>-->

                    <!--                  <div class="table-responsive">-->
                    <!--                    <table class="table">-->
                    <!--                      <tr>-->
                    <!--                        <th style="width:50%">Subtotal:</th>-->
                    <!--                        <td>$250.30</td>-->
                    <!--                      </tr>-->
                    <!--                      <tr>-->
                    <!--                        <th>Tax (9.3%)</th>-->
                    <!--                        <td>$10.34</td>-->
                    <!--                      </tr>-->
                    <!--                      <tr>-->
                    <!--                        <th>Shipping:</th>-->
                    <!--                        <td>$5.80</td>-->
                    <!--                      </tr>-->
                    <!--                      <tr>-->
                    <!--                        <th>Total:</th>-->
                    <!--                        <td>$265.24</td>-->
                    <!--                      </tr>-->
                    <!--                    </table>-->
                    <!--                  </div>-->
                    <!--                </div>-->
                    <!--                &lt;!&ndash; /.col &ndash;&gt;-->
                    <!--              </div>-->
                    <!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <!--              <div class="row no-print">-->
                    <!--                <div class="col-12">-->
                    <!--                  <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>-->
                    <!--                  <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit-->
                    <!--                    Payment-->
                    <!--                  </button>-->
                    <!--                  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">-->
                    <!--                    <i class="fas fa-download"></i> Generate PDF-->
                    <!--                  </button>-->
                    <!--                </div>-->
                    <!--              </div>-->
                </div>

@endsection
