<?php

namespace AC\Http\Controllers\Dashboard;

use AC\Models\Role;
use DB;
use Illuminate\Http\Request;

class RoleController extends DashboardController
{
    /**
     * @var Role
     */
    private $role;

    /**
     * @param Role $role
     */
    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function index()
    {
        return view('dashboard.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function getCreate()
    {
        return view('dashboard.roles.create');
    }

    /**
     * Create a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(Request $request)
    {
        $role = new $this->role;
        $role->name = $request['name'];
        $role->display_name = $request['display_name'];
        $role->description = $request['description'];
        $role->active = $request['active'] === '1' ? 1 : 0;
        $role->save();
        $msg = 'Role was created successfully!';

        return redirect()->action('Dashboard\RoleController@index')->with('success', $msg);
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
            'dashboard.roles.edit',
            ['role' => DB::table('roles')->where('id', '=', $id)->first()]
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
        $role = $this->role->findOrFail($id);
        $role->name = $request['name'];
        $role->display_name = $request['display_name'];
        $role->description = $request['description'];
        $role->active = $request['active'] === '1' ? 1 : 0;
        $role->save();
        $msg = 'Role was edited successfully!';

        return redirect()->action('Dashboard\RoleController@index')->with('success', $msg);
    }

    /**
     * Show trash resources.
     *
     * @return \Illuminate\View\View
     */
    public function getTrash()
    {
        return view('dashboard.roles.trash');
    }

    /**
     * Trash resource by id.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postTrash($id = 0)
    {
        $this->role->findOrFail($id)->delete();
        $msg = 'Role was trashed successfully!';

        return redirect()->action('Dashboard\RoleController@index')->with('success', $msg);
    }

    /**
     * Delete resource by id.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDelete($id = 0)
    {
        $this->role->withTrashed()->findOrFail($id)->forceDelete();
        $msg = 'Role was deleted successfully!';

        return redirect()->action('Dashboard\RoleController@getTrash')->with('success', $msg);
    }

    /**
     * Recover resource from trash by id.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRecover($id = 0)
    {
        $this->role->withTrashed()->findOrFail($id)->restore();
        $msg = 'Role was recovered successfully!';

        return redirect()->action('Dashboard\RoleController@getTrash')->with('success', $msg);
    }

    /**
     * Get resource listing
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList()
    {
        $url = 'roles';
        $list = collect(
            DB::table('roles')->where('deleted_at', '=', null)->get(['id', 'name', 'display_name', 'active'])
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
        $url = 'roles';
        $list = collect(
            DB::table('roles')->where('deleted_at', '<>', '')->get(['id', 'name', 'display_name', 'active'])
        );
        $showColumns = ['name', 'display_name', 'active', 'actions'];
        $searchColumns = ['name', 'display_name', 'active'];
        $orderColumns = ['name', 'display_name', 'active'];

        return parent::getDataTableListTrash($url, $list, $showColumns, $searchColumns, $orderColumns);
    }
}
