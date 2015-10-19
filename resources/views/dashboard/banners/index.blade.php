@extends('dashboard.layouts.main')

@section('title')
    Anime List
@endsection

@section('content')
    <div class="box">
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($animes as $anime)
                        <tr>
                            <td>{{ $anime->title }}</td>
                            <td>{{ $anime->slug }}</td>
                            <td>{{ $anime->status }}</td>
                            <td>
                                <a href="{{ url('dashboard/animes/edit', [$anime->id]) }}"
                                   class="btn btn-sm btn-warning pull-left"><i class="fa fa-pencil-square-o"></i></a>
                                <a href="{{ url('dashboard/animes/delete', [$anime->id]) }}"
                                   onclick="return confirm('Are you sure wants to delete this anime?')"
                                   class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            $("#example1").DataTable();
        });
    </script>
@endsection