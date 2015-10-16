@extends('dashboard.layouts.main')
@section('content')
    <div class="bigTitle">Images List</div>
    <a href="{{ url('admin/images/create') }}" class="prevBT add">Add</a>
    <ul class="list_ob">
        @foreach ($images as $image)
            <li>
                <?php echo $image['bigtitle']; ?>
                <a href="{{ url('admin/images/edit/' . $image['id']) }}" class="prevBT update">Edit</a>
                <a href="{{ url('admin/images/delete/' . $image['id']) }}" class="prevBT del">Delete</a>
            </li>
        @endforeach
    </ul>
@endsection