@extends('admin.layout.master')
@section('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link
        rel="stylesheet"
        href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css"
        type="text/css"
    />

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">


@endsection
@section('content')

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">upload Video Picture</h3>
        </div>

        <div class="form-group">
                <div class="m-1">
                    <div class="row text-warning ml-2 mt-2">
                        <i class="material-icons mr-1">warning</i>
                        <p>Note that all media sizes should have the ratio of 3:2 e.g.
                            1200x800, 1800x1200, 2400x1600, 900x600</p>
                    </div>
                </div>

            <div class="dropzone m-1">
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf

                </form>
            </div>
            <div class="alert alert-danger m-1 d-none" id="error"></div>
        </div>


        <div class="card-footer">
            <a class="btn btn-primary d-none" id="submitButton" href="{{route('videoLink.index',['type'=>\App\Models\Gallery::class,'id'=>$gallery_id])}}">Submit</a>

        </div>


    </div>


@endsection

@section('scripts')


    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

    <script>
        const mediaIds = []
        let counter = {{$videoLink->media()->count()}};
        var maxImageWidth = 1000, maxImageHeight = 1000;
        // Dropzone has been added as a global variable.
        const dropzone = new Dropzone("div.dropzone", {
            url: "{{route('uploadFile.video',['mediable_type' => $type, 'mediable_id' => $id,'gallery_id'=>$gallery_id])}}",
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

                var submitButton = document.querySelector("#submitButton");

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

                });

                @if($videoLink->media != null)
                document.getElementById('submitButton').classList.remove('d-none');
                let mockFile = {
                    id:"{{$videoLink->media->id}}",
                    name: "{{substr($videoLink->media->path,13,50)}}",
                    size: "{{\Illuminate\Support\Facades\Storage::size('public/'.substr($videoLink->media->path,8,54))}}"
                };
                thisDropzone.options.addedfile.call(thisDropzone, mockFile);
                thisDropzone.options.thumbnail.call(thisDropzone, mockFile, "{{asset(  $videoLink->media->path)}}");
                console.log(mockFile)
                @endif
            },
            success: function(file, response)
            {
                @if($type != \App\Models\User::class and $type != \App\Models\Auction::class)
                if (response.error == 'size_error') {
                    const error = document.querySelector('#error');
                    error.classList.remove('d-none');
                    error.innerHTML = ` <div class="row"><i class="material-icons mr-1">error</i> <strong>Error:</strong> <span class="ml-1">the media dimension ratio must be 3:2</span></div>`;
                    setTimeout(() => {
                        $(file.previewElement).remove();
                        error.classList.add('d-none');
                        error.innerHTML = '';

                    }, 5000)
                }
                @endif


                document.getElementById('submitButton').classList.remove('d-none');
                counter++;
                mediaIds.push(response.media_id)

            },

            error: function(file, message, xhr) {
                const error = document.querySelector('#error');
                error.classList.remove('d-none');
                error.innerHTML = ` <div class="row"><i class="material-icons mr-1">error</i> <strong>Error:</strong> <span class="ml-1">${message}</span></div>`;
                setTimeout(() => {
                    $(file.previewElement).remove();
                    error.innerHTML = '';
                    error.classList.add('d-none')
                }, 5000)
            },


        });
    </script>

@endsection
