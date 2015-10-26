<?php

namespace AC\Http\Controllers\Dashboard;

use DB;

class StatusController extends DashboardController
{
    public function getList()
    {
        $url = 'statuses';
        $list = collect(DB::table('statuses')->get(['id', 'name', 'active']));
        $showColumns = ['name', 'active', 'actions'];
        $searchColumns = ['name', 'active'];
        $orderColumns = ['name', 'active'];

        return parent::getDataTableList($url, $list, $showColumns, $searchColumns, $orderColumns);
    }
}
