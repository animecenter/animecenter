@extends('dashboard.layouts.main')

@section('title')
    Relations
@endsection

@section('content')
    <div class="box">
        @include('dashboard.layouts.resource-header')
        <div class="box-body">
            <table id="relations" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Relationship</th>
                        <th>Related To</th>
                        <th>Model</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th>Title</th>
                        <th>Relationship</th>
                        <th>Related To</th>
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
            jQuery('#relations').dataTable({
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
                "sAjaxSource": "{{ url('dashboard/relations/list/' . request()->segment(3)) }}",
                "bServerSide": true
            });
        });
    </script>
@endsection
