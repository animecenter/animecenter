<?php

namespace AC\Http\Controllers\Dashboard;

use DB;

class MirrorController extends DashboardController
{
    public function getList()
    {
        $url = 'mirrors';
        $list = collect(DB::table('mirrors')
            ->join('episodes', 'mirrors.episode_id', '=', 'episodes.id')
            ->join('animes', 'episodes.anime_id', '=', 'animes.id')
            ->join('mirror_sources', 'mirrors.mirror_source_id', '=', 'mirror_sources.id')
            ->get([
                'mirrors.id', 'animes.title', 'episodes.number', 'mirror_sources.name', 'mirrors.translation', 'mirrors.quality',
                'mirrors.active'
            ]));
        $showColumns = ['title', 'number', 'name', 'translation', 'quality', 'active', 'actions'];
        $searchColumns = ['title', 'number', 'name', 'translation', 'quality', 'active'];
        $orderColumns = ['title', 'number', 'name', 'translation', 'quality', 'active'];

        return parent::getDataTableList($url, $list, $showColumns, $searchColumns, $orderColumns);
    }
}
