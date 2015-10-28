<?php

namespace AC\Http\Controllers\Dashboard;

use AC\Models\Type;
use DB;
use Illuminate\Http\Request;

class TypeController extends DashboardController
{
    /**
     * @var Type
     */
    private $type;

    /**
     * @param Type $type
     */
    public function __construct(Type $type)
    {
        $this->type = $type;
    }

    public function index()
    {
        return view('dashboard.types.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function getCreate()
    {
        return view('dashboard.types.create');
    }

    /**
     * Create a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(Request $request)
    {
        $type = new $this->type;
        $type->name = $request['name'];
        $type->model = $request['model'];
        $type->active = $request['active'] === '1' ? 1 : 0;
        $type->save();
        $msg = 'Type was created successfully!';

        return redirect()->action('Dashboard\TypeController@index')->with('success', $msg);
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
            'dashboard.types.edit',
            ['type' => DB::table('types')->where('id', '=', $id)->first()]
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
        $type = $this->type->findOrFail($id);
        $type->name = $request['name'];
        $type->model = $request['model'];
        $type->active = $request['active'] === '1' ? 1 : 0;
        $type->save();
        $msg = 'Type was edited successfully!';

        return redirect()->action('Dashboard\TypeController@index')->with('success', $msg);
    }

    /**
     * Show trash resources.
     *
     * @return \Illuminate\View\View
     */
    public function getTrash()
    {
        return view('dashboard.types.index');
    }

    /**
     * Trash resource by id.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postTrash($id = 0)
    {
        $this->type->findOrFail($id)->delete();
        $msg = 'Type was trashed successfully!';

        return redirect()->action('Dashboard\TypeController@index')->with('success', $msg);
    }

    /**
     * Delete resource by id.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDelete($id = 0)
    {
        $this->type->withTrashed()->findOrFail($id)->forceDelete();
        $msg = 'Type was deleted successfully!';

        return redirect()->action('Dashboard\TypeController@getTrash')->with('success', $msg);
    }

    /**
     * Recover resource from trash by id.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRecover($id = 0)
    {
        $this->type->withTrashed()->findOrFail($id)->restore();
        $msg = 'Type was recovered successfully!';

        return redirect()->action('Dashboard\TypeController@getTrash')->with('success', $msg);
    }

    /**
     * Get resource listing
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList()
    {
        $url = 'types';
        $list = collect(
            DB::table('types')->where('deleted_at', '=', null)->get(['id', 'name', 'model', 'active'])
        );
        $showColumns = ['name', 'model', 'active', 'actions'];
        $searchColumns = ['name', 'model', 'active'];
        $orderColumns = ['name', 'model', 'active'];

        return parent::getDataTableList($url, $list, $showColumns, $searchColumns, $orderColumns);
    }

    /**
     * Get trash resource listing
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getListTrash()
    {
        $url = 'types';
        $list = collect(
            DB::table('types')->where('deleted_at', '<>', '')->get(['id', 'name', 'model', 'active'])
        );
        $showColumns = ['name', 'model', 'active', 'actions'];
        $searchColumns = ['name', 'model', 'active'];
        $orderColumns = ['name', 'model', 'active'];

        return parent::getDataTableListTrash($url, $list, $showColumns, $searchColumns, $orderColumns);
    }
}
