@extends('admin.layout.master')
@section('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link
        rel="stylesheet"
        href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css"
        type="text/css"
    />

    <link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet"/>

    <style>
        button,
        button::after {
            padding: 16px 20px;
            font-size: 18px;
            background: linear-gradient(45deg, transparent 5%, #781D42 5%);
            border: 0;
            color: #fff;
            letter-spacing: 3px;
            line-height: 1;
            box-shadow: 6px 0px 0px #A3423C;
            outline: transparent;
            position: relative;
        }

        button::after {
            --slice-0: inset(50% 50% 50% 50%);
            --slice-1: inset(80% -6px 0 0);
            --slice-2: inset(50% -6px 30% 0);
            --slice-3: inset(10% -6px 85% 0);
            --slice-4: inset(40% -6px 43% 0);
            --slice-5: inset(80% -6px 5% 0);
            content: "crop";
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 3%, #A3423C 3%, #A3423C 5%, #781D42 5%);
            text-shadow: -3px -3px 0px #f8f005, 3px 3px 0px #00e6f6;
            clip-path: var(--slice-0);
        }

        button:hover::after {
            animation: 1s glitch;
            animation-timing-function: steps(2, end);
        }

        @keyframes glitch {
            0% {
                clip-path: var(--slice-1);
                transform: translate(-20px, -10px);
            }

            10% {
                clip-path: var(--slice-3);
                transform: translate(10px, 10px);
            }

            20% {
                clip-path: var(--slice-1);
                transform: translate(-10px, 10px);
            }

            30% {
                clip-path: var(--slice-3);
                transform: translate(0px, 5px);
            }

            40% {
                clip-path: var(--slice-2);
                transform: translate(-5px, 0px);
            }

            50% {
                clip-path: var(--slice-3);
                transform: translate(5px, 0px);
            }

            60% {
                clip-path: var(--slice-4);
                transform: translate(5px, 10px);
            }

            70% {
                clip-path: var(--slice-2);
                transform: translate(-10px, 10px);
            }

            80% {
                clip-path: var(--slice-5);
                transform: translate(20px, -10px);
            }

            90% {
                clip-path: var(--slice-1);
                transform: translate(-10px, 0px);
            }

            100% {
                clip-path: var(--slice-1);
                transform: translate(0);
            }
        }
    </style>



@endsection
@section('content')

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">upload Media </h3>
            <div class="float-right">

                @if($edit == 0)
                    <a href="{{route('galleries.edit',$id)}}" class="btn btn-outline-info">
                    <span class="row">
                         <i class="material-icons">arrow_back</i>
                            Back
                    </span>

                    </a>
                @endif
            </div>

        </div>

        <div class="form-group m-1">
            <div class="m-1">

                @if($type != \App\Models\User::class and $type!= \App\Models\Auction::class and $type!= \App\Models\Contract::class)
                    <div class="row text-warning ml-2">
                        <i class="material-icons mr-1">warning</i>
                        <p>Note that all media sizes should have the ratio of 3:2 e.g.
                            1200x800-1800x1200-2400x1600-900x600</p>
                    </div>
                @endif
                @if($type == \App\Models\Gallery::class)
                    <div class="row text-warning ml-2">
                        <i class="material-icons mr-1">warning</i>
                        <p>Gallery large picture should be 1120x460</p>
                    </div>

                    <div class="row text-warning ml-2">
                        <i class="material-icons mr-1">warning</i>
                        <p>please note that each media cannot be either main, homepage picture
                            or gallery large picture at the same time.</p>
                    </div>

                @endif
            </div>

            <div class="dropzone m-2 ">

                <form action="" method="post" enctype="multipart/form-data">
                    @csrf

                </form>
            </div>
            <div class="alert alert-danger d-none m-1" id="error"></div>


        </div>


        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="card col-sm-12 mx-2">
                        <div class="card-header">
                            <h2 class="card-title"><b>Media</b></h2>
                            <br>


                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Photo</th>
                                    <th>Name</th>

                                    @if($type == \App\Models\Gallery::class)
                                        <th>show in homepage</th>
                                    @endif
                                    @if($type == \App\Models\Gallery::class)
                                        <th>Logo</th>
                                    @elseif($type == \App\Models\Artist::class)
                                        <th>Avatar</th>
                                    @elseif($type == \App\Models\User::class or $type == \App\Models\Auction::class)
                                    @elseif($type == \App\Models\Contract::class)
                                    @elseif($type == \App\Models\Asset::class)
                                        <th>main</th>
                                    @endif
                                    @if($type == App\Models\Gallery::class)
                                        <th>gallery large picture</th>
                                    @endif
                                    <th>operations</th>
                                </tr>
                                </thead>

                                <tbody id="medias-table">
                                @foreach($medias->sortByDesc('created_at') as $index=>$media)
                                    @if($media->mime_type == 'image/png' or $media->mime_type == 'image/jpeg' or $media->mime_type == 'image/jpg')
                                    <tr>
                                        <td>
                                            <a target="_blank" href="{{env('APP_URL'). '/'.$media->path}}">

                                                <img src="{{asset($media->path)}}" class="avatar" alt="" width="100"
                                                     height="100"/>

                                            </a>

                                        </td>
                                        <td><a target="_blank"
                                               href="{{env('APP_URL') . '/'.$media->path}}">{{substr($media->path,13,50)}}</a>
                                        </td>

                                        {{--                                    <td>{{$gallery->wallet ? $gallery->wallet->wallet_address : '-'}}</td>--}}
                                        @if($type == \App\Models\Gallery::class)
                                            <td>

                                                <form action="{{route('homepage.media',$media->id)}}" method="post">
                                                    @csrf

                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               @if($media->homeapage_picture == true) checked
                                                               @endif id="customSwitch-{{$index}}"
                                                               onchange="submitForm(event)">
                                                        <label class="custom-control-label"
                                                               for="customSwitch-{{$index}}"></label>
                                                    </div>
                                                </form>
                                            </td>
                                        @endif

                                        @if($type!=\App\Models\User::class and $type != \App\Models\Auction::class and $type != \App\Models\Contract::class)
                                            <td>
                                                <form action="{{route('main.media',$media->id)}}" method="post">
                                                    @csrf
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               @if($media->main == true) checked
                                                               @endif id="mainSwitch-{{$index}}"
                                                               onchange="submitForm(event)">
                                                        <label class="custom-control-label"
                                                               for="mainSwitch-{{$index}}"></label>
                                                    </div>
                                                </form>
                                            </td>
                                        @endif

                                        @if($type == \App\Models\Gallery::class)
                                            <td>
                                                <form action="{{route('large.media',$media->id)}}" method="post">
                                                    @csrf
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               @if($media->gallery_large_picture == true) checked
                                                               @endif id="largeSwitch-{{$index}}"
                                                               onchange="submitForm(event)">
                                                        <label class="custom-control-label"
                                                               for="largeSwitch-{{$index}}"></label>
                                                    </div>
                                                </form>
                                            </td>
                                        @endif
                                        <td>
                                            <div class="m-1">
                                                <button type="button"
                                                        onclick="deleteModal(this)"
                                                        data-id="{{$media->id}}"
                                                        class="btn btn-danger "><i
                                                        class="fa fa-trash "></i>delete
                                                </button>
                                            </div>
                                        </td>


                                    </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->


            <form action="" id="delete-form" method="POST">
                @method('delete')
                @csrf
            </form>

        </section>

        <div class="card-footer">
            @if($edit == 1)
                @if($type == \App\Models\Gallery::class)
                    <button class="btn btn-primary " id="submitButton"
                            onclick="checkCheckboxes(event, '{{route('galleries.index', ['type'=>$type ,'id'=>$id])}}')">
                        Save
                    </button>
                @elseif($type == \App\Models\Asset::class)

                    <button class="btn btn-primary " id="submitButton"
                            onclick="checkCheckboxes(event, '{{route('assets.index', ['type'=>$type ,'id'=>$id])}}')">
                        Next
                    </button>

                @elseif($type == \App\Models\Artist::class)
                    <button class="btn btn-primary " id="submitButton"
                            onclick="checkCheckboxes(event, '{{route('artists.index', ['type'=>$type ,'id'=>$id])}}')">
                        Next
                    </button>
                @elseif($type == \App\Models\User::class)
                    <a href="{{route('users.index')}}" class="btn btn-primary">Save</a>
                @elseif($type == \App\Models\Auction::class)
                    @php
                        $auction = \App\Models\Auction::query()->find($id);
                        $artist = $auction->artist;
                    @endphp
                    <a class="btn btn-primary" href="{{route('auctions.index',$artist->id)}}">Save</a>
                @elseif($type == \App\Models\Contract::class)
                    @php
                        $contract = \App\Models\Contract::query()->find($id);
                        $asset = $contract->asset;
                    @endphp
                    <a class="btn btn-primary " id="submitButton"
                       href="{{route('contracts.index', $asset->id)}}">Save</a>
                @endif
            @elseif($edit == 0)

                @if($type == \App\Models\User::class)
                    <a href="{{route('users.index')}}" class="btn btn-primary">Save</a>
                @elseif($type == \App\Models\Auction::class)
                    @php
                        $auction = \App\Models\Auction::query()->find($id);
                        $artist = $auction->artist;
                    @endphp
                    <a class="btn btn-primary" href="{{route('auctions.index',$artist->id)}}">Save</a>
                @elseif($type == \App\Models\Contract::class)
                    @php
                        $contract = \App\Models\Contract::query()->find($id);
                        $asset = $contract->asset;
                    @endphp
                    <a class="btn btn-primary " id="submitButton"
                       href="{{route('contracts.index', $asset->id)}}">Save</a>
                @else
                    <button class="btn btn-primary " id="submitButton"
                            onclick="checkCheckboxes(event, '{{route('videoLink.index', ['type'=>$type ,'id'=>$id])}}')">
                        Save
                    </button>
                @endif

            @endif

        </div>


    </div>


@endsection

@section('scripts')


    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script src="https://unpkg.com/cropperjs"></script>

    <script>
        const mediaIds = []

        // Dropzone has been added as a global variable.
        const dropzone = new Dropzone("div.dropzone", {
            dictDefaultMessage: "Put your custom message here",
            url: "{{route('uploadFile',['mediable_type' => $type, 'mediable_id' => $id])}}",
            autoDiscover: false,
            acceptedFiles: ".jpeg,.jpg,.png",
            // addRemoveLinks: true,
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


                myDropzone = this;


                this.on("thumbnail", function (file) {

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
                        }
                    })

                });


            },
            transformFile: function (file, done) {


                var myDropZone = this;
                // Create the image editor overlay
                var editor = document.createElement('div');
                editor.style.position = 'absolute';
                editor.style.left = 0;
                editor.style.right = 0;
                editor.style.top = 0;
                editor.style.bottom = 0;
                editor.style.zIndex = 9999;
                editor.style.backgroundColor = '#000';
                document.body.appendChild(editor);

                // Create confirm button at the top left of the viewport
                var buttonConfirm = document.createElement('button');
                buttonConfirm.style.position = 'absolute';
                buttonConfirm.style.fontSize = '18px';
                buttonConfirm.style.right = '10px';
                buttonConfirm.style.top = '10px';
                buttonConfirm.style.zIndex = 9999;
                buttonConfirm.textContent = 'crop';
                editor.appendChild(buttonConfirm);
                buttonConfirm.addEventListener('click', function () {
                    // Get the canvas with image data from Cropper.js
                    var canvas = cropper.getCroppedCanvas({
                    });
                    // Turn the canvas into a Blob (file object without a name)
                    canvas.toBlob(function (blob) {
                        // Return the file to Dropzone
                        // Create a new Dropzone file thumbnail
                        myDropZone.createThumbnail(
                            blob,
                            myDropZone.options.thumbnailWidth,
                            myDropZone.options.thumbnailHeight,
                            myDropZone.options.thumbnailMethod,
                            false,
                            function (dataURL) {

                                // Update the Dropzone file thumbnail
                                myDropZone.emit('thumbnail', file, dataURL);
                                // Return the file to Dropzone
                                done(blob);
                            });
                    });
                    // Remove the editor from the view
                    document.body.removeChild(editor);

                });

                let buttonCenter = document.createElement('button');
                buttonCenter.style.position = 'absolute';
                buttonCenter.style.fontSize = '18px';
                buttonCenter.style.right = '520px';
                buttonCenter.style.top = '10px';
                buttonCenter.style.zIndex = 9999;
                buttonCenter.textContent = 'center';
                editor.appendChild(buttonCenter);

                @if($type == \App\Models\Gallery::class)
                let buttonLarge = document.createElement('button');
                buttonLarge.style.position = 'absolute';
                buttonLarge.style.fontSize = '18px';
                buttonLarge.style.right = '120px';
                buttonLarge.style.top = '10px';
                buttonLarge.style.zIndex = 9999;
                buttonLarge.textContent = 'Large picture';
                editor.appendChild(buttonLarge);

                let buttonRatio = document.createElement('button');
                buttonRatio.style.position = 'absolute';
                buttonRatio.style.fontSize = '18px';
                buttonRatio.style.right = '320px';
                buttonRatio.style.top = '10px';
                buttonRatio.style.zIndex = 9999;
                buttonRatio.textContent = '3:2 Image';
                editor.appendChild(buttonRatio);
                @endif

                // Create an image node for Cropper.js
                var image = new Image();
                image.src = URL.createObjectURL(file);
                editor.appendChild(image);
                let options = {};
                let cropper = {};
                // Create Cropper.js
                @if($type == \App\Models\Gallery::class or $type == \App\Models\Artist::class or $type == \App\Models\Asset::class)
                 options = {
                    aspectRatio: 3 / 2,
                    preview: '.img-preview',

                    ready: function (e) {

                    },
                    cropstart: function (e) {

                    },
                    cropmove: function (e) {

                    },
                    cropend: function (e) {

                    },
                    cropBoxResizable: true,
                    data:{ //define cropbox size
                        width: 240,
                        height:  90,
                    },
                    crop: function (e) {
                        var data = e.detail;

                        dataX.value = Math.round(data.x);
                        dataY.value = Math.round(data.y);
                        dataHeight.value = Math.round(data.height);
                        dataWidth.value = Math.round(data.width);
                        dataRotate.value = typeof data.rotate !== 'undefined' ? data.rotate : '';
                        dataScaleX.value = typeof data.scaleX !== 'undefined' ? data.scaleX : '';
                        dataScaleY.value = typeof data.scaleY !== 'undefined' ? data.scaleY : '';
                    },
                    zoom: function (e) {

                    }
                };
               cropper = new Cropper(image, options);
                @else
                options = {
                    aspectRatio: NaN,
                    preview: '.img-preview',

                    ready: function (e) {

                    },
                    cropstart: function (e) {

                    },
                    cropmove: function (e) {

                    },
                    cropend: function (e) {

                    },
                    cropBoxResizable: true,
                    data:{ //define cropbox size
                        width: 240,
                        height:  160,
                    },
                    crop: function (e) {
                        var data = e.detail;

                        dataX.value = Math.round(data.x);
                        dataY.value = Math.round(data.y);
                        dataHeight.value = Math.round(data.height);
                        dataWidth.value = Math.round(data.width);
                        dataRotate.value = typeof data.rotate !== 'undefined' ? data.rotate : '';
                        dataScaleX.value = typeof data.scaleX !== 'undefined' ? data.scaleX : '';
                        dataScaleY.value = typeof data.scaleY !== 'undefined' ? data.scaleY : '';
                    },
                    zoom: function (e) {

                    }
                };
                cropper = new Cropper(image, options);
                @endif
                @if($type == \App\Models\Gallery::class)
                buttonRatio.addEventListener('click', ()=> {
                    let contData = cropper.getContainerData();
                    options.aspectRatio = 3/2;
                    options.data.width = 900;
                    options.data.height = 600;
                    options.cropBoxResizable = true ;
                    cropper.destroy();
                    cropper = new Cropper(image, options);


                    // cropper.setCropBoxData({ height: contData.height, width: contData.width  })
                    // cropper.setCropBoxResizable(false) ;
                });

                buttonLarge.addEventListener('click', ()=> {
                    let contData = cropper.getContainerData();
                    options.aspectRatio = NaN;
                    options.data.width = 1120;
                    options.data.height = 460;
                    options.cropBoxResizable = false ;
                    cropper.destroy();
                    cropper = new Cropper(image, options);


                    // cropper.setCropBoxData({ height: contData.height, width: contData.width  })
                    // cropper.setCropBoxResizable(false) ;
                });
                @endif

                buttonCenter.addEventListener('click', ()=> {
                    cropper.moveTo(0,0)
                    // cropper.destroy();
                    // cropper = new Cropper(image, options);
                });


            },
            success: function (file, response) {

                if (response.error == 'exceeded_media_number_limit') {
                    const error = document.querySelector('#error');
                    error.classList.remove('d-none');
                    @if($type == \App\Models\User::class)
                        error.innerHTML = ` <div class="row"><i class="material-icons mr-1">error</i> <strong>Error:</strong> <span class="ml-1">Only one media can be uploaded as user Avatar</span></div>`;
                    @elseif($type == \App\Models\Auction::class)
                        error.innerHTML = ` <div class="row"><i class="material-icons mr-1">error</i> <strong>Error:</strong> <span class="ml-1">Only one media can be uploaded as Auction media</span></div>`;
                    @elseif($type == \App\Models\Contract::class)
                        error.innerHTML = ` <div class="row"><i class="material-icons mr-1">error</i> <strong>Error:</strong> <span class="ml-1">Only one media can be uploaded as Contract media</span></div>`;
                    @endif
                    setTimeout(() => {
                        $(file.previewElement).remove();
                        error.classList.add('d-none');
                        error.innerHTML = '';

                    }, 5000)
                }


                @if($type != \App\Models\User::class and $type != \App\Models\Auction::class and $type != \App\Models\Contract::class)
                if (response.error == 'size_error') {
                    const error = document.querySelector('#error');
                    error.classList.remove('d-none');
                    error.innerHTML = ` <div class="row"><i class="material-icons mr-1">error</i> <strong>Error:</strong> <span class="ml-1">the media dimension ratio must be 3:2. your picture size is ${response.width}x${response.height}.ratio ${response.ratio}</span></div>`;
                    setTimeout(() => {
                        $(file.previewElement).remove();
                        error.classList.add('d-none');
                        error.innerHTML = '';

                    }, 5000)
                }
                @endif
                console.log(response.error)
                const tbody = $('#medias-table');
                const media = response.medias[response.medias.length - 1]

                const rows = document.getElementById('medias-table').children;
                let counter;


                @if($type == \App\Models\Gallery::class)
                if (rows[0].innerHTML === '<td valign="top" colspan="6" class="dataTables_empty">No data available in table</td>') {
                    rows[0].remove();
                }
                counter = rows.length;
                let check = '';
                console.log(file.width,file.height)
                if(response.large_flag === true )
                {
                    check = 'checked';
                }

                tbody.prepend(`<tr>
                    <td>
                        <a target="_blank" href="{{env('APP_URL')}}/${media.path}">
                            <img src="{{env('APP_URL')}}/${media.path}" class="avatar" alt="" width="100"
                                 height="100"/>
                        </a>
                    </td>
                    <td><a target="_blank"
                           href="{{env('APP_URL')}}/${media.path}">${media.path.slice(13, 57)}</a>
                    </td>

                    <td>
                        <form action="{{env('APP_URL')}}/media/home/page/${media.id}" method="post">
                            @csrf
                <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input"

                       id="customSwitch-${counter}"
                                   onchange="submitForm(event)"/>
                            <label class="custom-control-label"
                                   for="customSwitch-${counter}"></label>
                            </div>
                        </form>
                    </td>
                    <td>
                        <form action="{{env('APP_URL')}}/media/main/${media.id}" method="post">
                           @csrf
                <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input"

                     id="mainSwitch-${counter}"
                     onchange="submitForm(event)">
                <label class="custom-control-label"
                    for="mainSwitch-${counter}"></label>
                            </div>
                        </form>
                    </td>

                    <td>
                                                <form action="{{env('APP_URL')}}/media/gallery/large/picture/${media.id}" method="post">
                                                    @csrf
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input"
                     id="largeSwitch-${counter}"
                     ${check}
                                                               onchange="submitForm(event)">
                                                        <label class="custom-control-label"
                                                               for="largeSwitch-${counter}"></label>
                                                    </div>
                                                </form>
                                            </td>

                                            <td>
                                                 <div class="m-1">
                                                     <button type="button"
                                                             onclick="deleteModal(this)"
                                                             data-id="${media.id}"
                                                             class="btn btn-danger "><i
                                                             class="fa fa-trash "></i>delete
                                                     </button>
                                                 </div>
                                             </td>
                </tr>`)

                if(response.large_flag === true)
                {
                    location.reload();
                }


                @elseif($type == \App\Models\User::class or $type == \App\Models\Auction::class or $type == \App\Models\Contract::class)
                if (rows[0].innerHTML === '<td valign="top" colspan="3" class="dataTables_empty">No data available in table</td>') {
                    rows[0].remove();
                }
                counter = rows.length;
                tbody.prepend(`<tr>
                    <td>
                        <a target="_blank" href="{{env('APP_URL')}}/${media.path}">
                            <img src="{{env('APP_URL')}}/${media.path}" class="avatar" alt="" width="100"
                                 height="100"/>
                        </a>
                    </td>
                    <td><a target="_blank"
                           href="{{env('APP_URL')}}/${media.path}">${media.path.slice(13, 57)}</a>
                    </td>




                    <td>
                                                 <div class="m-1">
                                                     <button type="button"
                                                             onclick="deleteModal(this)"
                                                             data-id="${media.id}"
                                                             class="btn btn-danger "><i
                                                             class="fa fa-trash "></i>delete
                                                     </button>
                                                 </div>
                                             </td>


                </tr>`)
                @else
                if (rows[0].innerHTML === '<td valign="top" colspan="4" class="dataTables_empty">No data available in table</td>') {
                    rows[0].remove();
                }
                counter = rows.length;
                tbody.prepend(`<tr>
                    <td>
                        <a target="_blank" href="{{env('APP_URL')}}/${media.path}">
                            <img src="{{env('APP_URL')}}/${media.path}" class="avatar" alt="" width="100"
                                 height="100"/>
                        </a>
                    </td>
                    <td><a target="_blank"
                           href="{{env('APP_URL')}}/${media.path}">${media.path.slice(13, 57)}</a>
                    </td>


                    <td>
                <form action="{{env('APP_URL')}}/media/main/${media.id}" method="post">
                           @csrf
                <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input"
                     id="mainSwitch-${counter}"
                     onchange="submitForm(event)">
                <label class="custom-control-label"
                    for="mainSwitch-${counter}"></label>
                            </div>
                        </form>
                    </td>



                                            <td>
                                                 <div class="m-1">
                                                     <button type="button"
                                                             onclick="deleteModal(this)"
                                                             data-id="${media.id}"
                                                             class="btn btn-danger "><i
                                                             class="fa fa-trash "></i>delete
                                                     </button>
                                                 </div>
                                             </td>
                </tr>`)

                @endif


            },

            error: function (file, message, xhr) {
                const error = document.querySelector('#error');
                error.classList.remove('d-none');
                error.innerHTML = ` <div class="row"><i class="material-icons mr-1">error</i> <strong>Error:</strong> <span class="ml-1">${message}</span></div>`;
                setTimeout(() => {
                    $(file.previewElement).remove();
                    error.innerHTML = '';
                    error.classList.add('d-none')
                }, 5000)
            }
            ,
            // accept: function (file, done) {
            //     // file.acceptDimensions = done;
            //     // file.rejectDimensions = function () {
            //     //     done("width to height ration of medias should be 3:2.");
            //     // };
            // }

        });
    </script>

    <script>

        const rows = document.getElementById('medias-table').children;
        for (let i = 0; i < rows.length; i++) {
            const main_checked = document.getElementById(`mainSwitch-${i}`).checked;

            @if($type == \App\Models\Gallery::class)
            const homepage_checked = document.getElementById(`customSwitch-${i}`).checked;
            const large_checked = document.getElementById(`largeSwitch-${i}`).checked;
            if (homepage_checked) {
                document.getElementById(`customSwitch-${i}`).disabled = true;
            }
            if (large_checked) {
                document.getElementById.disabled = true;
            }
            @endif

            if (main_checked) {
                document.getElementById(`mainSwitch-${i}`).disabled = true;
            }

        }


    </script>

    @if($type == \App\Models\Gallery::class)
        <script>
            function checkCheckboxes(event, href) {

                let error_messages = [];
                let main_checkeds = [];
                let homepage_picture_checkeds = [];
                let gallery_large_checkeds = [];
                const rows = document.getElementById('medias-table').children;

                if (rows[0].innerHTML === '<td valign="top" colspan="6" class="dataTables_empty">No data available in table</td>') {
                    error_messages.push('not enough files uploaded')
                } else {
                    for (let i = 0; i < rows.length; i++) {
                        const main_checked = document.getElementById(`mainSwitch-${i}`).checked;
                        const homepage_checked = document.getElementById(`customSwitch-${i}`).checked;
                        const large_checked = document.getElementById(`largeSwitch-${i}`).checked;
                        console.log(main_checked, homepage_checked, large_checked)
                        if (main_checked) {
                            main_checkeds.push(main_checked)
                        }
                        if (homepage_checked) {
                            homepage_picture_checkeds.push(homepage_checked)
                        }
                        if (large_checked) {
                            gallery_large_checkeds.push(large_checked)
                        }
                    }

                    if (main_checkeds.length === 0) {
                        error_messages.push('at least one main media should be selected');
                    }
                    if (homepage_picture_checkeds.length < 1 || homepage_picture_checkeds.length > 1) {
                        error_messages.push('exactly one homepage media should be selected')
                    }
                    if (gallery_large_checkeds.length === 0) {
                        error_messages.push('at least one gallery large picture should be selected')
                    }
                }


                if (error_messages.length === 0) {
                    const buttons = `<a class="btn btn-outline-info float-left" href="{{route('galleries.edit',$id)}}">
                    <span class="row">
                        <i class="material-icons">arrow_back</i>
                        Back to Gallery Edit
                    </span>

                </a>

                <a href="{{route('videoLink.index',['type'=>\App\Models\Gallery::class,'id'=>$id])}}" id="continue" class="btn btn-outline-info float-right">
                    <span class="row">
                            Go to Video Link Section
                            <i class="material-icons">arrow_forward</i>
                    </span>

                </a>`
                    Swal.fire({
                        target: 'body',
                        icon: '{{\Illuminate\Support\Facades\Session::has('icon') ? \Illuminate\Support\Facades\Session::get('icon') : 'success'}}',
                        title: 'Gallery Media saved successfully',
                        showCancelButton: false,
                        showConfirmButton: false,
                        timer: 100000,
                        html: buttons
                    })
                    // location.replace(href);
                } else {
                    event.preventDefault();
                    Swal.fire({
                        html: `<ul class="text-left">
                                ${(error_messages.map((msg) => `<li>${msg} </li>`)).join(' ')}
                    </ul>
                        <div class="mt-4">
                        <a class="btn btn-outline-info " href="{{route($route,$id)}}">
                    <span class="row">
                        <i class="material-icons">arrow_back</i>
                        Back to {{strtok($route, '.')}} Edit
                    </span>
                    </a>
                     </div>`,
                        target: 'body',
                        icon: 'error',
                        title: error_messages.length === 1 ? 'the following error occured:' : 'the following errors occured:',
                        showCancelButton: false,
                        showConfirmButton: false,
                        timer: 100000,
                    })
                }

            }
        </script>
    @elseif($type != \App\Models\Contract::class)
        <script>
            function checkCheckboxes(event, href) {

                let error_messages = [];
                let main_checkeds = [];
                const rows = document.getElementById('medias-table').children;
                for (let i = 0; i < rows.length; i++) {
                    const main_checked = document.getElementById(`mainSwitch-${i}`).checked;

                    if (main_checked) {
                        main_checkeds.push(main_checked)
                    }

                }

                if (main_checkeds.length === 0) {
                    error_messages.push('at least one main media should be selected');
                }

                if (error_messages.length === 0) {
                    const buttons = `<a class="btn btn-outline-info float-left" href="{{route($route,$id)}}">
                    <span class="row">
                        <i class="material-icons">arrow_back</i>
                        Back to {{strtok($route, '.')}} Edit
                    </span>

                </a>

                <a href="{{route('videoLink.index',['type'=>$type,'id'=>$id])}}" id="continue" class="btn btn-outline-info float-right">
                    <span class="row">
                            Go to Video Link Section
                            <i class="material-icons">arrow_forward</i>
                    </span>

                </a>`
                    Swal.fire({
                        target: 'body',
                        icon: '{{\Illuminate\Support\Facades\Session::has('icon') ? \Illuminate\Support\Facades\Session::get('icon') : 'success'}}',
                        title: 'Medias saved successfully',
                        showCancelButton: false,
                        showConfirmButton: false,
                        timer: 100000,
                        html: buttons
                    })
                    // location.replace(href);
                } else {
                    event.preventDefault();
                    Swal.fire({
                        html: `<ul class="text-left">
                                ${(error_messages.map((msg) => `<li>${msg} </li>`)).join(' ')}
                    </ul>
                    <div class="mt-4">
                        <a class="btn btn-outline-info " href="{{route($route,$id)}}">
                    <span class="row">
                        <i class="material-icons">arrow_back</i>
                        Back to {{strtok($route, '.')}} Edit
                    </span>
                    </a>
                     </div>`,
                        target: 'body',
                        icon: 'error',
                        title: error_messages.length === 1 ? 'the following error occured:' : 'the following errors occured:',
                        showCancelButton: false,
                        showConfirmButton: false,
                        timer: 100000,
                    })
                }


            }
        </script>

    @endif



    <!-- DataTables  & Plugins -->
    <script src="{{asset('admin/js/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/js/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/js/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('admin/js/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/js/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('admin/js/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/js/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('admin/js/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('admin/js/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('admin/js/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('admin/js/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('admin/js/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "ordering": false,
                "bInfo": false,
                "searching": false,
                "paging": false,
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            // $('#example2').DataTable({
            //     "paging": true,
            //     "lengthChange": false,
            //     "searching": false,
            //     "ordering": true,
            //     "info": true,
            //     "autoWidth": false,
            //     "responsive": true,
            // });
        });
    </script>

    <script>

        $(".delete-icon").on("click", function () {
            var MediaId = $(this).data('id');
            $("#delete-form").attr("action", "/users/" + MediaId)
        });

    </script>

    <script>
        function deleteModal(element) {
            var MediaId = $(element).data('id');
            document.getElementById('delete-form').action = `/my/media/delete/${MediaId}`;
            Swal.fire({
                icon: 'warning',
                title: 'Do you want to delete this Media?',
                showCancelButton: true,
                showConfirmButton: true,
                confirmButtonText: `yes`,
                cancelButtonText: `no`,
                confirmButtonColor: '#22303d',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.value) {
                    $("#delete-form").submit();
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        title: 'the removal request was canceled',
                        icon: 'info',
                        confirmButtonText: 'ok',
                        confirmButtonColor: '#22303d'
                    });

                }
            })
        }
    </script>
    <script>
        function submitForm(e) {
            const checkbox = e.target;
            const form = checkbox.parentElement.parentElement;
            form.submit();
        }
    </script>

    <script>
        function submitMainForm(e) {
            const checkbox = e.target;
            const form = checkbox.parentElement.parentElement
            form.submit()
        }
    </script>





@endsection
