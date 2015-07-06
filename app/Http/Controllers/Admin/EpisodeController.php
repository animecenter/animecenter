<?php

namespace App\Http\Controllers\Admin;

use App\Anime\Anime;
use App\Episodes\Episode;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

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

    /**
     * @var Guard
     */
    private $auth;

    private $data;

    /**
     * @param Anime $anime
     * @param Episode $episode
     * @param Guard $auth
     */
    public function __construct(Anime $anime, Episode $episode, Guard $auth)
    {
        $this->anime = $anime;
        $this->episode = $episode;
        $this->auth = $auth;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $this->data['episodes'] = $this->episode->orderBy('id', 'DESC')->get();
        $this->data['user'] = $this->auth->user();

        return view('admin.episodes.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function getCreate()
    {
        $this->data['animes'] = $this->anime->orderBy('title', 'ASC')->get();
        $this->data['user'] = $this->auth->user();

        return view('admin.episodes.create', $this->data);
    }

    /**
     * Create the specified resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(Request $request)
    {
        $this->episode->create([
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
            'order' => (int) end(explode(' ', $request['title'])),
            'coming_date' => $request['coming_date'],
            'show' => $request['show'] ? 1 : 0,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        $msg = 'Episode was created successfully!';

        return redirect()->action('Admin\EpisodeController@index')->with('success', $msg);
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
        $this->data['user'] = $this->auth->user();

        return view('admin.episodes.edit', $this->data);
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
        $episode->show = $request['show'] ? 1 : 0;
        $episode->not_yet_aired = $request['not_yet_aired'];
        $episode->raw = $request['raw'];
        $episode->hd = $request['hd'];
        $episode->mirror1 = $request['mirror1'];
        $episode->mirror2 = $request['mirror2'];
        $episode->mirror3 = $request['mirror3'];
        $episode->mirror4 = $request['mirror4'];
        $episode->date = $request['reset'] ? time() : $request['date'];
        $episode->date2 = time();
        $episode->coming_date = $request['coming_date'];
        $episode->save();
        $msg = 'Episode was updated successfully!';

        return redirect()->to($request['previous_url'])->with('success', $msg);
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

        return redirect()->action('Admin\EpisodeController@index')->with('success', $msg);
    }
}
