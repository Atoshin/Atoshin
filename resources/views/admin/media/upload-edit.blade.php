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
            <label for="contract ">Upload Media (size: 1200x800-1800x1200-2400x1600-900x600)</label>
            <div class="dropzone">
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf

                </form>
            </div>
        </div>

        <div class="card-footer">
            @if($type == \App\Models\Gallery::class)
                <a id="submitButton" class="btn btn-primary"
                   href="{{route('galleries.edit',$id)}}">Submit</a>
            @elseif($type == \App\Models\Artist::class)
                <a id="submitButton" class="btn btn-primary"
                   href="{{route('artists.edit',$id)}}">Submit</a>
            @elseif($type == \App\Models\User::class)
                <a id="submitButton" class="btn btn-primary"
                   href="{{route('users.edit',$id)}}">Submit</a>
            @elseif($type == \App\Models\Contract::class)
                <a id="submitButton" class="btn btn-primary" href="{{route('redirect','assets.index')}}">Submit</a>
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
        let counter = {{$entity->medias->where('main',false)->count()}};
        console.log(counter);
        // Dropzone has been added as a global variable.
        const dropzone = new Dropzone("div.dropzone", {
            url: "{{route('uploadFile.update',['mediable_type' => $type, 'mediable_id' => $id])}}",
            autoDiscover: false,
            acceptedFiles: ".jpeg,.jpg,.png",
            addRemoveLinks: true,
            maxFiles: 10,
            maxFilesize: 3,
            // dictDefaultMessage: '<span class="text-center"><span class="font-lg visible-xs-block visible-sm-block visible-lg-block"><span class="font-lg"> <h4 class="display-inline"> برای آپلود عکس محصول فایل را اینجا بکشید یا کلیک کنید</h4></span>',
            // dictResponseError: 'خطایی در اپلود فایل رخ داده',
            // dictMaxFilesExceeded: 'امکان اپلود فایل دیگر وجود ندارد , فقط یک فایل مجاز است',

            // dictRemoveFile: 'Delete',
            dictCancelUpload: 'Cancel upload',
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            init: function () {
                let thisDropzone = this;

                var submitButton = document.querySelector("#submitButton");
                submitButton.addEventListener("click", function (e) {
                    if (counter < 4) {
                        e.preventDefault();
                        alert("Not enough files!");
                    }

                });



                this.on("removedfile", function (file) {
                    console.log(file)
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

                @foreach($entity->medias as $index=>$file)
                @if(!$file->main && !$file->gallery_large_picture)
                let mockFile{{$index}} = {id: {{$file->id}}, name: "{{substr($file->path,13,50)}}", size: "{{\Illuminate\Support\Facades\Storage::size('public/'.substr($file->path,8,54))}}"};
                thisDropzone.options.addedfile.call(thisDropzone, mockFile{{$index}});
                thisDropzone.options.thumbnail.call(thisDropzone, mockFile{{$index}}, "{{asset(  $file->path)}}");
                mediaIds.push({{$file->id}});
                @endif
                @endforeach


            },
            success: function(file, response)
            {
                {{--let thisDropzone = this;--}}
                {{--thisDropzone.options.addedfile.call(thisDropzone, file);--}}
                {{--thisDropzone.options.thumbnail.call(thisDropzone, mockFile{{$index}}, "{{asset($file->path)}}");--}}
                counter++;
                console.log(counter)
                mediaIds.push(response.media_id)
            },



        });
    </script>

@endsection
