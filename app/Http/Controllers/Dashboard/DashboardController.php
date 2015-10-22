<?php

namespace AC\Http\Controllers\Dashboard;

use AC\Http\Controllers\Controller;
use Datatable;
use FA;
use Form;
use Html;
use Illuminate\Support\Collection;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param string $slug
     * @return \Illuminate\View\View
     */
    public function index($slug = '')
    {
        if ($slug) {
            return view('dashboard.' . $slug . '.index');
        }
        return view('dashboard.index');
    }

    public function getDataTableList($url = '', Collection $list, $showColumns = [], $searchColumns = [], $orderColumns = [])
    {
        return Datatable::collection($list)
            ->showColumns($showColumns)
            ->searchColumns($searchColumns)
            ->orderColumns($orderColumns)
            ->addColumn('active', function ($model) {
                return $model->active === 1 ? 'Active' : 'Inactive';
            })
            ->addColumn('actions', function ($model) use ($url) {
                $editIcon = FA::icon('pencil-square-o')->__toString() . ' ';
                $deleteIcon = FA::icon('trash-o')->__toString() . ' ';
                $editUrl = url('dashboard/' . $url . '/edit', $model->id);
                $deleteUrl = url('dashboard/' . $url . '/delete', $model->id);
                return html_entity_decode(
                    Html::link($editUrl, $editIcon . '', ['class' => 'btn btn-sm btn-warning pull-left']).
                    Form::open(['url' => $deleteUrl]).
                    Form::button($deleteIcon, ['class' => 'btn btn-sm btn-danger btn-delete', 'type' => 'submit']).
                    Form::close()
                );
            })->make();
    }
}
