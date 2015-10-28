@extends('dashboard.layouts.main')

@section('title')
    Producers
@endsection

@section('content')
    <div class="box">
        @include('dashboard.layouts.resource-header')
        <div class="box-body">
            <table id="producers" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th>Name</th>
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
            jQuery('#producers').dataTable({
                "aoColumns": [
                    {"sWidth": "33%"},
                    {"sWidth": "33%"},
                    {"sWidth": "33%"},
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
                "sAjaxSource": "{{ url('dashboard/producers/list/' . request()->segment(3)) }}",
                "bServerSide": true
            });
        });
    </script>
@endsection