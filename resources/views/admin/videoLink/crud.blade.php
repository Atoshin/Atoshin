@extends('admin.layout.master')
{{--@section('styles')--}}
{{--    <style>--}}
{{--        /*.youtube > iframe{*/--}}
{{--        /*    width: 300px;*/--}}
{{--        /*    height: 150px;*/--}}
{{--        /*}*/--}}
{{--    </style>--}}
{{--@endsection--}}
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
            <h3 class="card-title">Video links
                @if($type == "App\Models\Gallery")
                    @if(count($video_links->where('is_default',true)->where('video_linkable_id',$id)->where('video_linkable_type',$type))==0)
                        <p>*Please add a gallery video for home page.</p>
                    @endif
                @endif
            </h3>
        </div>
        <div class="form-group">
            {{--            <label for="contract ">Video links</label>--}}
            <div class="">
                <form action="{{route('videoLink.store', ['type' => $type, 'id' => $id])}}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <div>
                                <label for="exampleInputEmail1">Link</label>
                                <textarea type="text" class="form-control" name="link"
                                          placeholder="Link">{{old('link')}}</textarea>
                                {{--                            <input type="text" class="form-control" name="link" placeholder="Link" value="{{old('link')}}">--}}
                                @error('link')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                                @enderror
                            </div>
                            @if($type == "App\Models\Gallery")
                                <div style="margin-top: 15px">
                                    <input type="checkbox" name="is_default" id="is_default">
                                    <label for="exampleInputEmail1">Show this video in Home page</label>
                                </div>

                            @endif

                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Add Video</button>
                    </div>

                </form>


            </div>
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Link</th>
                    <th>Code</th>
                    <th>Operations</th>
                </tr>
                </thead>
                <tbody>
                @foreach($video_links as $videoLink)
                    <tr>
                        <td>
                            <div class="youtube">{!!($videoLink->link)!!}</div>
                        </td>
                        <td>
                            <div class="">{{$videoLink->link}}</div>
                        </td>
                        <td>
                            <div class="row" style="display: block ruby">
                                <div class="m-1">
                                    <button type="button"
                                            onclick="deleteModal(this)"
                                            data-id="{{$videoLink->id}}"
                                            class="btn btn-danger "><i
                                            class="fa fa-trash "></i>delete
                                    </button>
                                </div>
                                @if($videoLink->is_default == true)
                                <a class="btn btn-primary"
                                   href="{{route('upload.page.video' , ['type'=>\App\Models\VideoLink::class,'id'=>$videoLink->id,'gallery_id'=>$id])}}">upload video picture</a>
                                @endif
                                @if($videoLink->is_default == true)
                                    <i class="fa fa-crown" style="color: #CC8D1D"></i>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div  class="card-footer " id="submitButton" >
            @if($type == "App\Models\Gallery")
                {{--            {{app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName()}}--}}
                @if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'galleries.edit')

                        <a class="btn btn-primary"
                           href="{{route('galleries.edit' , ['gallery'=>$id])}}">Submit</a>

                @else

                        <a class="btn btn-primary"
                           href="{{route('galleries.index')}}">Submit</a>


                @endif
            @elseif($type == "App\Models\Artist")
                @if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'artists.edit')
                    <a class="btn btn-primary"
                       href="{{route('artists.edit' , ['artist'=>$id])}}">Submit</a>
                @else
                    <a class="btn btn-primary"
                       href="{{route('artists.index')}}">Submit</a>
                @endif
            @elseif($type == "App\Models\Asset")
                @if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'assets.edit')
                    <a class="btn btn-primary"
                       href="{{route('assets.edit' , ['asset'=>$id])}}">Submit</a>
                @else
                    <a class="btn btn-primary"
                       href="{{route('assets.index')}}">Submit</a>
                @endif
            @endif
        </div>
    </div>
    <form action="" id="delete-form" method="POST">
        @method('delete')
        @csrf
    </form>
@endsection

@section('scripts')
    <script>
        function deleteModal(element) {
            var videoLinkId = $(element).data('id');
            document.getElementById('delete-form').action = "/video/link/" + videoLinkId + "/destroy";
            Swal.fire({
                icon: 'warning',
                title: 'Do you want to delete this video link?',
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

{{--    <script>--}}
{{--        let flag = false;--}}
{{--        @foreach($video_links as $video_link)--}}
{{--            @if($video_link->is_default)--}}
{{--                @if($video_link->media)--}}
{{--                    flag = true--}}
{{--                @endif--}}
{{--            @endif--}}
{{--        @endforeach--}}
{{--        if(flag === true)--}}
{{--        {--}}
{{--            document.getElementById('submitButton').classList.remove('d-none')--}}
{{--        }--}}
{{--    </script>--}}
@endsection
