<?php

namespace AC\Http\Controllers;

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
     * @param Anime $anime
     */
    public function __construct(Anime $anime)
    {
        $this->anime = $anime;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // TODO: Get meta data...
        $this->data['pageTitle'] = $pageTitle = 'Category Browser';
        $this->data['metaTitle'] = $pageTitle.' | Watch Anime Online Free';
        $this->data['metaDesc'] = 'Watch '.$pageTitle.'!,Watch '.$pageTitle.'! English Subbed/Dubbed,Watch '.
            $pageTitle.' English Sub/Dub, Download '.$pageTitle.' for free,Watch '.$pageTitle.
            '! Online English Subbed and Dubbed  for Free Online only at Anime Center';
        $this->data['metaKey'] = 'Download '.$pageTitle.',Watch '.$pageTitle.' on iphone,watch anime '.
            'online, English Subbed/Dubbed, English Sub/Dub,Watch Anime for free,Download Anime,High Quality Anime';

        $this->data['genres'] = $this->genre->orderBy('value')->get();

        return view('app.search.index', $this->data);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return view
     */
    public function show(Request $request)
    {
        if ($request['q']) {
            $this->data['animes'] = $this->anime->search($request['q']);
            $this->data['query'] = $request['q'];

            // TODO: Get meta data...
            $this->data['pageTitle'] = $pageTitle = 'Animecenter.tv';
            $this->data['metaTitle'] = $pageTitle.' | Watch Anime Online Free';
            $this->data['metaDesc'] = 'Watch '.$pageTitle.'!,Watch '.$pageTitle.'! English Subbed/Dubbed,Watch '.
                $pageTitle.' English Sub/Dub, Download '.$pageTitle.' for free,Watch '.$pageTitle.
                '! Online English Subbed and Dubbed  for Free Online only at Anime Center';
            $this->data['metaKey'] = 'Download '.$pageTitle.',Watch '.$pageTitle.' on iphone,watch anime online,'.
                ' English Subbed/Dubbed, English Sub/Dub,Watch Anime for free,Download Anime,High Quality Anime';

            return view('app.search.show', $this->data);
        } else {
            abort(404, 'You are not searching for anything');
        }
    }
}
