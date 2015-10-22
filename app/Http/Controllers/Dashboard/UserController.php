<?php

namespace AC\Http\Controllers\Dashboard;

use DB;

class UserController extends DashboardController
{
    public function getList()
    {
        $url = 'users';
        $list = collect(DB::table('users')->get(['id', 'username', 'email', 'active']));
        $showColumns = ['username', 'email', 'active', 'actions'];
        $searchColumns = ['username', 'email', 'active'];
        $orderColumns = ['username', 'email', 'active'];

        return parent::getDataTableList($url, $list, $showColumns, $searchColumns, $orderColumns);
    }
}
