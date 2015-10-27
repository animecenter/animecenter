<?php

namespace AC\Http\Controllers\Dashboard;

use AC\Models\Permission;
use DB;
use Illuminate\Http\Request;

class PermissionController extends DashboardController
{
    /**
     * @var Permission
     */
    private $permission;

    /**
     * @param Permission $permission
     */
    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    public function index()
    {
        return view('dashboard.permissions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function getCreate()
    {
        return view('dashboard.permissions.create');
    }

    /**
     * Create a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(Request $request)
    {
        $permission = new $this->permission;
        $permission->name = $request['name'];
        $permission->display_name = $request['display_name'];
        $permission->description = $request['description'];
        $permission->active = $request['active'] === '1' ? 1 : 0;
        $permission->save();
        $msg = 'Permission was created successfully!';

        return redirect()->action('Dashboard\PermissionController@index')->with('success', $msg);
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
            'dashboard.permissions.edit',
            ['permission' => DB::table('permissions')->where('id', '=', $id)->first()]
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
        $permission = $this->permission->findOrFail($id);
        $permission->name = $request['name'];
        $permission->display_name = $request['display_name'];
        $permission->description = $request['description'];
        $permission->active = $request['active'] === '1' ? 1 : 0;
        $permission->save();
        $msg = 'Permission was edited successfully!';

        return redirect()->action('Dashboard\PermissionController@index')->with('success', $msg);
    }

    /**
     * Show trash resources.
     *
     * @return \Illuminate\View\View
     */
    public function getTrash()
    {
        return view('dashboard.permissions.trash');
    }

    /**
     * Trash resource by id.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postTrash($id = 0)
    {
        $this->permission->findOrFail($id)->delete();
        $msg = 'Permission was trashed successfully!';

        return redirect()->action('Dashboard\PermissionController@index')->with('success', $msg);
    }

    /**
     * Delete resource by id.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDelete($id = 0)
    {
        $this->permission->withTrashed()->findOrFail($id)->forceDelete();
        $msg = 'Permission was deleted successfully!';

        return redirect()->action('Dashboard\PermissionController@getTrash')->with('success', $msg);
    }

    /**
     * Recover resource from trash by id.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRecover($id = 0)
    {
        $this->permission->withTrashed()->findOrFail($id)->restore();
        $msg = 'Permission was recovered successfully!';

        return redirect()->action('Dashboard\PermissionController@getTrash')->with('success', $msg);
    }

    /**
     * Get resource listing
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList()
    {
        $url = 'permissions';
        $list = collect(
            DB::table('permissions')->where('deleted_at', '=', null)->get(['id', 'name', 'display_name', 'active'])
        );
        $showColumns = ['name', 'display_name', 'active', 'actions'];
        $searchColumns = ['name', 'display_name', 'active'];
        $orderColumns = ['name', 'display_name', 'active'];

        return parent::getDataTableList($url, $list, $showColumns, $searchColumns, $orderColumns);
    }

    /**
     * Get trash resource listing
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getListTrash()
    {
        $url = 'permissions';
        $list = collect(
            DB::table('permissions')->where('deleted_at', '<>', '')->get(['id', 'name', 'display_name', 'active'])
        );
        $showColumns = ['name', 'display_name', 'active', 'actions'];
        $searchColumns = ['name', 'display_name', 'active'];
        $orderColumns = ['name', 'display_name', 'active'];

        return parent::getDataTableListTrash($url, $list, $showColumns, $searchColumns, $orderColumns);
    }
}
