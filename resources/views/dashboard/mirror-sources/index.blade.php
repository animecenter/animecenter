@extends('dashboard.layouts.main')

@section('title')
    Mirror Sources
@endsection

@section('content')
    <div class="box">
        <div class="box-body">
            <table id="mirror-sources" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th>Name</th>
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
            jQuery('#mirror-sources').dataTable({
                "aoColumns": [
                    {"sWidth": "50%"},
                    {"sWidth": "50%"},
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
                "sAjaxSource": "{{ url('dashboard/mirror-sources/list') }}",
                "bServerSide": true
            });
        });
    </script>
@endsection