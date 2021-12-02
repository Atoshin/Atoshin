@extends('admin.layout.master')
@section('styles')
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
        <form method="post"    action="{{route('contracts.store')}}">
            @csrf
            <div class="card-body">

                <div class="form-group">
                    <label >Contract Number</label>
                    <input type="text" class="form-control" name="contract_number" placeholder="Contract Number">
                </div>

                <div class="form-group">
                    <label for="contract ">Upload Contract Document</label>
                    <div class="dropzone">
                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="file" />
                        </form>
                    </div>
                </div>



            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
{{--                <button type="submit" class="btn btn-default float-right">Cancel</button>--}}
            </div>
        </form>


    </div>


@endsection

@section('scripts')


    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

    <script>
        // Dropzone has been added as a global variable.
        const dropzone = new Dropzone("div.dropzone", {
            url: "/file/post"

        });
    </script>

@endsection
