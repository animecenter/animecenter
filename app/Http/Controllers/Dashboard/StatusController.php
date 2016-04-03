<?php

namespace AC\Http\Controllers\Dashboard;

use AC\Models\Status;
use DB;
use Illuminate\Http\Request;

class StatusController extends DashboardController
{
    /**
     * @var Status
     */
    private $status;

    /**
     * @param Status $status
     */
    public function __construct(Status $status)
    {
        $this->status = $status;
    }

    public function index()
    {
        return view('dashboard.statuses.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function getCreate()
    {
        return view('dashboard.statuses.create');
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
        $status = new $this->status();
        $status->name = $request['name'];
        $status->active = $request['active'] === '1' ? 1 : 0;
        $status->save();
        $msg = 'Status was created successfully!';

        return redirect()->action('Dashboard\StatusController@index')->with('success', $msg);
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
            'dashboard.statuses.edit',
            ['status' => DB::table('statuses')->where('id', '=', $id)->first()]
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
    public function postEdit($id, Request $request)
    {
        $status = $this->status->findOrFail($id);
        $status->name = $request['name'];
        $status->active = $request['active'] === '1' ? 1 : 0;
        $status->save();
        $msg = 'Status was edited successfully!';

        return redirect()->action('Dashboard\StatusController@index')->with('success', $msg);
    }

    /**
     * Show trash resources.
     *
     * @return \Illuminate\View\View
     */
    public function getTrash()
    {
        return view('dashboard.statuses.index');
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
        $this->status->findOrFail($id)->delete();
        $msg = 'Status was trashed successfully!';

        return redirect()->action('Dashboard\StatusController@index')->with('success', $msg);
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
        $this->status->withTrashed()->findOrFail($id)->forceDelete();
        $msg = 'Status was deleted successfully!';

        return redirect()->action('Dashboard\StatusController@getTrash')->with('success', $msg);
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
        $this->status->withTrashed()->findOrFail($id)->restore();
        $msg = 'Status was recovered successfully!';

        return redirect()->action('Dashboard\StatusController@getTrash')->with('success', $msg);
    }

    /**
     * Get resource listing.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList()
    {
        $url = 'statuses';
        $list = collect(
            DB::table('statuses')->where('deleted_at', '=', null)->get(['id', 'name', 'active'])
        );
        $showColumns = ['name', 'active', 'actions'];
        $searchColumns = ['name', 'active'];
        $orderColumns = ['name', 'active'];

        return parent::getDataTableList($url, $list, $showColumns, $searchColumns, $orderColumns);
    }

    /**
     * Get trash resource listing.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getListTrash()
    {
        $url = 'statuses';
        $list = collect(
            DB::table('statuses')->where('deleted_at', '<>', '')->get(['id', 'name', 'active'])
        );
        $showColumns = ['name', 'active', 'actions'];
        $searchColumns = ['name', 'active'];
        $orderColumns = ['name', 'active'];

        return parent::getDataTableListTrash($url, $list, $showColumns, $searchColumns, $orderColumns);
    }
}
