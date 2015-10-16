@extends('dashboard.layouts.main')
@section('content')
    <div class="bigTitle">Episodes List</div>
    <a href="{{ url('admin/episodes/create') }}" class="prevBT add">Add</a>
    <ul class="list_ob">
        @foreach ($episodes as $episode)
            <li>
                <?php echo $episode['title']; ?>
                <a href="{{ url('admin/episodes/edit/' . $episode['id']) }}" class="prevBT update">Edit</a>
                <a href="{{ url('admin/episodes/delete/' . $episode['id']) }}" class="prevBT del">Delete</a>
            </li>
        @endforeach
    </ul>
@endsection