<?php

namespace AC\Http\Controllers\Dashboard;

use DB;

class ProducerController extends DashboardController
{
    public function index()
    {
        return view('dashboard.producers.index');
    }

    public function getList()
    {
        $list = collect(DB::table('producers')->get(['id', 'name']));

        return parent::getDataTableList('producers', $list, ['name', 'actions'], ['name'], ['name']);
    }
}
