<?php

namespace AC\Http\Controllers\Dashboard;

use AC\Models\Classification;
use DB;
use Illuminate\Http\Request;

class ClassificationController extends DashboardController
{
    /**
     * @var Classification
     */
    private $classification;

    /**
     * @param Classification $classification
     */
    public function __construct(Classification $classification)
    {
        $this->classification = $classification;
    }

    public function index()
    {
        return view('dashboard.classifications.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function getCreate()
    {
        return view('dashboard.classifications.create');
    }

    /**
     * Create a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(Request $request)
    {
        $classification = new $this->classification;
        $classification->name = $request['name'];
        $classification->active = $request['active'] === '1' ? 1 : 0;
        $classification->save();
        $msg = 'Classification was created successfully!';

        return redirect()->action('Dashboard\ClassificationController@index')->with('success', $msg);
    }

    /**
     * Show the form for editing a resource.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function getEdit($id = 0)
    {
        return view(
            'dashboard.classifications.edit',
            ['classification' => DB::table('classifications')->where('id', '=', $id)->first()]
        );
    }

    /**
     * Edit a resource.
     *
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit($id = 0, Request $request)
    {
        $classification = $this->classification->findOrFail($id);
        $classification->name = $request['name'];
        $classification->active = $request['active'] === '1' ? 1 : 0;
        $classification->save();
        $msg = 'Classification was edited successfully!';

        return redirect()->action('Dashboard\ClassificationController@index')->with('success', $msg);
    }

    /**
     * Show trash resources.
     *
     * @return \Illuminate\View\View
     */
    public function getTrash()
    {
        return view('dashboard.classifications.trash');
    }

    /**
     * Trash resource by id.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postTrash($id = 0)
    {
        $this->classification->findOrFail($id)->delete();
        $msg = 'Classification was trashed successfully!';

        return redirect()->action('Dashboard\ClassificationController@index')->with('success', $msg);
    }

    /**
     * Delete resource by id.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDelete($id = 0)
    {
        $this->classification->withTrashed()->findOrFail($id)->forceDelete();
        $msg = 'Classification was deleted successfully!';

        return redirect()->action('Dashboard\ClassificationController@getTrash')->with('success', $msg);
    }

    /**
     * Recover resource from trash by id.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRecover($id = 0)
    {
        $this->classification->withTrashed()->findOrFail($id)->restore();
        $msg = 'Classification was recovered successfully!';

        return redirect()->action('Dashboard\ClassificationController@getTrash')->with('success', $msg);
    }

    /**
     * Get resource listing
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList()
    {
        $url = 'classifications';
        $list = collect(DB::table('classifications')->where('deleted_at', '=', null)->get(['id', 'name', 'active']));
        $showColumns = ['name', 'active', 'actions'];
        $searchColumns = ['name', 'active'];
        $orderColumns = ['name', 'active'];

        return parent::getDataTableList($url, $list, $showColumns, $searchColumns, $orderColumns);
    }

    /**
     * Get trash resource listing
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getListTrash()
    {
        $url = 'classifications';
        $list = collect(
            DB::table('classifications')->where('deleted_at', '<>', '')->get(['id', 'name', 'active'])
        );
        $showColumns = ['name', 'active', 'actions'];
        $searchColumns = ['name', 'active'];
        $orderColumns = ['name', 'active'];

        return parent::getDataTableListTrash($url, $list, $showColumns, $searchColumns, $orderColumns);
    }
}
