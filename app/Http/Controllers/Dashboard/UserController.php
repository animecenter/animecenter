<?php

namespace AC\Http\Controllers\Dashboard;

use DB;

class UserController extends DashboardController
{
    public function getList()
    {
        $list = collect(DB::table('users')->get(['id', 'username', 'email', 'active']));
        $showColumns = ['username', 'email', 'active'];
        $searchColumns = ['username', 'email', 'active'];
        $orderColumns = ['username', 'email', 'active'];

        return parent::getDataTableList('users', $list, $showColumns, $searchColumns, $orderColumns);
    }
}
