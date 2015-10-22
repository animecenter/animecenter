<?php

namespace AC\Http\Controllers\Dashboard;

use DB;

class ProducerController extends DashboardController
{
    public function getList()
    {
        $url = 'producers';
        $list = collect(DB::table('producers')->orderBy('name')->get(['id', 'name', 'active']));
        $showColumns = ['name', 'active', 'actions'];
        $searchColumns = ['name', 'active'];
        $orderColumns = ['name', 'active'];

        return parent::getDataTableList($url, $list, $showColumns, $searchColumns, $orderColumns);
    }
}
