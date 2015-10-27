<?php

namespace AC\Http\Controllers\Dashboard;

use AC\Models\Anime;
use DB;
use Illuminate\Http\Request;

class AnimeController extends DashboardController
{
    /**
     * @var Anime
     */
    private $anime;

    /**
     * @param Anime $anime
     */
    public function __construct(Anime $anime)
    {
        $this->anime = $anime;
    }

    public function index()
    {
        return view('dashboard.animes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function getCreate()
    {
        return view('dashboard.animes.create');
    }

    /**
     * Create a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(Request $request)
    {
        $anime = new $this->anime;
        $anime->name = $request['name'];
        $anime->active = $request['active'] === '1' ? 1 : 0;
        $anime->save();
        $msg = 'Anime was created successfully!';

        return redirect()->action('Dashboard\AnimeController@index')->with('success', $msg);
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
            'dashboard.animes.edit',
            ['anime' => DB::table('animes')->where('id', '=', $id)->first()]
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
        $anime = $this->anime->findOrFail($id);
        $anime->name = $request['name'];
        $anime->active = $request['active'] === '1' ? 1 : 0;
        $anime->save();
        $msg = 'Anime was edited successfully!';

        return redirect()->action('Dashboard\AnimeController@index')->with('success', $msg);
    }

    /**
     * Show trash resources.
     *
     * @return \Illuminate\View\View
     */
    public function getTrash()
    {
        return view('dashboard.animes.trash');
    }

    /**
     * Trash resource by id.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postTrash($id = 0)
    {
        $this->anime->findOrFail($id)->delete();
        $msg = 'Anime was trashed successfully!';

        return redirect()->action('Dashboard\AnimeController@index')->with('success', $msg);
    }

    /**
     * Delete resource by id.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDelete($id = 0)
    {
        $this->anime->withTrashed()->findOrFail($id)->forceDelete();
        $msg = 'Anime was deleted successfully!';

        return redirect()->action('Dashboard\AnimeController@getTrash')->with('success', $msg);
    }

    /**
     * Recover resource from trash by id.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRecover($id = 0)
    {
        $this->anime->withTrashed()->findOrFail($id)->restore();
        $msg = 'Anime was recovered successfully!';

        return redirect()->action('Dashboard\AnimeController@getTrash')->with('success', $msg);
    }

    /**
     * Get resource listing
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList()
    {
        $url = 'animes';
        $list = collect(DB::table('animes')->where('deleted_at', '=', null)->get(['id', 'name', 'active']));
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
        $url = 'animes';
        $list = collect(
            DB::table('animes')->where('deleted_at', '<>', '')->get(['id', 'name', 'active'])
        );
        $showColumns = ['name', 'active', 'actions'];
        $searchColumns = ['name', 'active'];
        $orderColumns = ['name', 'active'];

        return parent::getDataTableListTrash($url, $list, $showColumns, $searchColumns, $orderColumns);
    }
}
