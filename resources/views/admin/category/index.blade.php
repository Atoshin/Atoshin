@extends('admin.layout.layout')

@section('content')
{{--@foreach()--}}
<div class="card-body table-responsive p-0">
    {{--<button type="button" href="{{route('categories.create')}}" class="btn btn-secondary btn-sm">Create</button>--}}
    <a href="{{route('categories.create')}}" class="btn btn-secondary btn-sm">Create</a>
    <table class="table table-striped table-valign-middle">
        <thead>
        <tr>
            <th>Title</th>
            <th>Parent category</th>
            {{--<th>Sales</th>--}}
            <th>More</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>
                    {{$category->title}}
                </td>
                <td>
                    {{$category->parent ? $category->parent->title : "-"}}
                </td>
                <td>
                    {{--<a href="#" class="text-muted">--}}
                        {{--<i class="fas fa-search"></i>--}}
                    {{--</a>--}}
                    <button type="button" class="btn btn-primary btn-sm">Edit</button>
                    <button type="button" class="btn btn-danger btn-sm">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection