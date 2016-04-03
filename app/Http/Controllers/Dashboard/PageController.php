<?php

namespace AC\Http\Controllers\Dashboard;

use AC\Models\Page;
use DB;
use Illuminate\Http\Request;

class PageController extends DashboardController
{
    /**
     * @var Page
     */
    private $page;

    /**
     * @param Page $page
     */
    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    public function index()
    {
        return view('dashboard.pages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function getCreate()
    {
        return view('dashboard.pages.create');
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
        $page = new $this->page();
        $page->title = $request['title'];
        $page->slug = $request['slug'];
        $page->content = $request['content'];
        $page->active = $request['active'] === '1' ? 1 : 0;
        $page->save();
        $msg = 'Page was created successfully!';

        return redirect()->action('Dashboard\PageController@index')->with('success', $msg);
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
            'dashboard.pages.edit',
            ['page' => DB::table('pages')->where('id', '=', $id)->first()]
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
        $page = $this->page->findOrFail($id);
        $page->title = $request['title'];
        $page->slug = $request['slug'];
        $page->content = $request['content'];
        $page->active = $request['active'] === '1' ? 1 : 0;
        $page->save();
        $msg = 'Page was edited successfully!';

        return redirect()->action('Dashboard\PageController@index')->with('success', $msg);
    }

    /**
     * Show trash resources.
     *
     * @return \Illuminate\View\View
     */
    public function getTrash()
    {
        return view('dashboard.pages.index');
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
        $this->page->findOrFail($id)->delete();
        $msg = 'Page was trashed successfully!';

        return redirect()->action('Dashboard\PageController@index')->with('success', $msg);
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
        $this->page->withTrashed()->findOrFail($id)->forceDelete();
        $msg = 'Page was deleted successfully!';

        return redirect()->action('Dashboard\PageController@getTrash')->with('success', $msg);
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
        $this->page->withTrashed()->findOrFail($id)->restore();
        $msg = 'Page was recovered successfully!';

        return redirect()->action('Dashboard\PageController@getTrash')->with('success', $msg);
    }

    /**
     * Get resource listing.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList()
    {
        $url = 'pages';
        $list = collect(
            DB::table('pages')->where('deleted_at', '=', null)->get(['id', 'title', 'slug', 'active'])
        );
        $showColumns = ['title', 'slug', 'active', 'actions'];
        $searchColumns = ['title', 'slug', 'active'];
        $orderColumns = ['title', 'slug', 'active'];

        return parent::getDataTableList($url, $list, $showColumns, $searchColumns, $orderColumns);
    }

    /**
     * Get trash resource listing.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getListTrash()
    {
        $url = 'pages';
        $list = collect(
            DB::table('pages')->where('deleted_at', '<>', '')->get(['id', 'title', 'slug', 'active'])
        );
        $showColumns = ['title', 'slug', 'active', 'actions'];
        $searchColumns = ['title', 'slug', 'active'];
        $orderColumns = ['title', 'slug', 'active'];

        return parent::getDataTableListTrash($url, $list, $showColumns, $searchColumns, $orderColumns);
    }
}
