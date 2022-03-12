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
            <h3 class="card-title">upload Media </h3>
            <div class="float-right">

                <a href="{{route('assets.edit',$id)}}" class="btn btn-warning">
                    <span class="row">
                         <i class="material-icons">arrow_back</i>
                            Back
                    </span>

                </a>
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
                        Next
                    </button>
                @elseif($type == \App\Models\Asset::class)
                    <a href="{{route('assets.edit',$id)}}" class="btn btn-outline-warning">
                        <span class="row">
                             <i class="material-icons">arrow_back</i>
                                Back
                        </span>
                    </a>
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
                    <a href="{{route('users.index')}}" class="btn btn-primary">Next</a>
                @elseif($type == \App\Models\Auction::class)
                    @php
                        $auction = \App\Models\Auction::query()->find($id);
                        $artist = $auction->artist;
                    @endphp
                    <a class="btn btn-primary" href="{{route('auctions.index',$artist->id)}}">Next</a>
                @elseif($type == \App\Models\Contract::class)
                    @php
                        $contract = \App\Models\Contract::query()->find($id);
                        $asset = $contract->asset;
                    @endphp
                    <a class="btn btn-primary " id="submitButton"
                       href="{{route('contracts.index', $asset->id)}}">Submit</a>
                @endif
            @elseif($edit == 0)

                @if($type == \App\Models\User::class)
                    <a href="{{route('users.index')}}" class="btn btn-primary">Next</a>
                @elseif($type == \App\Models\Auction::class)
                    @php
                        $auction = \App\Models\Auction::query()->find($id);
                        $artist = $auction->artist;
                    @endphp
                    <a class="btn btn-primary" href="{{route('auctions.index',$artist->id)}}">Next</a>
                @elseif($type == \App\Models\Contract::class)
                    @php
                        $contract = \App\Models\Contract::query()->find($id);
                        $asset = $contract->asset;
                    @endphp
                    <a class="btn btn-primary " id="submitButton"
                       href="{{route('contracts.index', $asset->id)}}">Submit</a>
                @else
                    <button class="btn btn-primary " id="submitButton"
                            onclick="checkCheckboxes(event, '{{route('videoLink.index', ['type'=>$type ,'id'=>$id])}}')">
                        Next
                    </button>
                @endif

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
                    error.innerHTML = ` <div class="row"><i class="material-icons mr-1">error</i> <strong>Error:</strong> <span class="ml-1">the media dimension ratio must be 3:2</span></div>`;
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
                if(rows[0].innerHTML === '<td valign="top" colspan="6" class="dataTables_empty">No data available in table</td>')
                {
                    rows[0].remove();
                }
                counter = rows.length;

                @if($type == \App\Models\Gallery::class)

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
{{--                            @csrf--}}
                    <input type="hidden" value="{{ csrf_token() }}"/>
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
                    <input type="hidden" value="{{ csrf_token() }}"/>
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
                    <input type="hidden" value="{{ csrf_token() }}"/>
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input"
                     id="largeSwitch-${counter}"
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

                @elseif($type == \App\Models\User::class or $type == \App\Models\Auction::class or $type == \App\Models\Contract::class)

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
                    <input type="hidden" value="{{ csrf_token() }}"/>
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

    @if($type == \App\Models\Gallery::class)
        <script>
            function checkCheckboxes(event, href) {

                let error_messages = [];
                let main_checkeds = [];
                let homepage_picture_checkeds = [];
                let gallery_large_checkeds = [];
                const rows = document.getElementById('medias-table').children;

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

                if (error_messages.length === 0) {
                    location.replace(href);
                } else {
                    console.log(error_messages)
                    event.preventDefault();
                    Swal.fire({
                        html: `<ul class="text-left">
                                ${(error_messages.map((msg) => `<li>${msg} </li>`)).join(' ')}
                    <ul/>`,
                        target: 'body',
                        icon: 'error',
                        title: 'the following errrors occured:',
                        showCancelButton: false,
                        showConfirmButton: true,
                        timer: 100000,
                    })
                }

            }
        </script>
    @else
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
                    location.replace(href);
                } else {
                    event.preventDefault();
                    Swal.fire({
                        html: `<ul class="text-left">
                                ${(error_messages.map((msg) => `<li>${msg} </li>`)).join(' ')}
                    <ul/>`,
                        target: 'body',
                        icon: 'error',
                        title: 'the following errrors occured:',
                        showCancelButton: false,
                        showConfirmButton: true,
                        timer: 5000,
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
