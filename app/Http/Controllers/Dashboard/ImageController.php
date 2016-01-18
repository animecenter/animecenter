<?php

namespace AC\Http\Controllers\Dashboard;

use AC\Models\Image;
use DB;
use Illuminate\Http\Request;

class ImageController extends DashboardController
{
    /**
     * @var Image
     */
    private $image;

    /**
     * @param Image $image
     */
    public function __construct(Image $image)
    {
        $this->image = $image;
    }

    public function index()
    {
        return view('dashboard.images.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function getCreate()
    {
        return view('dashboard.images.create');
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
        $image = new $this->image();
        $image->name = $request['name'];
        $image->active = $request['active'] === '1' ? 1 : 0;
        $image->save();
        $msg = 'Image was created successfully!';

        return redirect()->action('Dashboard\ImageController@index')->with('success', $msg);
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
            'dashboard.images.edit',
            ['image' => DB::table('images')->where('id', '=', $id)->first()]
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
        $image = $this->image->findOrFail($id);
        $image->name = $request['name'];
        $image->active = $request['active'] === '1' ? 1 : 0;
        $image->save();
        $msg = 'Image was edited successfully!';

        return redirect()->action('Dashboard\ImageController@index')->with('success', $msg);
    }

    /**
     * Show trash resources.
     *
     * @return \Illuminate\View\View
     */
    public function getTrash()
    {
        return view('dashboard.images.index');
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
        $this->image->findOrFail($id)->delete();
        $msg = 'Image was trashed successfully!';

        return redirect()->action('Dashboard\ImageController@index')->with('success', $msg);
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
        $this->image->withTrashed()->findOrFail($id)->forceDelete();
        $msg = 'Image was deleted successfully!';

        return redirect()->action('Dashboard\ImageController@getTrash')->with('success', $msg);
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
        $this->image->withTrashed()->findOrFail($id)->restore();
        $msg = 'Image was recovered successfully!';

        return redirect()->action('Dashboard\ImageController@getTrash')->with('success', $msg);
    }

    /**
     * Get resource listing.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList()
    {
        $url = 'images';
        $list = collect(
            DB::table('images')->where('deleted_at', '=', null)->get(['id', 'name', 'active'])
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
        $url = 'images';
        $list = collect(
            DB::table('images')->where('deleted_at', '<>', '')->get(['id', 'name', 'active'])
        );
        $showColumns = ['name', 'active', 'actions'];
        $searchColumns = ['name', 'active'];
        $orderColumns = ['name', 'active'];

        return parent::getDataTableListTrash($url, $list, $showColumns, $searchColumns, $orderColumns);
    }
}
