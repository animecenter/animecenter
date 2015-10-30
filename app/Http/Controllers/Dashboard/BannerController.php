<?php

namespace AC\Http\Controllers\Dashboard;

use AC\Models\Banner;
use DB;
use Illuminate\Http\Request;

class BannerController extends DashboardController
{
    /**
     * @var Banner
     */
    private $banner;

    /**
     * @param Banner $banner
     */
    public function __construct(Banner $banner)
    {
        $this->banner = $banner;
    }

    public function index()
    {
        return view('dashboard.banners.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function getCreate()
    {
        return view('dashboard.banners.create');
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
        $banner = new $this->banner();
        $banner->title = $request['title'];
        $banner->link_to = $request['link_to'];
        $banner->big_title = $request['big_title'];
        $banner->content = $request['content'];
        $banner->order = $request['order'];
        $banner->active = $request['active'] === '1' ? 1 : 0;
        $banner->save();
        $msg = 'Banner was created successfully!';

        return redirect()->action('Dashboard\BannerController@index')->with('success', $msg);
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
        return view('dashboard.banners.edit', [
            'banner' => DB::table('banners')->where('id', '=', $id)->first()
        ]);
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
        $banner = $this->banner->findOrFail($id);
        $banner->title = $request['title'];
        $banner->link_to = $request['link_to'];
        $banner->big_title = $request['big_title'];
        $banner->content = $request['content'];
        $banner->order = $request['order'];
        $banner->active = $request['active'] === '1' ? 1 : 0;
        $banner->save();
        $msg = 'Banner was edited successfully!';

        return redirect()->action('Dashboard\BannerController@index')->with('success', $msg);
    }

    /**
     * Show trash resources.
     *
     * @return \Illuminate\View\View
     */
    public function getTrash()
    {
        return view('dashboard.banners.index');
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
        $this->banner->findOrFail($id)->delete();
        $msg = 'Banner was trashed successfully!';

        return redirect()->action('Dashboard\BannerController@index')->with('success', $msg);
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
        $this->banner->withTrashed()->findOrFail($id)->forceDelete();
        $msg = 'Banner was deleted successfully!';

        return redirect()->action('Dashboard\BannerController@getTrash')->with('success', $msg);
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
        $this->banner->withTrashed()->findOrFail($id)->restore();
        $msg = 'Banner was recovered successfully!';

        return redirect()->action('Dashboard\BannerController@getTrash')->with('success', $msg);
    }

    /**
     * Get resource listing.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList()
    {
        $url = 'banners';
        $list = collect(
            DB::table('banners')->where('deleted_at', '=', null)->get(['id', 'title', 'link_to', 'order', 'active'])
        );
        $showColumns = ['title', 'link_to', 'order', 'active', 'actions'];
        $searchColumns = ['title', 'link_to', 'active'];
        $orderColumns = ['title', 'link_to', 'order', 'active'];

        return parent::getDataTableList($url, $list, $showColumns, $searchColumns, $orderColumns);
    }

    /**
     * Get trash resource listing.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getListTrash()
    {
        $url = 'banners';
        $list = collect(
            DB::table('banners')->where('deleted_at', '<>', '')->get(['id', 'title', 'link_to', 'order', 'active'])
        );
        $showColumns = ['title', 'link_to', 'order', 'active', 'actions'];
        $searchColumns = ['title', 'link_to', 'active'];
        $orderColumns = ['title', 'link_to', 'order', 'active'];

        return parent::getDataTableListTrash($url, $list, $showColumns, $searchColumns, $orderColumns);
    }
}
