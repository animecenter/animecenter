<?php

namespace AC\Http\Controllers\Dashboard;

use DB;

class MenuController extends DashboardController
{
    public function getList()
    {
        $url = 'menus';
        $list = collect(DB::table('menus')->get(['id', 'name', 'active']));
        $showColumns = ['name', 'active', 'actions'];
        $searchColumns = ['name', 'active'];
        $orderColumns = ['name', 'active'];

        return parent::getDataTableList($url, $list, $showColumns, $searchColumns, $orderColumns);
    }
}
