<?php

namespace AC\Http\Controllers\Dashboard;

use AC\Models\Meta;
use DB;
use Illuminate\Http\Request;

class MetaController extends DashboardController
{
    /**
     * @var Meta
     */
    private $meta;

    /**
     * @param Meta $meta
     */
    public function __construct(Meta $meta)
    {
        $this->meta = $meta;
    }

    public function index()
    {
        return view('dashboard.metas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function getCreate()
    {
        return view('dashboard.metas.create', ['routes' => $this->meta->routes()]);
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
        $meta = new $this->meta();
        $meta->route = $request['route'];
        $meta->title = $request['title'];
        $meta->keywords = $request['keywords'];
        $meta->description = $request['description'];
        $meta->active = $request['active'] === '1' ? 1 : 0;
        $meta->save();
        $msg = 'Meta was created successfully!';

        return redirect()->action('Dashboard\MetaController@index')->with('success', $msg);
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
            'dashboard.metas.edit',
            ['meta' => DB::table('metas')->where('id', '=', $id)->first()]
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
        $meta = $this->meta->findOrFail($id);
        $meta->route = $request['route'];
        $meta->title = $request['title'];
        $meta->keywords = $request['keywords'];
        $meta->description = $request['description'];
        $meta->active = $request['active'] === '1' ? 1 : 0;
        $meta->save();
        $msg = 'Meta was edited successfully!';

        return redirect()->action('Dashboard\MetaController@index')->with('success', $msg);
    }

    /**
     * Show trash resources.
     *
     * @return \Illuminate\View\View
     */
    public function getTrash()
    {
        return view('dashboard.metas.index');
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
        $this->meta->findOrFail($id)->delete();
        $msg = 'Meta was trashed successfully!';

        return redirect()->action('Dashboard\MetaController@index')->with('success', $msg);
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
        $this->meta->withTrashed()->findOrFail($id)->forceDelete();
        $msg = 'Meta was deleted successfully!';

        return redirect()->action('Dashboard\MetaController@getTrash')->with('success', $msg);
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
        $this->meta->withTrashed()->findOrFail($id)->restore();
        $msg = 'Meta was recovered successfully!';

        return redirect()->action('Dashboard\MetaController@getTrash')->with('success', $msg);
    }

    /**
     * Get resource listing.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList()
    {
        $url = 'metas';
        $list = collect(
            DB::table('metas')->where('deleted_at', '=', null)->get(['id', 'route', 'title', 'active'])
        );
        $showColumns = ['route', 'title', 'active', 'actions'];
        $searchColumns = ['route', 'title', 'active'];
        $orderColumns = ['route', 'title', 'active'];

        return parent::getDataTableList($url, $list, $showColumns, $searchColumns, $orderColumns);
    }

    /**
     * Get trash resource listing.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getListTrash()
    {
        $url = 'metas';
        $list = collect(
            DB::table('metas')->where('deleted_at', '<>', '')->get(['id', 'route', 'title', 'active'])
        );
        $showColumns = ['route', 'title', 'active', 'actions'];
        $searchColumns = ['route', 'title', 'active'];
        $orderColumns = ['route', 'title', 'active'];

        return parent::getDataTableListTrash($url, $list, $showColumns, $searchColumns, $orderColumns);
    }
}
