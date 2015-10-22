<?php

namespace AC\Http\Controllers\Dashboard;

use DB;

class ClassificationController extends DashboardController
{
    public function getList()
    {
        $slug = 'classifications';
        $list = collect(DB::table('classifications')->orderBy('name')->get(['id', 'name', 'active']));
        $showColumns = [];

        return parent::getDataTableList(
            $slug, $list, ['name', 'active'], ['name', 'active'], ['name', 'active']
        );
    }
}
