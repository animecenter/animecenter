<?php

namespace AC\Http\Controllers\Dashboard;

use DB;

class MirrorSourceController extends DashboardController
{
    public function getList()
    {
        $url = 'mirror-sources';
        $list = collect(DB::table('mirror_sources')->get(['id', 'name', 'active']));
        $showColumns = ['name', 'active', 'actions'];
        $searchColumns = ['name', 'active'];
        $orderColumns = ['name', 'active'];

        return parent::getDataTableList($url, $list, $showColumns, $searchColumns, $orderColumns);
    }
}
