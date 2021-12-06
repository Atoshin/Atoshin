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
            <label for="contract ">Upload Media</label>
            <div class="dropzone">
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf

                </form>
            </div>
        </div>

        <div class="card-footer">
            @if($type == \App\Models\Gallery::class)
                <a class="btn btn-primary" href="{{route('redirect','galleries.index')}}">Submit</a>
            @elseif($type == \App\Models\Artist::class)
                <a class="btn btn-primary" href="{{route('redirect','artists.index')}}">Submit</a>
            @elseif($type == \App\Models\User::class)
                <a class="btn btn-primary" href="{{route('redirect','users.index')}}">Submit</a>
            @elseif($type == \App\Models\Contract::class)
                <a class="btn btn-primary" href="{{route('redirect','assets.index')}}">Submit</a>
            @endif
        </div>

    </div>


@endsection

@section('scripts')


    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

    <script>
        // Dropzone has been added as a global variable.
        const dropzone = new Dropzone("div.dropzone", {
            url: "{{route('uploadFile',['mediable_type' => $type, 'mediable_id' => $id])}}",
            autoDiscover: false,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            maxFilesize: 100,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(file, response)
            {
                console.log(response)
                document.getElementById('media_id_input').value = response.media_id
                console.log(response);
            },
        });
    </script>

@endsection
