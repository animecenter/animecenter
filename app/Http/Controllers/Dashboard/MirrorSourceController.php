<?php

namespace AC\Http\Controllers\Dashboard;

use AC\Models\MirrorSource;
use DB;
use Illuminate\Http\Request;

class MirrorSourceController extends DashboardController
{
    /**
     * @var MirrorSource
     */
    private $mirrorSource;

    /**
     * @param MirrorSource $mirrorSource
     */
    public function __construct(MirrorSource $mirrorSource)
    {
        $this->mirrorSource = $mirrorSource;
    }

    public function index()
    {
        return view('dashboard.mirror-sources.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function getCreate()
    {
        return view('dashboard.mirror-sources.create');
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
        $mirrorSource = new $this->mirrorSource();
        $mirrorSource->name = $request['name'];
        $mirrorSource->active = $request['active'] === '1' ? 1 : 0;
        $mirrorSource->save();
        $msg = 'Mirror source was created successfully!';

        return redirect()->action('Dashboard\MirrorSourceController@index')->with('success', $msg);
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
            'dashboard.mirror-sources.edit',
            ['mirrorSource' => DB::table('mirror_sources')->where('id', '=', $id)->first()]
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
        $mirrorSource = $this->mirrorSource->findOrFail($id);
        $mirrorSource->name = $request['name'];
        $mirrorSource->active = $request['active'] === '1' ? 1 : 0;
        $mirrorSource->save();
        $msg = 'Mirror source was edited successfully!';

        return redirect()->action('Dashboard\MirrorSourceController@index')->with('success', $msg);
    }

    /**
     * Show trash resources.
     *
     * @return \Illuminate\View\View
     */
    public function getTrash()
    {
        return view('dashboard.mirror-sources.index');
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
        $this->mirrorSource->findOrFail($id)->delete();
        $msg = 'Mirror source was trashed successfully!';

        return redirect()->action('Dashboard\MirrorSourceController@index')->with('success', $msg);
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
        $this->mirrorSource->withTrashed()->findOrFail($id)->forceDelete();
        $msg = 'Mirror source was deleted successfully!';

        return redirect()->action('Dashboard\MirrorSourceController@getTrash')->with('success', $msg);
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
        $this->mirrorSource->withTrashed()->findOrFail($id)->restore();
        $msg = 'Mirror source was recovered successfully!';

        return redirect()->action('Dashboard\MirrorSourceController@getTrash')->with('success', $msg);
    }

    /**
     * Get resource listing.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList()
    {
        $url = 'mirror-sources';
        $list = collect(
            DB::table('mirror_sources')->where('deleted_at', '=', null)->get(['id', 'name', 'active'])
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
        $url = 'mirror-sources';
        $list = collect(
            DB::table('mirror_sources')->where('deleted_at', '<>', '')->get(['id', 'name', 'active'])
        );
        $showColumns = ['name', 'active', 'actions'];
        $searchColumns = ['name', 'active'];
        $orderColumns = ['name', 'active'];

        return parent::getDataTableListTrash($url, $list, $showColumns, $searchColumns, $orderColumns);
    }
}
