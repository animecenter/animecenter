<?php

namespace AC\Http\Controllers\Dashboard;

use DB;

class GenreController extends DashboardController
{
    public function getList()
    {
        $list = collect(DB::table('genres')->orderBy('name')->get(['id', 'name', 'model', 'active']));
        $showColumns = ['name', 'model', 'active'];
        $searchColumns = ['name', 'model', 'active'];
        $orderColumns = ['name', 'model', 'active'];

        return parent::getDataTableList('genres', $list, $showColumns, $searchColumns, $orderColumns);
    }
}
