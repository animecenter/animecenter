@extends('dashboard.layouts.main')

@section('title')
    Genres
@endsection

@section('content')
    <div class="box">
        @include('dashboard.layouts.resource-header')
        <div class="box-body">
            <table id="genres" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Model</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Model</th>
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
        jQuery(function () {
            jQuery('#genres').dataTable({
                "aoColumns": [
                    {"sWidth": "25%"},
                    {"sWidth": "25%"},
                    {"sWidth": "25%"},
                    {"sWidth": "25%"},
                ],
                "aLengthMenu": [
                    [10, 25, 50, 100, 99999999],
                    [10, 25, 50, 100, "All"]
                ],
                "iDisplayLength": 100,
                "bSort": true,
                "bAutoWidth": false,
                "sPaginationType": "bootstrap",
                "oLanguage": {
                    "sLengthMenu": "_MENU_ records",
                    "oPaginate": {
                        "sPrevious": "Prev",
                        "sNext": "Next"
                    }
                },
                "sAjaxSource": "{{ url('dashboard/genres/list/' . request()->segment(3)) }}",
                "bServerSide": true
            });
        });
    </script>
@endsection
