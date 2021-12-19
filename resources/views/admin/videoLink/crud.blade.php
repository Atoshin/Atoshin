@extends('admin.layout.master')
@section('content')

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Video links</h3>
        </div>

        <div class="form-group">
{{--            <label for="contract ">Video links</label>--}}
            <div class="dropzone">
                <form action="{{route('videoLink.store', ['type' => $type, 'id' => $id])}}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <div></div>
                            <label for="exampleInputEmail1">Link</label>
                            <input type="text" class="form-control" name="link" placeholder="Link" value="{{old('link')}}">
                            @error('link')
                            <small class="text-danger">
                                {{$message}}
                            </small>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                </form>
            </div>
        </div>

{{--        <div class="card-footer">--}}
{{--            @if($type == \App\Models\Gallery::class)--}}
{{--                <a class="btn btn-primary" href="{{route('redirect','galleries.index')}}">Submit</a>--}}
{{--                <a class="btn btn-primary" href="{{route('videoLink.store', ['type' => $type, 'id' => $id])}}">Submit</a>--}}
{{--            @elseif($type == \App\Models\Artist::class)--}}
{{--                <a class="btn btn-primary" href="{{route('redirect','artists.index')}}">Submit</a>--}}
{{--            @endif--}}
{{--        </div>--}}



{{--        table--}}
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Link</th>
                    <th>Operations</th>
                </tr>
                </thead>

                <tbody>
                @foreach($video_links as $videoLink)
                    <tr>
                        <td><a href="{{$videoLink->link}}">{{$videoLink->link}}</a></td>
                        <td>
                            <div class="row">

                                <div class="m-1">
                                    <button type="button"
                                            onclick="deleteModal(this)"
                                            data-id="{{$videoLink->id}}"
                                            class="btn btn-danger "><i
                                            class="fa fa-trash "></i>delete
                                    </button>
                                </div>

                                {{--                                            <div class="m-1">--}}
                                {{--                                                <a href="{{route('locations.create', $gallery->id)}}" type="button"--}}
                                {{--                                                   class="btn btn-success "> <i class="fa fa-location-arrow "></i> location </a>--}}
                                {{--                                            </div>--}}
                            </div>


                        </td>


                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer">
                <a class="btn btn-primary"
                   href="{{route('videoLink.store', ['type' => $type, 'id' => $id])}}">Next</a>
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
            document.getElementById('delete-form').action = "/video/link/"+videoLinkId+"/destroy";
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

@endsection
