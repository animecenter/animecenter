<?php

namespace AC\Http\Controllers;

use AC\Models\Meta;
use AC\Repositories\EloquentAnimeRepository as Anime;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    private $data;

    /**
     * @var Anime
     */
    private $anime;

    /**
     * @var Meta
     */
    private $meta;

    /**
     * @param Anime $anime
     * @param Meta  $meta
     */
    public function __construct(Anime $anime, Meta $meta)
    {
        $this->anime = $anime;
        $this->meta = $meta;
    }

    /**
     * Display a listing of the resource.
     * Route search.
     *
     * @param Request $request
     *
     * @return view
     */
    public function index(Request $request)
    {
        $this->data['query'] = $query = $request['q'];
        if ($query) {
            $this->data['animes'] = $this->anime->search($query);
            $this->data['meta'] = $this->meta->whereRoute('search')->orderBy('route')
                ->firstOrFail(['title', 'keywords', 'description'])->replaceAll('$1', $query);

            return view('app.search.index', $this->data);
        } else {
            abort(404, 'You are not searching for anything');
        }
    }
}
