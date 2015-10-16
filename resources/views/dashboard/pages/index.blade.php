@extends('dashboard.layouts.main')
@section('content')
    <div class="bigTitle">Pages List</div>
    <a href="{{ url('admin/pages/create') }}" class="prevBT add">Add</a>
    <ul class="list_ob">
        @foreach ($pages as $page)
            <li>
                {{ $page['title'] }}
                <a href="{{ url('admin/pages/edit/' . $page['id']) }}" class="prevBT update">Edit</a>
                <a href="{{ url('admin/pages/delete/' . $page['id']) }}" class="prevBT del">Delete</a>
            </li>
        @endforeach
    </ul>
@endsection