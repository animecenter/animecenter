<?php

namespace AC\Http\Controllers\Dashboard;

use AC\Models\Mirror;
use DB;
use Illuminate\Http\Request;

class MirrorController extends DashboardController
{
    /**
     * @var Mirror
     */
    private $mirror;

    /**
     * @param Mirror $mirror
     */
    public function __construct(Mirror $mirror)
    {
        $this->mirror = $mirror;
    }

    public function index()
    {
        return view('dashboard.mirrors.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function getCreate()
    {
        return view('dashboard.mirrors.create', [
            'users'    => DB::table('users')->orderBy('username')->get(['id', 'username']),
            'episodes' => DB::table('episodes')->join('animes', 'episodes.anime_id', '=', 'animes.id')
                ->orderBy('animeTitle')->get(['episodes.id', 'animes.title as animeTitle', 'episodes.number']),
            'mirrorSources' => DB::table('mirror_sources')->orderBy('name')->get(['id', 'name']),
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
        $mirror = new $this->mirror();
        $mirror->user_id = $request['user_id'];
        $mirror->episode_id = $request['episode_id'];
        $mirror->mirror_source_id = $request['mirror_source_id'];
        $mirror->language_id = $request['language_id'];
        $mirror->url = $request['url'];
        $mirror->translation = $request['translation'];
        $mirror->quality = $request['quality'];
        $mirror->mobile_friendly = $request['mobile_friendly'] === '1' ? 1 : 0;
        $mirror->active = $request['active'] === '1' ? 1 : 0;
        $mirror->save();
        $msg = 'Mirror was created successfully!';

        return redirect()->action('Dashboard\MirrorController@index')->with('success', $msg);
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
        return view('dashboard.mirrors.edit', [
            'mirror'   => DB::table('mirrors')->where('id', '=', $id)->first(),
            'users'    => DB::table('users')->orderBy('username')->get(['id', 'username']),
            'episodes' => DB::table('episodes')->join('animes', 'episodes.anime_id', '=', 'animes.id')
                ->orderBy('animeTitle')->get(['episodes.id', 'animes.title as animeTitle', 'episodes.number']),
            'mirrorSources' => DB::table('mirror_sources')->orderBy('name')->get(['id', 'name']),
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
        $mirror = $this->mirror->findOrFail($id);
        $mirror->user_id = $request['user_id'];
        $mirror->episode_id = $request['episode_id'];
        $mirror->mirror_source_id = $request['mirror_source_id'];
        $mirror->language_id = $request['language_id'];
        $mirror->url = $request['url'];
        $mirror->translation = $request['translation'];
        $mirror->quality = $request['quality'];
        $mirror->mobile_friendly = $request['mobile_friendly'] === '1' ? 1 : 0;
        $mirror->active = $request['active'] === '1' ? 1 : 0;
        $mirror->save();
        $msg = 'Mirror was edited successfully!';

        return redirect()->action('Dashboard\MirrorController@index')->with('success', $msg);
    }

    /**
     * Show trash resources.
     *
     * @return \Illuminate\View\View
     */
    public function getTrash()
    {
        return view('dashboard.mirrors.index');
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
        $this->mirror->findOrFail($id)->delete();
        $msg = 'Mirror was trashed successfully!';

        return redirect()->action('Dashboard\MirrorController@index')->with('success', $msg);
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
        $this->mirror->withTrashed()->findOrFail($id)->forceDelete();
        $msg = 'Mirror was deleted successfully!';

        return redirect()->action('Dashboard\MirrorController@getTrash')->with('success', $msg);
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
        $this->mirror->withTrashed()->findOrFail($id)->restore();
        $msg = 'Mirror was recovered successfully!';

        return redirect()->action('Dashboard\MirrorController@getTrash')->with('success', $msg);
    }

    public function getList()
    {
        $url = 'mirrors';
        $list = collect(
            DB::table('mirrors')->join('episodes', 'mirrors.episode_id', '=', 'episodes.id')
                ->join('animes', 'episodes.anime_id', '=', 'animes.id')
                ->join('mirror_sources', 'mirrors.mirror_source_id', '=', 'mirror_sources.id')
                ->where('mirrors.deleted_at', '=', null)
                ->get([
                    'mirrors.id', 'animes.title', 'episodes.number', 'mirror_sources.name', 'mirrors.translation',
                    'mirrors.quality', 'mirrors.active',
                ])
        );
        $showColumns = ['title', 'number', 'name', 'translation', 'quality', 'active', 'actions'];
        $searchColumns = ['title', 'number', 'name', 'translation', 'quality', 'active'];
        $orderColumns = ['title', 'number', 'name', 'translation', 'quality', 'active'];

        return parent::getDataTableList($url, $list, $showColumns, $searchColumns, $orderColumns);
    }

    /**
     * Get trash resource listing.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getListTrash()
    {
        $url = 'mirrors';
        $list = collect(
            DB::table('mirrors')->join('episodes', 'mirrors.episode_id', '=', 'episodes.id')
                ->join('animes', 'episodes.anime_id', '=', 'animes.id')
                ->join('mirror_sources', 'mirrors.mirror_source_id', '=', 'mirror_sources.id')
                ->where('mirrors.deleted_at', '<>', '')
                ->get([
                    'mirrors.id', 'animes.title', 'episodes.number', 'mirror_sources.name', 'mirrors.translation',
                    'mirrors.quality', 'mirrors.active',
                ])
        );
        $showColumns = ['title', 'number', 'name', 'translation', 'quality', 'active', 'actions'];
        $searchColumns = ['title', 'number', 'name', 'translation', 'quality', 'active'];
        $orderColumns = ['title', 'number', 'name', 'translation', 'quality', 'active'];

        return parent::getDataTableListTrash($url, $list, $showColumns, $searchColumns, $orderColumns);
    }
}
