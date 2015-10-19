<?php

namespace AC\Http\Controllers\Dashboard;

use DB;

class MenuController extends DashboardController
{
    public function index()
    {
        return view('dashboard.mirror-sources.index');
    }

    public function getList()
    {
        $list = collect(DB::table('mirror_sources')->get(['id', 'name']));

        return parent::getList('mirror-sources', $list, ['name', 'actions'], ['name'], ['name']);
    }
}
