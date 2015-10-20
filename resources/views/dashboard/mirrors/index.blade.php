@extends('dashboard.layouts.main')

@section('title')
    Mirrors
@endsection

@section('content')
    <div class="box">
        <div class="box-body">
            <table id="mirrors" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Anime Title</th>
                        <th>Episode Number</th>
                        <th>Mirror Source</th>
                        <th>Translation</th>
                        <th>Quality</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th>Anime Title</th>
                        <th>Episode Number</th>
                        <th>Mirror Source</th>
                        <th>Translation</th>
                        <th>Quality</th>
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
            jQuery('#mirrors').dataTable({
                "aoColumns": [
                    {"sWidth": "14%"},
                    {"sWidth": "14%"},
                    {"sWidth": "14%"},
                    {"sWidth": "14%"},
                    {"sWidth": "14%"},
                    {"sWidth": "14%"},
                    {"sWidth": "14%"},
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
                "sAjaxSource": "{{ url('dashboard/mirrors/list') }}",
                "bServerSide": true
            });
        });
    </script>
@endsection