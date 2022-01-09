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
            <h3 class="card-title">upload Media</h3>
        </div>

        <div class="form-group">
            @if($type == \App\Models\Gallery::class)
                <label for="contract ">Upload Gallery Logo  <span class="text-danger">*</span></label>
            @elseif($type == \App\Models\Artist::class)
                <label for="contract ">Upload Artist Avatar  <span class="text-danger">*</span></label>
            @elseif($type == \App\Models\User::class)
                <label for="contract ">Upload User Avatar  <span class="text-danger">*</span></label>
            @elseif($type == \App\Models\Asset::class)
                <label for="contract ">Upload Asset Main Picture <span class="text-danger">*</span></label>
            @endif

            <div class="dropzone">
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf

                </form>
            </div>
        </div>

        <div class="card-footer">
            @if($type == \App\Models\Gallery::class)
                <a class="btn btn-primary d-none" id="submitButton" href="{{route('upload.page',['type'=>\App\Models\Gallery::class,'id'=>$id])}}">Next</a>
            @elseif($type == \App\Models\Artist::class)
                <a class="btn btn-primary d-none"  id="submitButton" href="{{route('upload.page',['type'=>\App\Models\Artist::class,'id'=>$id])}}">Next</a>
            @elseif($type == \App\Models\User::class)
                <a class="btn btn-primary d-none" id="submitButton" href="{{route('users.index')}}">Next</a>
            @elseif($type == \App\Models\Asset::class)
                <a class="btn btn-primary d-none" id="submitButton" href="{{route('upload.page',['type'=>\App\Models\Asset::class,'id'=>$id])}}">Next</a>
            @endif
        </div>

    </div>


@endsection

@section('scripts')


    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

    <script>
        const mediaIds = []
        // Dropzone has been added as a global variable.
        const dropzone = new Dropzone("div.dropzone", {
            url: "{{route('uploadFile.main',['mediable_type' => $type, 'mediable_id' => $id])}}",
            autoDiscover: false,
            acceptedFiles: ".jpeg,.jpg,.png",
            // addRemoveLinks: true,
            maxFiles: 1,
            maxFilesize: 3,
            // dictDefaultMessage: '<span class="text-center"><span class="font-lg visible-xs-block visible-sm-block visible-lg-block"><span class="font-lg"> <h4 class="display-inline"> برای آپلود عکس محصول فایل را اینجا بکشید یا کلیک کنید</h4></span>',
            // dictResponseError: 'خطایی در اپلود فایل رخ داده',
            // dictMaxFilesExceeded: 'امکان اپلود فایل دیگر وجود ندارد , فقط یک فایل مجاز است',

            // dictRemoveFile: 'Delete',

            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            init: function () {
                let thisDropzone = this;
                this.on("removedfile", function (file) {
                    console.log(file)
                });




            },
            success: function(file, response)
            {
                console.log('hi')
                console.log(response)
                document.getElementById('submitButton').classList.remove('d-none')
                // const classes = button.classList;
                // const dNoneIdx = classes.indexOf('d-none')
                // classes.splice(dNoneIdx, 1)
                mediaIds.push(response.media_id)

            },

        });
    </script>

@endsection
