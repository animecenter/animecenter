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
     * @return Response
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
     * @return Response
     */
    public function getCreate()
    {
        $this->data['animes'] = $this->anime->orderBy('title', 'ASC')->get();
        $this->data['user'] = $this->auth->user();

        return view('admin.episodes.create', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getEdit($id = 0)
    {
        $this->data['animes'] = $this->anime->orderBy('title', 'ASC')->get();
        $this->data['episode'] = $this->episode->findorFail($id);
        $this->data['user'] = $this->auth->user();

        return view('admin.episodes.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param Request $request
     * @return Response
     */
    public function postEdit($id = 0, Request $request)
    {
        $episode = $this->episode->findOrFail($id);
        $episode->anime_id = $request['anime_id'];
        $episode->title = $request['title'];
        $episode->slug = $request['slug'];
        $episode->subdub = $request['subdub'];
        $episode->show = $request['show'];
        $episode->not_yet_aired = $request['not_yet_aired'];
        $episode->raw = $request['raw'];
        $episode->hd = $request['hd'];
        $episode->mirror1 = $request['mirror1'];
        $episode->mirror2 = $request['mirror2'];
        $episode->mirror3 = $request['mirror3'];
        $episode->mirror4 = $request['mirror4'];
        $episode->date = $request['reset'] ? time() : $request['date'];
        $episode->date2 = $request['date2'];
        $episode->rating = $request['rating'];
        $episode->votes = $request['votes'];
        $episode->visits = $request['visits'];
        $episode->order = $request['order'];
        $episode->coming_date = $request['coming_date'];

        $msg = 'Anime was updated successfully!';
        $episode->save();

        return redirect()->back()->with('success', $msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function getDelete($id = 0)
    {
        $this->episode->findOrFail($id)->delete();
        $msg = 'Episode was deleted successfully!';

        return redirect()->action('Admin\EpisodeController@index')->with('success', $msg);
    }
}
