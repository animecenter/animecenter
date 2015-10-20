<?php

namespace AC\Http\Controllers\Dashboard;

use DB;

class CalendarSeasonController extends DashboardController
{
    public function index()
    {
        return view('dashboard.calendar-seasons.index');
    }

    public function getList()
    {
        $list = collect(DB::table('calendar_seasons')->get(['id', 'name', 'active']));

        return parent::getDataTableList(
            'calendar-seasons', $list, ['name', 'active', 'actions'], ['name', 'active'], ['name', 'active']
        );
    }
}