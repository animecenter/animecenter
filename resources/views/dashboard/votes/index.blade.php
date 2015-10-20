@extends('dashboard.layouts.main')

@section('title')
    Votes
@endsection

@section('content')
    <div class="box">
        <div class="box-body">
            <table id="votes" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Title</th>
                        <th>Rating</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th>Username</th>
                        <th>Title</th>
                        <th>Rating</th>
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
            jQuery('#votes').dataTable({
                "aoColumns": [
                    {"sWidth": "20%"},
                    {"sWidth": "20%"},
                    {"sWidth": "20%"},
                    {"sWidth": "20%"},
                    {"sWidth": "20%"},
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
                "sAjaxSource": "{{ url('dashboard/votes/list') }}",
                "bServerSide": true
            });
        });
    </script>
@endsection