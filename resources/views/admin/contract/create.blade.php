@extends('admin.layout.master')
@section('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link
        rel="stylesheet"
        href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css"
        type="text/css"
    />


@endsection
@section('content')

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Add Contract</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post"  id="myform"  action="{{route('contracts.store')}}">
            @csrf
            <div class="card-body">

                <div class="form-group">
                    <label >Contract Number</label>
                    <input type="text" class="form-control" name="contract_number" placeholder="Contract Number">
                    @error('contract_number')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <input type="hidden" name="media_id" id="media_id_input">
                <input type="hidden" name="asset_id" id="asset_id_input" value="{{$asset_id}}">






            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" id="btnSubmit" class="btn btn-primary">Submit</button>
{{--                <button type="submit" class="btn btn-default float-right">Cancel</button>--}}
            </div>
        </form>



    </div>


@endsection
@section('scripts')
<script>
    $("#myform").on('submit',function (){
        $("#btnSubmit").attr("disabled", true);
    });

</script>
@endsection


