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
            @if($type == \App\Models\Contract::class)
                <label for="contract ">Upload Contract  <span class="text-danger">*</span></label>
            @elseif($type == \App\Models\User::class)
                <label for="contract ">Upload User Avatar  <span class="text-danger">*</span></label>
            @endif

            <div class="dropzone">
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf

                </form>
            </div>

        </div>

        <div class="card-footer">
            @if($type == \App\Models\Contract::class)
                <a class="btn btn-primary d-none" id="submitButton" href="{{route('assets.index')}}">Next</a>
            @elseif($type == \App\Models\User::class)
                <a class="btn btn-primary d-none" id="submitButton" href="{{route('users.index')}}">Next</a>
            @endif
        </div>


    </div>


@endsection

@section('scripts')


    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

    <script>
        const mediaIds = []
        var maxImageWidth = 1000, maxImageHeight = 1000;
        let counter = 0;
        // Dropzone has been added as a global variable.
        const dropzone = new Dropzone("div.dropzone", {
            url: "{{route('uploadFile.main',['mediable_type' => $type, 'mediable_id' => $id])}}",
            autoDiscover: false,
            acceptedFiles: ".jpeg,.jpg,.png",
            addRemoveLinks: true,
            // autoProcessQueue: false,
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

                var submitButton = document.querySelector("#submitButton");
                myDropzone = this;
                submitButton.addEventListener("click", function (e) {
                    if (counter < 1) {
                        e.preventDefault();
                        alert("Not enough files!");
                    }

                });

                this.on("thumbnail", function(file) {
                    if (file.width === 3/2 * file.height ) {
                        file.rejectDimensions()
                    }
                    else {
                        file.acceptDimensions();
                    }
                });

                this.on("removedfile", function (file) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        }
                    });

                    $.ajax({
                        url: `/media/delete/${file.id}`,
                        method: "delete",
                        success: function (res) {
                            console.log(res)
                        }
                    })
                    counter--;

                });
            },
            success: function(file, response)
            {
                document.getElementById('submitButton').classList.remove('d-none')
                counter++;

                mediaIds.push(response.media_id)

            },

            error: function(file, message, xhr) {
                const error = document.querySelector('#error');
                error.innerHTML = ' <h3>an error occured your file will be deleted from the dropzone shortly </h3>';
                setTimeout(() => {
                    $(file.previewElement).remove();
                    console.log(counter);
                    error.innerHTML = '';
                    location.reload();
                }, 5000)
            },

            accept: function(file, done) {
                file.acceptDimensions = done;
                file.rejectDimensions = function() { done("Image width or height too big."); };
            }

        });
    </script>

@endsection
