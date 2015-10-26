<?php

namespace AC\Http\Controllers\Dashboard;

use DB;

class TypeController extends DashboardController
{
    public function getList()
    {
        $url = 'types';
        $list = collect(DB::table('types')->get(['id', 'name', 'model', 'active']));
        $showColumns = ['name', 'model', 'active', 'actions'];
        $searchColumns = ['name', 'model', 'active'];
        $orderColumns = ['name', 'model', 'active'];

        return parent::getDataTableList($url, $list, $showColumns, $searchColumns, $orderColumns);
    }
}
