<?php

namespace AC\Http\Controllers\Dashboard;

use AC\Models\Title;
use DB;
use Illuminate\Http\Request;

class TitleController extends DashboardController
{
    /**
     * @var Title
     */
    private $title;

    /**
     * @param Title $title
     */
    public function __construct(Title $title)
    {
        $this->title = $title;
    }

    public function index()
    {
        return view('dashboard.titles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function getCreate()
    {
        return view(
            'dashboard.titles.create',
            ['animes' => DB::table('animes')->orderBy('title')->get(['id', 'title'])]
        );
    }

    /**
     * Create a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(Request $request)
    {
        $title = new $this->title;
        $title->title = $request['title'];
        $title->language = $request['language'];
        $title->titleable_id = $request[mb_strtolower($request['titleable_type']) . '_id'];
        $title->titleable_type = $request['titleable_type'];
        $title->active = $request['active'] === '1' ? 1 : 0;
        $title->save();
        $msg = 'Title was created successfully!';

        return redirect()->action('Dashboard\TitleController@index')->with('success', $msg);
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
            'dashboard.titles.edit',
            [
                'title' => DB::table('titles')->where('id', '=', $id)->first(),
                'animes' => DB::table('animes')->orderBy('title')->get(['id', 'title'])
            ]
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
        $title = $this->title->findOrFail($id);
        $title->title = $request['title'];
        $title->language = $request['language'];
        $title->titleable_id = $request[mb_strtolower($request['titleable_type']) . '_id'];
        $title->titleable_type = $request['titleable_type'];
        $title->active = $request['active'] === '1' ? 1 : 0;
        $title->save();
        $msg = 'Title was edited successfully!';

        return redirect()->action('Dashboard\TitleController@index')->with('success', $msg);
    }

    /**
     * Show trash resources.
     *
     * @return \Illuminate\View\View
     */
    public function getTrash()
    {
        return view('dashboard.titles.trash');
    }

    /**
     * Trash resource by id.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postTrash($id = 0)
    {
        $this->title->findOrFail($id)->delete();
        $msg = 'Title was trashed successfully!';

        return redirect()->action('Dashboard\TitleController@index')->with('success', $msg);
    }

    /**
     * Delete resource by id.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDelete($id = 0)
    {
        $this->title->withTrashed()->findOrFail($id)->forceDelete();
        $msg = 'Title was deleted successfully!';

        return redirect()->action('Dashboard\TitleController@getTrash')->with('success', $msg);
    }

    /**
     * Recover resource from trash by id.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRecover($id = 0)
    {
        $this->title->withTrashed()->findOrFail($id)->restore();
        $msg = 'Title was recovered successfully!';

        return redirect()->action('Dashboard\TitleController@getTrash')->with('success', $msg);
    }

    /**
     * Get resource listing
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList()
    {
        $url = 'titles';
        $list = collect(DB::table('titles')->where('deleted_at', '=', null)->get(['id', 'name', 'active']));
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
        $url = 'titles';
        $list = collect(
            DB::table('titles')->where('deleted_at', '<>', '')->get(['id', 'name', 'active'])
        );
        $showColumns = ['name', 'active', 'actions'];
        $searchColumns = ['name', 'active'];
        $orderColumns = ['name', 'active'];

        return parent::getDataTableListTrash($url, $list, $showColumns, $searchColumns, $orderColumns);
    }
}
