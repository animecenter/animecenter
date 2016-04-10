<?php

namespace AC\Http\Controllers\Dashboard;

use AC\Http\Controllers\Controller;
use Datatable;
use FA;
use Form;
use Html;
use Illuminate\Support\Collection;
use stdClass;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('dashboard.index');
    }

    /**
     * @param $url
     * @param Collection $list
     * @param array      $showColumns
     * @param array      $searchColumns
     * @param array      $orderColumns
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDataTableList($url, Collection $list, $showColumns = [], $searchColumns = [], $orderColumns = [])
    {
        return Datatable::collection($list)
            ->showColumns($showColumns)
            ->searchColumns($searchColumns)
            ->orderColumns($orderColumns)
            ->addColumn('active', function (stdClass $model) {
                return $model->active === 1 ? 'Active' : 'Inactive';
            })
            ->addColumn('actions', function (stdClass $model) use ($url) {
                $editIcon = FA::icon('pencil-square-o')->__toString().' ';
                $trashIcon = FA::icon('trash-o')->__toString().' ';
                $editUrl = url('dashboard/'.$url.'/edit', $model->id);
                $trashUrl = url('dashboard/'.$url.'/trash', $model->id);

                return html_entity_decode(
                    Html::link($editUrl, $editIcon.'', ['class' => 'btn btn-sm btn-warning pull-left']).
                    Form::open(['url' => $trashUrl]).
                    Form::button($trashIcon, ['class' => 'btn btn-sm btn-danger', 'type' => 'submit']).
                    Form::close()
                );
            })->make();
    }

    /**
     * @param $url
     * @param Collection $list
     * @param array      $showColumns
     * @param array      $searchColumns
     * @param array      $orderColumns
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDataTableListTrash($url, Collection $list, $showColumns = [], $searchColumns = [], $orderColumns = [])
    {
        return Datatable::collection($list)
            ->showColumns($showColumns)
            ->searchColumns($searchColumns)
            ->orderColumns($orderColumns)
            ->addColumn('active', function (stdClass $model) {
                return $model->active === 1 ? 'Active' : 'Inactive';
            })
            ->addColumn('actions', function (stdClass $model) use ($url) {
                $recoverIcon = FA::icon('exchange')->__toString().' ';
                $deleteIcon = FA::icon('trash-o')->__toString().' ';
                $recoverURL = url('dashboard/'.$url.'/recover', $model->id);
                $deleteURL = url('dashboard/'.$url.'/delete', $model->id);

                return html_entity_decode(
                    Form::open(['url' => $recoverURL]).
                    Form::button($recoverIcon, ['class' => 'btn btn-sm btn-success pull-left', 'type' => 'submit']).
                    Form::close().
                    Form::open(['url' => $deleteURL]).
                    Form::button($deleteIcon, ['class' => 'btn btn-sm btn-danger', 'type' => 'submit']).
                    Form::close()
                );
            })->make();
    }
}
