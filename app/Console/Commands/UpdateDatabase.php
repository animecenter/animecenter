<?php

namespace AC\Console\Commands;

use Cache;
use Carbon\Carbon;
use DOMDocument;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Log;

class UpdateDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command that updates the database.';

    /**
     * @var DatabaseManager
     */
    private $db;

    /**
     * Create a new command instance.
     *
     * @param DatabaseManager $db
     */
    public function __construct(DatabaseManager $db)
    {
        parent::__construct();
        $this->db = $db;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        libxml_use_internal_errors(true);
        $animes = $this->getAnimes();

        $timestamp = Carbon::now()->toDateTimeString();

        foreach ($animes as $anime) {
            $currentAnime = $this->getAnime($anime);

            if ($currentAnime) {
                $episodes = $this->getEpisodes($currentAnime);

                $translation = $this->getTranslation($currentAnime);

                foreach ($episodes as $episode) {
                    $episodeID = $this->getEpisodeID($anime, $episode, $timestamp);

                    $mirrors = $this->getMirrors($episode);

                    foreach ($mirrors as $quality => $mirror) {
                        $dom = new DOMDocument();

                        $dom->loadHTML(strtolower($mirror));

                        if ((strpos(strtolower($mirror), 'iframe') !== false ||
                            strpos(strtolower($mirror), 'embed') === false)) {
                            $iframes = $dom->getElementsByTagName('iframe');
                            $this->insertMirror($iframes, $timestamp, $episodeID, $translation, $quality);
                        } elseif ((strpos(strtolower($mirror), 'iframe') === false ||
                            strpos(strtolower($mirror), 'embed') !== false)) {
                            $iframes = $dom->getElementsByTagName('embed');
                            $this->insertMirror($iframes, $timestamp, $episodeID, $translation, $quality);
                        } else {
                            Log::info("HTML that doesn't contain iframe or embed: ".$mirror);
                        }

                        libxml_clear_errors();
                    }
                }
            }
        }
        libxml_use_internal_errors(false);
    }

    /**
     * Get all mirrors from episode.
     *
     * @param $episode
     *
     * @return array
     */
    protected function getMirrors($episode)
    {
        $mirrors = [];
        $this->getMirror($episode->subdub, $mirrors);
        $this->getMirror($episode->hd, $mirrors, true);
        $this->getMirror($episode->mirror1, $mirrors);
        $this->getMirror($episode->mirror2, $mirrors);
        $this->getMirror($episode->mirror3, $mirrors);
        $this->getMirror($episode->mirror4, $mirrors);

        return $mirrors;
    }

    /**
     * Get mirror for episode.
     *
     * @param $mirror
     * @param $mirrors
     * @param bool $hd
     */
    protected function getMirror($mirror, &$mirrors, $hd = false)
    {
        ($mirror) ? ((strpos(strtolower($mirror), 'iframe') !== false || strpos(strtolower($mirror), 'embed') !== false)
            ? (($hd) ? $mirrors['hd'] = $mirror : $mirrors[] = $mirror) :
            Log::info("HTML that doesn't contain iframe or embed: ".$mirror)) : null;
    }

    /**
     * Get translation for current anime.
     *
     * @param $currentAnime
     *
     * @return string
     */
    protected function getTranslation($currentAnime)
    {
        return ($currentAnime->type2 == 'subbed') ? 'subbed' : 'dubbed';
    }

    /**
     * Check if mirror source exists if not create it.
     *
     * @param $mirrorSourceName
     * @param $timestamp
     *
     * @return int
     */
    protected function getMirrorSourceID($mirrorSourceName, $timestamp)
    {
        $exists = $this->db->connection('mysql1')->table('mirror_sources')
            ->where('name', '=', $mirrorSourceName)->first(['id']);
        if (!$exists) {
            $mirrorSourceID = $this->db->connection('mysql1')->table('mirror_sources')
                ->insertGetId([
                    'name'       => $mirrorSourceName,
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp,
                ]);
        } else {
            $mirrorSourceID = $exists->id;
        }

        return $mirrorSourceID;
    }

    /**
     * Check if anime has this episode if it doesnt have this episode then insert it and get episode id.
     *
     * @param $anime
     * @param $episode
     * @param $timestamp
     *
     * @return int
     */
    protected function getEpisodeID($anime, $episode, $timestamp)
    {
        $exists = $this->db->connection('mysql1')->table('episodes')->where('anime_id', '=', $anime->id)
            ->where('number', '=', $episode->order)->first(['id']);
        if (!$exists) {
            $episodeID = $this->db->connection('mysql1')->table('episodes')->insertGetId([
                'anime_id'   => $anime->id,
                'number'     => $episode->order,
                'status'     => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ]);
        } else {
            $episodeID = $exists->id;
        }

        return $episodeID;
    }

    /**
     * Get all episodes from current anime.
     *
     * @param $currentAnime
     *
     * @return array|static[]
     */
    protected function getEpisodes($currentAnime)
    {
        $episodes = $this->db->connection('mysql')->table('episodes')->where('anime_id', '=', $currentAnime->id)
            ->get([
                'subdub',
                'show',
                'raw',
                'hd',
                'mirror1',
                'mirror2',
                'mirror3',
                'mirror4',
                'date',
                'date2',
                'rating',
                'votes',
                'visits',
                'order',
                'coming_date',
            ]);

        return $episodes;
    }

    /**
     * Get all the animes from MAL with alt titles if they have them.
     *
     * @return mixed
     */
    protected function getAnimes()
    {
        // TODO: Filter hentai anime
        $animes = Cache::remember('animes', 180, function () {
            return $this->db->connection('mysql1')->table('animes')
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
        });

        return $animes;
    }

    /**
     * Check if an anime record exists with the same title on the MAL database.
     *
     * @param $anime
     *
     * @return mixed|static
     */
    protected function getAnime($anime)
    {
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

        return $currentAnime;
    }

    /**
     * @param $src
     *
     * @return string
     */
    protected function getMirrorSourceName($src)
    {
        $url = explode('.', parse_url($src, PHP_URL_HOST));
        $numberOfElements = count($url);
        $mirrorSourceName = ucfirst($url[$numberOfElements - 2]);

        return $mirrorSourceName;
    }

    /**
     * @param $iframes
     * @param $timestamp
     * @param $episodeID
     * @param $translation
     * @param $quality
     */
    protected function insertMirror($iframes, $timestamp, $episodeID, $translation, $quality)
    {
        foreach ($iframes as $iframe) {
            $src = $iframe->getAttribute('src');

            $mirrorExists = $this->db->connection('mysql1')->table('mirrors')
                ->where('url', '=', $src)->first(['id']);

            if (!$mirrorExists) {
                $mirrorSourceName = $this->getMirrorSourceName($src);

                $mirrorSourceID = $this->getMirrorSourceID($mirrorSourceName, $timestamp);

                // Insert mirror for current episode
                $this->db->connection('mysql1')->table('mirrors')->insert([
                    'user_id'          => 1,
                    'episode_id'       => $episodeID,
                    'mirror_source_id' => $mirrorSourceID,
                    'language_id'      => 1,
                    'url'              => $src,
                    'translation'      => $translation,
                    'quality'          => ($quality == 'hd') ? 'HD' : 'SD',
                    'active'           => 1,
                    'created_at'       => $timestamp,
                    'updated_at'       => $timestamp,
                ]);
            }
        }
    }
}
