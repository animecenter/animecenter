@extends('admin.index')
@section('content')
    <div class="bigTitle">Anime List</div>
    <a href="{{ url('admin/anime/create') }}" class="prevBT add">Add</a>
    <ul class="list_ob">
        @foreach($animes as $anime)
            <li>
                {{ $anime['title'] }}
                <a href="{{ url('admin/anime/edit/' . $anime['id']) }}" class="prevBT update">Edit</a>
                <a href="{{ url('admin/anime/delete/' . $anime['id']) }}" class="prevBT del">Delete</a>
            </li>
        @endforeach
    </ul>
@endsection