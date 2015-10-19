<?php

namespace AC\Http\Controllers\Dashboard;

use AC\Http\Controllers\Controller;
use AC\Models\Anime;
use AC\Models\Episode;
use Cache;
use Datatable;
use DB;
use Form;
use Html;
use Illuminate\Http\Request;
use FA;

class EpisodeController extends Controller
{
    /**
     * @var Anime
     */
    private $anime;

    /**
     * @var Episode
     */
    private $episode;

    private $data;

    /**
     * @param Anime $anime
     * @param Episode $episode
     */
    public function __construct(Anime $anime, Episode $episode)
    {
        $this->anime = $anime;
        $this->episode = $episode;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
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
        $this->data['currentAnime'] = '';
        $this->data['animes'] = $this->anime->orderBy('title', 'ASC')->get();

        return view('dashboard.episodes.create', $this->data);
    }

    public function getCreateByAnimeID($id = 0)
    {
        $this->data['currentAnime'] = $this->anime->where('id', '=', $id)->first();
        $this->data['animes'] = $this->anime->orderBy('title', 'ASC')->get();

        return view('dashboard.episodes.create', $this->data);
    }

    public function postCreateAutomatically(Request $request)
    {
        if ($request['id'] && $request['num'] && $request['num'] > 0) {
            $date = time();
            $anime = $this->anime->where('id', '=', $request['id'])->first();
            // $lastEpisode = $this->episode->where('anime_id', '=', $request['id'])->get()->max('order');
            $lastEpisode = $this->episode->where('anime_id', '=', $request['id'])->orderBy('order', 'desc')
                ->first();
            if ($lastEpisode) {
                $currentEpisode = $lastEpisode['order'];
                $nextEpisode = (int) $currentEpisode + 1;
            } else {
                $nextEpisode = 1;
            }
            for ($i = 0; $i < $request['num']; $i++) {
                $title = $anime["title"] . ' Episode ' . $nextEpisode;
                $con = '<div id="yeird"><div class="text"><span>Anime Title:</span>' . $anime["title"] . '</div>
                    <div class="text"><span>Episode Number:</span>' . $anime["title"] . ' Episode ' . $nextEpisode . '</div>
                    <div class="text"><span>Status:</span>Upcoming</div>
                    <div class="text"><span>About ' . $anime["title"] . ':</span>' . $anime["description"] . '</div>
                    <div class="text"><span class="big">We don\'t have a video available for <strong>' .
                    $anime["title"] . ' Episode ' . $nextEpisode . ' </strong>yet. Please check back later or visit our
                    <strong><a href="' . url('/') . '">HOMEPAGE</a></strong> for the Latest Anime Episodes.</span></div>
                </div>';
                $order = $nextEpisode;
                $this->episode->create([
                    'title' => $title,
                    'slug' => str_slug($title),
                    'not_yet_aired' => $con,
                    'anime_id' => $request['id'],
                    'date' => $date,
                    'date2' => $date,
                    'order' => $order,
                    'rating' => 0,
                    'votes' => 0
                ]);
                $nextEpisode++;
            }
        }
    }

    /**
     * Create the specified resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(Request $request)
    {
        $order = explode(' ', $request['title']);
        $episode = $this->episode->create([
            'anime_id' => $request['anime_id'],
            'title' => $request['title'],
            'slug' => str_slug($request['title']),
            'subdub' => $request['subdub'],
            'not_yet_aired' => $request['not_yet_aired'],
            'raw' => $request['raw'],
            'hd' => $request['hd'],
            'mirror1' => $request['mirror1'],
            'mirror2' => $request['mirror2'],
            'mirror3' => $request['mirror3'],
            'mirror4' => $request['mirror4'],
            'date' => time(),
            'date2' => time(),
            'rating' => 0,
            'votes' => 0,
            'visits' => 0,
            'order' => (int) end($order),
            'coming_date' => $request['coming_date'],
            'show' => $request['show'] ? 1 : 0,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        $msg = 'Episode was created successfully!';

        return redirect()->to('watch/' . $episode->slug)->with('success', $msg);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function getEdit($id = 0)
    {
        $this->data['animes'] = $this->anime->orderBy('title', 'ASC')->get();
        $this->data['episode'] = $this->episode->findOrFail($id);

        return view('dashboard.episodes.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit($id = 0, Request $request)
    {
        $episode = $this->episode->findOrFail($id);
        $episode->anime_id = $request['anime_id'];
        $episode->title = $request['title'];
        $episode->slug = str_slug($request['title']);
        $episode->subdub = $request['subdub'];
        $episode->show = ($request['show']) ? 1 : 0;
        $episode->not_yet_aired = $request['not_yet_aired'];
        $episode->raw = $request['raw'];
        $episode->hd = $request['hd'];
        $episode->mirror1 = $request['mirror1'];
        $episode->mirror2 = $request['mirror2'];
        $episode->mirror3 = $request['mirror3'];
        $episode->mirror4 = $request['mirror4'];
        $episode->date = ($request['reset'] === "1") ? time() : (($episode->date) ? $episode->date : time());
        $episode->date2 = time();
        $episode->coming_date = $request['coming_date'] ? $request['coming_date'] : null;
        $episode->save();
        $msg = 'Episode was updated successfully!';

        return redirect()->action('EpisodeController@getEpisode', [$episode->slug])->with('success', $msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getDelete($id = 0)
    {
        $this->episode->findOrFail($id)->delete();
        $msg = 'Episode was deleted successfully!';

        return redirect()->action('Dashboard\EpisodeController@index')->with('success', $msg);
    }

    public function getList()
    {
        $list = Cache::remember('dashboard-episodes', '60', function() {
            return collect(DB::table('episodes')->join('animes', 'episodes.anime_id', '=', 'animes.id')
                ->orderBy('episodes.id', 'DESC')
                ->get(['episodes.id', 'episodes.number', 'episodes.active', 'episodes.aired_at', 'animes.title as animeTitle'])
            );
        });

        return Datatable::collection($list)
            ->showColumns('animeTitle', 'number', 'aired_at', 'active', 'actions')
            ->searchColumns(['animeTitle'])
            ->orderColumns('animeTitle', 'number', 'aired_at', 'active')
            ->addColumn('active', function ($model) {
                return $model->active === 1 ? 'Active' : 'Inactive';
            })
            ->addColumn('actions', function ($model) {
                $editIcon = FA::icon('pencil-square-o')->__toString() . ' ';
                $deleteIcon = FA::icon('trash-o')->__toString() . ' ';
                $editUrl = url('dashboard/episodes/edit', $model->id);
                $deleteUrl = url('dashboard/episodes/delete', $model->id);
                return html_entity_decode(
                    Html::link($editUrl, $editIcon . '', ['class' => 'btn btn-sm btn-warning pull-left']).
                    Form::open(['url' => $deleteUrl, 'class' => '']).
                    Form::button($deleteIcon, ['class' => 'btn btn-sm btn-danger btn-delete', 'type' => 'submit']).
                    Form::close()
                );
            })->make();
    }
}
