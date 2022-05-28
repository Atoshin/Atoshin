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
                <label for="contract ">Upload Gallery Large Picture (size:1120x460)<span class="text-danger">*</span></label>

            <div class="dropzone">
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf

                </form>
            </div>
            <div class="bg bg-danger" id="error"></div>
        </div>

        <div class="card-footer">
            <a class="btn btn-primary d-none" id="submitButton" href="{{route('videoLink.index', ['type'=>\App\Models\Gallery::class ,'id'=>$gallery_id])}}">Next</a>
        </div>

    </div>


@endsection

@section('scripts')


    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

    <script>
        const mediaIds = []
        var maxImageWidth = 1120, maxImageHeight = 460;
        let counter = 0;
        // Dropzone has been added as a global variable.
        const dropzone = new Dropzone("div.dropzone", {
            url: "{{route('uploadFile.gallery.large',['gallery_id' => $gallery_id])}}",
            autoDiscover: false,
            acceptedFiles: ".jpeg,.jpg,.png",
            addRemoveLinks: true,
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

                submitButton.addEventListener("click", function (e) {
                    if (counter < 1) {
                        e.preventDefault();
                        alert("Not enough files!");
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
                    console.log(counter)
                });
                this.on("thumbnail", function(file) {
                    if (file.width !== maxImageWidth && file.height !== maxImageHeight ) {
                        file.rejectDimensions()
                        counter++;
                        console.log(counter);
                    }
                    else {
                        file.acceptDimensions();
                    }
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
