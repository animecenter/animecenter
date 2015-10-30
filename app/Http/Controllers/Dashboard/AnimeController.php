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
        return view('dashboard.animes.create', [
            'types' => DB::table('types')->where('model', '=', 'Anime')->orderBy('name')->get(['id', 'name']),
            'statuses' => DB::table('statuses')->orderBy('name')->get(['id', 'name']),
            'calendarSeasons' => DB::table('calendar_seasons')->orderBy('name')->get(['id', 'name']),
            'classifications' => DB::table('classifications')->orderBy('name')->get(['id', 'name']),
        ]);
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
        $anime = new $this->anime();
        $anime->mal_id = $request['mal_id'];
        $anime->title = $request['title'];
        $anime->slug = $request['slug'];
        $anime->image = $request['image'];
        $anime->synopsis = $request['synopsis'];
        $anime->type_id = $request['type_id'];
        $anime->number_of_episodes = $request['number_of_episodes'];
        $anime->status_id = $request['status_id'];
        $anime->release_date = $request['release_date'];
        $anime->end_date = $request['end_date'];
        $anime->duration = $request['duration'];
        $anime->calendar_season_id = $request['calendar_season_id'];
        $anime->classification_id = $request['classification_id'];
        $anime->active = $request['active'] === '1' ? 1 : 0;
        $anime->save();
        $msg = 'Anime was created successfully!';

        return redirect()->action('Dashboard\AnimeController@index')->with('success', $msg);
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
        return view('dashboard.animes.edit', [
            'anime' => DB::table('animes')->where('id', '=', $id)->first(),
            'types' => DB::table('types')->where('model', '=', 'Anime')->orderBy('name')->get(['id', 'name']),
            'statuses' => DB::table('statuses')->orderBy('name')->get(['id', 'name']),
            'calendarSeasons' => DB::table('calendar_seasons')->orderBy('name')->get(['id', 'name']),
            'classifications' => DB::table('classifications')->orderBy('name')->get(['id', 'name']),
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
        $anime = $this->anime->findOrFail($id);
        $anime->mal_id = $request['mal_id'];
        $anime->title = $request['title'];
        $anime->slug = $request['slug'];
        $anime->image = $request['image'];
        $anime->synopsis = $request['synopsis'];
        $anime->type_id = $request['type_id'];
        $anime->number_of_episodes = $request['number_of_episodes'];
        $anime->status_id = $request['status_id'];
        $anime->release_date = $request['release_date'];
        $anime->end_date = $request['end_date'];
        $anime->duration = $request['duration'];
        $anime->calendar_season_id = $request['calendar_season_id'];
        $anime->classification_id = $request['classification_id'];
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
        return view('dashboard.animes.index');
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
        $this->anime->findOrFail($id)->delete();
        $msg = 'Anime was trashed successfully!';

        return redirect()->action('Dashboard\AnimeController@index')->with('success', $msg);
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
        $this->anime->withTrashed()->findOrFail($id)->forceDelete();
        $msg = 'Anime was deleted successfully!';

        return redirect()->action('Dashboard\AnimeController@getTrash')->with('success', $msg);
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
        $this->anime->withTrashed()->findOrFail($id)->restore();
        $msg = 'Anime was recovered successfully!';

        return redirect()->action('Dashboard\AnimeController@getTrash')->with('success', $msg);
    }

    /**
     * Get resource listing.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList()
    {
        $url = 'animes';
        $list = collect(
            DB::table('animes')->where('deleted_at', '=', null)->get(['id', 'title', 'slug', 'active'])
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
        $url = 'animes';
        $list = collect(
            DB::table('animes')->where('deleted_at', '<>', '')->get(['id', 'title', 'slug', 'active'])
        );
        $showColumns = ['title', 'slug', 'active', 'actions'];
        $searchColumns = ['title', 'slug', 'active'];
        $orderColumns = ['title', 'slug', 'active'];

        return parent::getDataTableListTrash($url, $list, $showColumns, $searchColumns, $orderColumns);
    }
}
