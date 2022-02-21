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
            <h3 class="card-title">upload Media </h3>
        </div>

        <div class="form-group">
            <label for="contract ">Upload Media (size: 1200x800-1800x1200-2400x1600-900x600)</label>
            <div class="dropzone">
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                </form>
            </div>
            <div class="bg bg-danger" id="error"></div>
        </div>

        <div class="card-footer">


        </div>


        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="card col-sm-12">
                        <div class="card-header">


                            <h3 class="card-title">Media</h3>
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
                                    <th>main</th>
                                    @if($type == App\Models\Gallery::class)
                                        <th>gallery large picture</th>
                                    @endif
                                    <th>operations</th>
                                </tr>
                                </thead>

                                <tbody id="medias-table">
                                @foreach($medias->sortByDesc('created_at') as $media)
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
                                                           @endif id="customSwitch-{{$media->id}}"
                                                           onchange="submitForm(event)">
                                                    <label class="custom-control-label"
                                                           for="customSwitch-{{$media->id}}"></label>
                                                </div>
                                            </form>
                                        </td>
                                        @endif

                                        <td>
                                            <form action="{{route('main.media',$media->id)}}" method="post">
                                                @csrf
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                           @if($media->main == true) checked
                                                           @endif id="mainSwitch-{{$media->id}}"
                                                           onchange="submitForm(event)">
                                                    <label class="custom-control-label"
                                                           for="mainSwitch-{{$media->id}}"></label>
                                                </div>
                                            </form>
                                        </td>

                                        @if($type == \App\Models\Gallery::class)
                                            <td>
                                                <form action="{{route('large.media',$media->id)}}" method="post">
                                                    @csrf
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                               @if($media->gallery_large_picture == true) checked
                                                               @endif id="largeSwitch-{{$media->id}}"
                                                               onchange="submitForm(event)">
                                                        <label class="custom-control-label"
                                                               for="largeSwitch-{{$media->id}}"></label>
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
            @if($type == \App\Models\Contract::class)
                @php
                    $contract = \App\Models\Contract::query()->find($id);
                    $asset = $contract->asset;
                @endphp
                <a class="btn btn-primary " id="submitButton" href="{{route('contracts.index', $asset->id)}}">Submit</a>
            @elseif($type == \App\Models\User::class)
                <button class="btn btn-primary " id="submitButton"
                        onclick="checkCheckboxes(event, '{{route('users.index')}}')">Next
                </button>
            @elseif($type== \App\Models\Gallery::class)
                <button class="btn btn-primary " id="submitButton"
                        onclick="checkCheckboxes(event, '{{route('users.index')}}')">Next
                </button>
            @else
                <button class="btn btn-primary " id="submitButton"
                        onclick="checkCheckboxes(event, '{{route('videoLink.index', ['type'=>$type ,'id'=>$id])}}')">Next
                </button>
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

                    if (file.width === 3 / 2 * file.height) {
                        file.rejectDimensions()
                    } else {
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
                        }
                    })

                });


            },
            success: function (file, response) {
                const tbody = $('#medias-table');
                const media = response.medias[response.medias.length - 1]

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
                            @csrf
                <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input"

                       id="customSwitch-${media.id}"
                                   onchange="submitForm(event)"/>
                            <label class="custom-control-label"
                                   for="customSwitch-${media.id}"></label>
                            </div>
                        </form>
                    </td>
                    <td>
                        <form action="{{env('APP_URL')}}/media/main/${media.id}" method="post">
                           @csrf
                <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input"

                     id="mainSwitch-{media.id}"
                     onchange="submitForm(event)">
                <label class="custom-control-label"
                    for="mainSwitch-${media.id}"></label>
                            </div>
                        </form>
                    </td>

                    <td>
                                                <form action="{{env('APP_URL')}}/media/gallery/large/picture/${media.id}" method="post">
                                                    @csrf
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input"
                     id="largeSwitch-${media.id}}"
                                                               onchange="submitForm(event)">
                                                        <label class="custom-control-label"
                                                               for="largeSwitch-${media.id}}"></label>
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

                @elseif($type == \App\Models\User::class)
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

                     id="mainSwitch-{media.id}"
                     onchange="submitForm(event)">
                <label class="custom-control-label"
                    for="mainSwitch-${media.id}}"></label>
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
                           @csrf
                <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input"

                     id="mainSwitch-{media.id}"
                     onchange="submitForm(event)">
                <label class="custom-control-label"
                    for="mainSwitch-${media.id}}"></label>
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
                error.innerHTML = ' <h3>an error occured. your file will be deleted from the dropzone shortly </h3>';
                setTimeout(() => {
                    $(file.previewElement).remove();
                    error.innerHTML = '';
                    location.reload();
                }, 3000)
            }
            ,
            accept: function (file, done) {
                file.acceptDimensions = done;
                file.rejectDimensions = function () {
                    done("Image width or height too big.");
                };
            }

        });
    </script>

    <script>
        function checkCheckboxes(event, href) {

            const rows = document.getElementById('medias-table').children;
            console.log(rows[0].children)
            // location.replace(href);
        }
    </script>
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
                "responsive": true, "lengthChange": true, "autoWidth": false, "ordering": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
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
