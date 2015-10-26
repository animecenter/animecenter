<?php

namespace AC\Http\Controllers\Dashboard;

use AC\Models\Producer;
use DB;
use Illuminate\Http\Request;

class ProducerController extends DashboardController
{
    /**
     * @var Producer
     */
    private $producer;

    /**
     * @param Producer $producer
     */
    public function __construct(Producer $producer)
    {
        $this->producer = $producer;
    }

    public function index()
    {
        return view('dashboard.producers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function getCreate()
    {
        return view('dashboard.producers.create');
    }

    /**
     * Create a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(Request $request)
    {
        $producer = new $this->producer;
        $producer->name = $request['name'];
        $producer->active = $request['active'] === '1' ? 1 : 0;
        $producer->save();
        $msg = 'Producers was created successfully!';

        return redirect()->action('Dashboard\ProducerController@index')->with('success', $msg);
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
            'dashboard.producers.edit',
            ['producer' => DB::table('producers')->where('id', '=', $id)->first()]
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
        $producer = $this->producer->findOrFail($id);
        $producer->name = $request['name'];
        $producer->active = $request['active'] === '1' ? 1 : 0;
        $producer->save();
        $msg = 'Producers was created successfully!';

        return redirect()->action('Dashboard\ProducerController@index')->with('success', $msg);
    }

    /**
     * Show trash resources.
     *
     * @return \Illuminate\View\View
     */
    public function getTrash()
    {
        return view('dashboard.producers.trash');
    }

    /**
     * Trash resource by id.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postTrash($id = 0)
    {
        $this->producer->findOrFail($id)->delete();
        $msg = 'Producers was trashed successfully!';

        return redirect()->action('Dashboard\ProducerController@index')->with('success', $msg);
    }

    /**
     * Delete resource by id.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDelete($id = 0)
    {
        $this->producer->withTrashed()->findOrFail($id)->forceDelete();
        $msg = 'Producers was deleted successfully!';

        return redirect()->action('Dashboard\ProducerController@getTrash')->with('success', $msg);
    }

    /**
     * Recover resource from trash by id.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRecover($id = 0)
    {
        $this->producer->withTrashed()->findOrFail($id)->restore();
        $msg = 'Producers was recovered successfully!';

        return redirect()->action('Dashboard\ProducerController@getTrash')->with('success', $msg);
    }

    /**
     * Get resource listing
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList()
    {
        $url = 'producers';
        $list = collect(
            DB::table('producers')->where('deleted_at', '=', null)->get(['id', 'name', 'active'])
        );
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
        $url = 'producers';
        $list = collect(
            DB::table('producers')->where('deleted_at', '<>', '')->get(['id', 'name', 'active'])
        );
        $showColumns = ['name', 'active', 'actions'];
        $searchColumns = ['name', 'active'];
        $orderColumns = ['name', 'active'];

        return parent::getDataTableListTrash($url, $list, $showColumns, $searchColumns, $orderColumns);
    }
}
