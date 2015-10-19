@extends('dashboard.layouts.main')

@section('title')
    Episodes List
@endsection

@section('content')
    <div class="box">
        <div class="box-body">
            <table id="episodes" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Anime Title</th>
                        <th>Episode Number</th>
                        <th>Aired At</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th>Anime Title</th>
                        <th>Episode Number</th>
                        <th>Aired At</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#episodes').dataTable({
                "aoColumns": [
                    {},
                    {},
                    {},
                    {},
                    {}
                ],
                "aLengthMenu": [
                    [10, 25, 50, 100, 99999999],
                    [10, 25, 50, 100, "All"]
                ],
                "iDisplayLength": 100,
                "bSort": false,
                "bAutoWidth": false,
                "sPaginationType": "bootstrap",
                "oLanguage": {
                    "sLengthMenu": "_MENU_ records",
                    "oPaginate": {
                        "sPrevious": "Prev",
                        "sNext": "Next"
                    }
                },
                "sAjaxSource": "{{ url('dashboard/episodes/list') }}",
                "bServerSide": true
            });
        });
    </script>
@endsection