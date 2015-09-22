<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Database\DatabaseManager;

class DatabaseController extends Controller
{
    /**
     * @var DatabaseManager
     */
    private $db;

    /**
     * @param DatabaseManager $db
     */
    public function __construct(DatabaseManager $db)
    {
        $this->db = $db;
    }
    public function getUpdate()
    {
        // Get all the animes from MAL with alt titles if they have them
        $animes = $this->db->connection('mysql1')->table('animes')
            ->leftJoin('titles as titles1', function ($join) {
                $join->on('titles1.titlable_id', '=', 'animes.id')
                    ->where('titles1.titlable_type', '=', 'Anime')
                    ->where('titles1.language', '=', 'English');
            })
            ->leftJoin('titles as titles2', function ($join) {
                $join->on('titles2.titlable_id', '=', 'animes.id')
                    ->where('titles2.titlable_type', '=', 'Anime')
                    ->where('titles2.language', '=', 'Synonyms');
            })
            ->select(['animes.id', 'animes.title', 'titles1.title as alt_title1', 'titles2.title as alt_title2'])
            ->orderBy('id')
            ->get();

        // Get current timestamp
        $timestamp = Carbon::now()->toDateTimeString();

        foreach ($animes as $anime) {

            // Check if an anime record exists with the same title on the MAL database
            $currentAnime = $this->db->connection('mysql')->table('animes')->where('title', '=', $anime->title)
                ->first(['id', 'type2', 'rating', 'votes', 'visits', 'date', 'date2']);
            if (!$currentAnime) {
                if ($anime->alt_title1) {
                    $currentAnime = $this->db->connection('mysql')->table('animes')->where('title', '=', $anime->alt_title1)
                        ->first(['id', 'type2', 'rating', 'votes', 'visits', 'date', 'date2']);
                }
                if (!$currentAnime && $anime->alt_title2) {
                    $currentAnime = $this->db->connection('mysql')->table('animes')->where('title', '=', $anime->alt_title2)
                        ->first(['id', 'type2', 'rating', 'votes', 'visits', 'date', 'date2']);
                }
            }

            // if an anime exists with the same title run the following code
            if ($currentAnime) {

                // Get all episodes from current anime
                $episodes = $this->db->connection('mysql')->table('episodes')->where('anime_id', '=', $currentAnime->id)
                    ->get([
                        'subdub', 'show', 'raw', 'hd', 'mirror1', 'mirror2', 'mirror3', 'mirror4', 'date', 'date2',
                        'rating', 'votes', 'visits', 'order', 'coming_date'
                    ]);


                foreach ($episodes as $episode) {
                    // Check if anime has this episode
                    $exists = $this->db->connection('mysql1')->table('episodes')->where('anime_id', '=', $anime->id)
                        ->where('number', '=', $episode->order)->first(['id']);

                    // If it doesn't have this episode then insert it and get episode id
                    if (!$exists) {
                        $episodeID = $this->db->connection('mysql1')->table('episodes')->insertGetId([
                            'anime_id' => $anime->id, 'number' => $episode->order, 'status' => 1,
                            'created_at' => $timestamp, 'updated_at' => $timestamp
                        ]);
                    } else {
                        $episodeID = $exists->id;
                    }

                    // Get current anime translation
                    $translation = ($currentAnime->type2 === 'subbed') ? 'Subbed' : 'Dubbed';

                    if ($episode->hd) {

                        // Get src url from frame or embed
                        $dom = new DOMDocument();
                        $dom->loadHTML($episode->hd);
                        $src = $dom->getAttribute('src');

                        // Check if mirror exists first
                        $mirror = $this->db->connection('mysql1')->table('mirrors')
                            ->where('episode_id', '=', $episodeID)
                            ->where('quality', '=', 'HD')
                            ->where('translation', '=', $translation)
                            ->where('url', '=', $src)
                            ->first();

                        if (!$mirror) {

                            // Get mirror source name
                            $url = explode('.', parse_url($src, PHP_URL_HOST));
                            $numberOfElements = count($url);
                            $mirrorSourceName = ucfirst($url[$numberOfElements - 1]);

                            // Check if mirror source exists if not create it
                            $mirrorSourceID = $this->db->connection('mysql1')->table('mirror_sources')->insertGetId([
                                'name' => $mirrorSourceName, 'created_at' => $timestamp, 'updated_at' => $timestamp
                            ]);

                            // Insert mirror for current episode
                            $this->db->connection('mysql1')->table('mirrors')->insert([
                                'user_id' => 1, 'episode_id' => $episodeID, 'mirror_source_id' => $mirrorSourceID,
                                'language_id' => 1, 'url' => $src, 'translation' => $translation, 'quality' => 'HD',
                                'active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp
                            ]);
                        }
                    }
                }
            }
        }

        return redirect()->back();
    }
}
