<?php

namespace AC\Http\Controllers\Dashboard;

use DB;

class MirrorSourceController extends DashboardController
{
    public function getList()
    {
        $list = collect(DB::table('mirror_sources')->get(['id', 'name', 'active']));
        $showColumns = ['name', 'active'];
        $searchColumns = ['name', 'active'];
        $orderColumns = ['name', 'active'];

        return parent::getDataTableList('mirror-sources', $list, $showColumns, $searchColumns, $orderColumns);
    }
}
