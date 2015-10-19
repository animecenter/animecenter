@extends('dashboard.layouts.main')

@section('title')
    Classifications List
@endsection

@section('content')
    <div class="box">
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($classifications as $classification)
                        <tr>
                            <td>{{ $classification->name }}</td>
                            <td>
                                <a href="{{ url('dashboard/classifications/edit', [$classification->id]) }}"
                                   class="btn btn-sm btn-warning pull-left"><i class="fa fa-pencil-square-o"></i></a>
                                <a href="{{ url('dashboard/classifications/delete', [$classification->id]) }}"
                                   onclick="return confirm('Are you sure wants to delete this classification?')"
                                   class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Title</th>
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