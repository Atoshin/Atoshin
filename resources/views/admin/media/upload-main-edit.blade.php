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
                <label for="contract ">Upload Gallery Logo (size: 1200x800-1800x1200-2400x1600-900x600)</label>
            @elseif($type == \App\Models\Artist::class)
                <label for="contract ">Upload Artist Avatar (size: 1200x800-1800x1200-2400x1600-900x600)</label>
            @elseif($type == \App\Models\User::class)
                <label for="contract ">Upload User Avatar (size: 1200x800-1800x1200-2400x1600-900x600)</label>
            @elseif($type == \App\Models\Asset::class)
                <label for="contract ">Upload Asset Main Picture (size: 1200x800-1800x1200-2400x1600-900x600)</label>
            @endif

            <div class="dropzone">
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf

                </form>
            </div>
        </div>

        <div class="card-footer " >
            @if($type == \App\Models\Gallery::class)
                <a id="submitButton" class="btn btn-primary"
                   href="{{route('galleries.edit',$id)}}">Submit</a>
            @elseif($type == \App\Models\Artist::class)
                <a  id="submitButton" class="btn btn-primary"
                   href="{{route('artists.edit',$id)}}">Submit</a>
            @elseif($type == \App\Models\User::class)
                <a id="submitButton" class="btn btn-primary"
                   href="{{route('users.edit',$id)}}">Submit</a>
            @elseif($type == \App\Models\Asset::class)
                <a id="submitButton" class="btn btn-primary"
                   href="{{route('assets.edit',$id)}}">Submit</a>
            @endif
        </div>

    </div>


@endsection

@section('scripts')


    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

    <script>
        const mediaIds = []
        let counter = 1;
        // Dropzone has been added as a global variable.
        const dropzone = new Dropzone("div.dropzone", {
            url: "{{route('uploadFile.main.update',['mediable_type' => $type, 'mediable_id' => $id])}}",
            autoDiscover: false,
            acceptedFiles: ".jpeg,.jpg,.png",
            addRemoveLinks: true,
            maxFiles: 1,
            maxFilesize: 3,
            //dictDefaultMessage: '<span class="text-center"><span class="font-lg visible-xs-block visible-sm-block visible-lg-block"><span class="font-lg"> <h4 class="display-inline"> برای آپلود عکس محصول فایل را اینجا بکشید یا کلیک کنید</h4></span>',
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

                this.on("removedfile", function (file) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        }
                    });
                    $.ajax({
                        url: `/media/delete/main/${file.id}`,
                        method: "delete",
                        success: function (res) {
                            console.log(res)
                        }
                    })
                    counter--;
                });
                @if($type != \App\Models\User::class)
                @if($entity->medias->where('main',true)->first() != null)
                let mockFile = {
                    id:"{{$entity->medias->where('main',true)->first()->id}}",
                    name: "{{substr($entity->medias->where('main',true)->first()->path,13,50)}}",
                    size: "{{\Illuminate\Support\Facades\Storage::size('public/'.substr($entity->medias->where('main',true)->first()->path,8,54))}}"
                };
                thisDropzone.options.addedfile.call(thisDropzone, mockFile);
                thisDropzone.options.thumbnail.call(thisDropzone, mockFile, "{{asset(  $entity->medias->where('main',true)->first()->path)}}");
                console.log(mockFile)
                @endif
                @else

                let mockFile = {
                    name: "{{substr($entity->media->where('mediable_type',$type)->where('mediable_id',$id)->where('main',true)->first()->path,13,50)}}",
                    size: "{{\Illuminate\Support\Facades\Storage::size('public/'.substr($entity->media->where('mediable_type',$type)->where('mediable_id',$id)->where('main',true)->first()->path,8,54))}}"
                };
                thisDropzone.options.addedfile.call(thisDropzone, mockFile);
                thisDropzone.options.thumbnail.call(thisDropzone, mockFile, "{{asset($entity->media->where('mediable_type',$type)->where('mediable_id',$id)->where('main',true)->first()->path)}}");
                @endif




            },
            success: function (file, response) {
                counter++;
                mediaIds.push(response.media_id)


            },

        });
    </script>

@endsection
