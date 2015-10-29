<?php

namespace AC\Http\Controllers\Dashboard;

use AC\Models\User;
use DB;
use Illuminate\Http\Request;

class UserController extends DashboardController
{
    /**
     * @var User
     */
    private $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        return view('dashboard.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function getCreate()
    {
        return view('dashboard.users.create');
    }

    /**
     * Create a new resource.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(Request $request)
    {
        $user = new $this->user();
        $user->username = $request['username'];
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);
        $user->active = $request['active'] === '1' ? 1 : 0;
        $user->save();
        $msg = 'User was created successfully!';

        return redirect()->action('Dashboard\UserController@index')->with('success', $msg);
    }

    /**
     * Show the form for editing a resource.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function getEdit($id = 0)
    {
        return view(
            'dashboard.users.edit',
            ['user' => DB::table('users')->where('id', '=', $id)->first()]
        );
    }

    /**
     * Edit a resource.
     *
     * @param int     $id
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit($id = 0, Request $request)
    {
        $user = $this->user->findOrFail($id);
        $user->username = $request['username'];
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);
        $user->active = $request['active'] === '1' ? 1 : 0;
        $user->save();
        $msg = 'User was edited successfully!';

        return redirect()->action('Dashboard\UserController@index')->with('success', $msg);
    }

    /**
     * Show trash resources.
     *
     * @return \Illuminate\View\View
     */
    public function getTrash()
    {
        return view('dashboard.users.index');
    }

    /**
     * Trash resource by id.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postTrash($id = 0)
    {
        $this->user->findOrFail($id)->delete();
        $msg = 'User was trashed successfully!';

        return redirect()->action('Dashboard\UserController@index')->with('success', $msg);
    }

    /**
     * Delete resource by id.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDelete($id = 0)
    {
        $this->user->withTrashed()->findOrFail($id)->forceDelete();
        $msg = 'User was deleted successfully!';

        return redirect()->action('Dashboard\UserController@getTrash')->with('success', $msg);
    }

    /**
     * Recover resource from trash by id.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRecover($id = 0)
    {
        $this->user->withTrashed()->findOrFail($id)->restore();
        $msg = 'User was recovered successfully!';

        return redirect()->action('Dashboard\UserController@getTrash')->with('success', $msg);
    }

    /**
     * Get resource listing.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList()
    {
        $url = 'users';
        $list = collect(
            DB::table('users')->where('deleted_at', '=', null)->get(['id', 'username', 'email', 'active'])
        );
        $showColumns = ['username', 'email', 'active', 'actions'];
        $searchColumns = ['username', 'email', 'active'];
        $orderColumns = ['username', 'email', 'active'];

        return parent::getDataTableList($url, $list, $showColumns, $searchColumns, $orderColumns);
    }

    /**
     * Get trash resource listing.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getListTrash()
    {
        $url = 'users';
        $list = collect(
            DB::table('users')->where('deleted_at', '<>', '')->get(['id', 'username', 'email', 'active'])
        );
        $showColumns = ['username', 'email', 'active', 'actions'];
        $searchColumns = ['username', 'email', 'active'];
        $orderColumns = ['username', 'email', 'active'];

        return parent::getDataTableListTrash($url, $list, $showColumns, $searchColumns, $orderColumns);
    }
}
