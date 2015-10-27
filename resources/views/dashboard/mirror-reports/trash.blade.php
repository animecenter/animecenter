@extends('dashboard.layouts.main')

@section('title')
    Trashed mirror reportss
@endsection

@section('content')
    <div class="box">
        <div class="box-body">
            <table id="mirror-reports" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Username</th>
                    <th>Mirror URL</th>
                    <th>Verified</th>
                    <th>Broken</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                <tr>
                    <th>Username</th>
                    <th>Mirror URL</th>
                    <th>Verified</th>
                    <th>Broken</th>
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
            jQuery('#mirror-reports').dataTable({
                "aoColumns": [
                    {"sWidth": "16%"},
                    {"sWidth": "16%"},
                    {"sWidth": "16%"},
                    {"sWidth": "16%"},
                    {"sWidth": "16%"},
                    {"sWidth": "16%"},
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
                "sAjaxSource": "{{ url('dashboard/mirror-reports/list/trash') }}",
                "bServerSide": true
            });
        });
    </script>
@endsection