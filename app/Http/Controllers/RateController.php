<?php

namespace App\Http\Controllers;

use App\Anime\Anime;
use App\Episodes\Episode;
use DB;
use Illuminate\Http\Request;
use Response;

class RateController extends Controller
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
     * @param Anime $anime
     * @param Episode $episode
     */
    public function __construct(Anime $anime, Episode $episode)
    {
        $this->anime = $anime;
        $this->episode = $episode;
    }

    public function postAnime(Request $request)
    {
        if ($request->ajax()) {
            $animeID = (int) $request['id'];
            $newRating = (int) $request['rate'];
            $anime = DB::table('animes')->where('id', '=', $animeID)->first();
            $ip = $_SERVER['REMOTE_ADDR'];
            $check = DB::table('ratings')->where('target', '=', $animeID)
                ->where('ip', '=', $ip)
                ->where('type', '=', 'Anime')
                ->get();
            $currentVotes = $anime->votes ? $anime->votes : 0;
            $currentRating = $anime->rating ? $anime->rating : 0;
            $newVotes = $currentVotes + 1;
            $newRating = sprintf("%.2f", ($currentRating * $currentVotes + $newRating) / $newVotes);
            if ($check) {
                return "Average: " . $currentRating . " ( " . $currentVotes . " votes)";
            } else {
                DB::table('animes')->where('id', '=', $animeID)->update(['rating' => $newRating, 'votes' => $newVotes]);
                DB::table('ratings')->insert(['target' => $animeID, 'ip' => $ip, 'type' => 'Anime']);
                return "Average: " . $newRating . " ( " . $newVotes . " votes)";
            }
        } else {
            return null;
        }
    }

    public function postEpisode(Request $request)
    {
        if ($request->ajax()) {
            $episodeID = (int) $request['id'];
            $newRating = (int) $request['rate'];
            $episode = DB::table('episodes')->where('id', '=', $episodeID)->first();
            $ip = (int) $_SERVER['REMOTE_ADDR'];
            $check = DB::table('ratings')->where('target', '=', $episodeID)
                ->where('ip', '=', $ip)
                ->where('type', '=', 'Episode')
                ->get();
            $currentVotes = $episode->votes ? $episode->votes : 0;
            $currentRating = $episode->rating ? $episode->rating : 0;
            $newVotes = $currentVotes + 1;
            $newRating = sprintf("%.2f", ($currentRating * $currentVotes + $newRating) / $newVotes);
            if (isset($check)) {
                return "Average: " . $currentRating . " ( " . $currentVotes . " votes)";
            } else {
                DB::table('episodes')->where('id', '=', $episodeID)->update(['rating' => $newRating, 'votes' => $newVotes]);
                DB::table('ratings')->insert(['target' => $episodeID, 'ip' => $ip, 'type' => 'Episode']);
                return "Average: " . $newRating . " ( " . $newVotes . " votes)";
            }
        } else {
            return null;
        }
    }
}
