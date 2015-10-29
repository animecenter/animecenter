<?php

namespace AC\Http\Controllers\Dashboard;

use AC\Models\Episode;
use DB;
use Illuminate\Http\Request;

class EpisodeController extends DashboardController
{
    /**
     * @var Episode
     */
    private $episode;

    /**
     * @param Episode $episode
     */
    public function __construct(Episode $episode)
    {
        $this->episode = $episode;
    }

    public function index()
    {
        return view('dashboard.episodes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function getCreate()
    {
        return view(
            'dashboard.episodes.create',
            ['animes' => DB::table('animes')->orderBy('title')->get(['id', 'title'])]
        );
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
        $episode = new $this->episode();
        $episode->anime_id = $request['anime_id'];
        $episode->number = $request['number'];
        $episode->title = $request['title'];
        $episode->synopsis = $request['synopsis'];
        $episode->active = $request['active'] === '1' ? 1 : 0;
        $episode->aired_at = $request['aired_at'];
        $episode->save();
        $msg = 'Episode was created successfully!';

        return redirect()->action('Dashboard\EpisodeController@index')->with('success', $msg);
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
            'dashboard.episodes.edit',
            [
                'episode' => DB::table('episodes')->where('id', '=', $id)->first(),
                'animes'  => DB::table('animes')->orderBy('title')->get(['id', 'title']),
            ]
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
        $episode = $this->episode->findOrFail($id);
        $episode->anime_id = $request['anime_id'];
        $episode->number = $request['number'];
        $episode->title = $request['title'];
        $episode->synopsis = $request['synopsis'];
        $episode->active = $request['active'] === '1' ? 1 : 0;
        $episode->aired_at = $request['aired_at'];
        $episode->save();
        $msg = 'Episode was edited successfully!';

        return redirect()->action('Dashboard\EpisodeController@index')->with('success', $msg);
    }

    /**
     * Show trash resources.
     *
     * @return \Illuminate\View\View
     */
    public function getTrash()
    {
        return view('dashboard.episodes.index');
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
        $this->episode->findOrFail($id)->delete();
        $msg = 'Episode was trashed successfully!';

        return redirect()->action('Dashboard\EpisodeController@index')->with('success', $msg);
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
        $this->episode->withTrashed()->findOrFail($id)->forceDelete();
        $msg = 'Episode was deleted successfully!';

        return redirect()->action('Dashboard\EpisodeController@getTrash')->with('success', $msg);
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
        $this->episode->withTrashed()->findOrFail($id)->restore();
        $msg = 'Episode was recovered successfully!';

        return redirect()->action('Dashboard\EpisodeController@getTrash')->with('success', $msg);
    }

    /**
     * Get resource listing.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList()
    {
        $url = 'episodes';
        $list = collect(
            DB::table('episodes')->join('animes', 'episodes.anime_id', '=', 'animes.id')
                ->where('episodes.deleted_at', '=', null)->orderBy('episodes.id', 'DESC')
                ->get(['episodes.id', 'episodes.number', 'episodes.active', 'episodes.aired_at', 'animes.title as animeTitle'])
        );
        $showColumns = ['animeTitle', 'number', 'aired_at', 'active', 'actions'];
        $searchColumns = ['animeTitle', 'active'];
        $orderColumns = ['animeTitle', 'number', 'aired_at', 'active'];

        return parent::getDataTableList($url, $list, $showColumns, $searchColumns, $orderColumns);
    }

    /**
     * Get trash resource listing.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getListTrash()
    {
        $url = 'episodes';
        $list = collect(
            DB::table('episodes')->join('animes', 'episodes.anime_id', '=', 'animes.id')
                ->where('episodes.deleted_at', '<>', '')->orderBy('episodes.id', 'DESC')
                ->get(['episodes.id', 'episodes.number', 'episodes.active', 'episodes.aired_at', 'animes.title as animeTitle'])
        );
        $showColumns = ['animeTitle', 'number', 'aired_at', 'active', 'actions'];
        $searchColumns = ['animeTitle', 'active'];
        $orderColumns = ['animeTitle', 'number', 'aired_at', 'active'];

        return parent::getDataTableListTrash($url, $list, $showColumns, $searchColumns, $orderColumns);
    }
}
