<?php

namespace AC\Http\Controllers\Dashboard;

use AC\Http\Controllers\Controller;
use Datatable;
use DB;
use FA;
use Form;
use Html;

class MirrorSourceController extends Controller
{
    public function index()
    {
        return view('dashboard.mirror-sources.index');
    }

    public function getList()
    {
        $list = collect(DB::table('mirror_sources')->get(['id', 'name']));

        return Datatable::collection($list)
            ->showColumns('name', 'actions')
            ->searchColumns(['name'])
            ->orderColumns('name')
            ->addColumn('actions', function ($model) {
                $editIcon = FA::icon('pencil-square-o')->__toString() . ' ';
                $deleteIcon = FA::icon('trash-o')->__toString() . ' ';
                $editUrl = url('dashboard/mirror-sources/edit', $model->id);
                $deleteUrl = url('dashboard/mirror-sources/delete', $model->id);
                return html_entity_decode(
                    Html::link($editUrl, $editIcon . '', ['class' => 'btn btn-sm btn-warning pull-left']).
                    Form::open(['url' => $deleteUrl, 'class' => '']).
                    Form::button($deleteIcon, ['class' => 'btn btn-sm btn-danger btn-delete', 'type' => 'submit']).
                    Form::close()
                );
            })->make();
    }
}
