<?php

namespace AC\Http\Controllers\Dashboard;

use AC\Http\Controllers\Controller;
use AC\Http\Requests;
use Datatable;
use DB;
use FA;
use Form;
use Html;

class GenreController extends Controller
{
    public function index()
    {
        return view('dashboard.genres.index');
    }

    public function getList()
    {
        $list = collect(DB::table('genres')->get(['genres.id', 'genres.name', 'genres.model']));

        return Datatable::collection($list)
            ->showColumns('name', 'model', 'actions')
            ->searchColumns(['name', 'model'])
            ->orderColumns('name', 'model')
            ->addColumn('actions', function ($model) {
                $editIcon = FA::icon('pencil-square-o')->__toString() . ' ';
                $deleteIcon = FA::icon('trash-o')->__toString() . ' ';
                $editUrl = url('dashboard/genres/edit', $model->id);
                $deleteUrl = url('dashboard/genres/delete', $model->id);
                return html_entity_decode(
                    Html::link($editUrl, $editIcon . '', ['class' => 'btn btn-sm btn-warning pull-left']).
                    Form::open(['url' => $deleteUrl, 'class' => '']).
                    Form::button($deleteIcon, ['class' => 'btn btn-sm btn-danger btn-delete', 'type' => 'submit']).
                    Form::close()
                );
            })->make();
    }
}
