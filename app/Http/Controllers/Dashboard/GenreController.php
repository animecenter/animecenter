<?php

namespace AC\Http\Controllers\Dashboard;

use DB;

class GenreController extends DashboardController
{
    public function getList()
    {
        $url = 'genres';
        $list = collect(DB::table('genres')->orderBy('name')->get(['id', 'name', 'model', 'active']));
        $showColumns = ['name', 'model', 'active', 'actions'];
        $searchColumns = ['name', 'model', 'active'];
        $orderColumns = ['name', 'model', 'active'];

        return parent::getDataTableList($url, $list, $showColumns, $searchColumns, $orderColumns);
    }
}
