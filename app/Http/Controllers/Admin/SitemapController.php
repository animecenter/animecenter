<?php

namespace App\Http\Controllers\Admin;

use App;
use App\Http\Controllers\Controller;
use DB;
use Exception;

class SitemapController extends Controller
{
    private $basePath;

    public function getGenerate()
    {
        $this->basePath = public_path();

        // create object
        $sitemap = App::make("sitemap");

        // Add series dynamic URLS
        $animes = DB::table('animes')->orderBy('date', 'desc')->get(['slug', 'type2', 'date', 'date2']);
        $now = time();
        foreach ($animes as $anime) {
            $created = $anime->date;
            $lastMod = $anime->date2;
            if (isset($lastMod)) {
                $timeDiff = $now - $lastMod;
                $time = $lastMod;
            } else {
                $timeDiff = $now - $created;
                $time = $created;
            }
            $url = url($anime->type2 . "-anime/" . $anime->slug);
            if ($timeDiff < 3600) {
                $freq = 'always';
                $rank = 0.8;
            } else if ($timeDiff < 42300) {
                $freq = 'hourly';
                $rank = 0.7;
            } else if ($timeDiff < 129600) {
                $freq = 'daily';
                $rank = 0.6;
            } else if ($timeDiff < 604800) {
                $freq = 'weekly';
                $rank = 0.5;
            } else if ($timeDiff < 2592000) {
                $freq = 'monthly';
                $rank = 0.4;
            } else if ($timeDiff < 31104000) {
                $freq = 'yearly';
                $rank = 0.3;
            } else if ($timeDiff > 31104000) {
                $freq = 'never';
                $rank = 0.2;
            }
            $sitemap->add($url, date('c', $time), $freq, $rank);
        }

        // Add EPISODES
        $episodes = DB::table('episodes')->orderBy('date', 'desc')->get(['slug', 'date', 'date2', 'show']);
        $now = time();
        foreach ($episodes as $episode) {
            $created = $episode->date;
            $lastMod = $episode->date2;
            if (isset($lastMod)) {
                $timeDiff = $now - $lastMod;
                $time = $lastMod;
            } else {
                $timeDiff = $now - $created;
                $time = $created;
            }
            $show = $episode->show;
            $url = url("watch/" . $episode->slug);
            if ($timeDiff < 3600) {
                $freq = 'always';
                $rank = 0.6;
                if ($show == 1) {
                    $rank = $rank + 0.2;
                }
                if ($show == 0) {
                    $freq = 'monthly';
                }
            } else if ($timeDiff < 42300) {
                $freq = 'hourly';
                $rank = 0.6;
                if ($show == 1) {
                    $rank = $rank + 0.2;
                }
                if ($show == 0) {
                    $freq = 'monthly';
                }
            } else if ($timeDiff < 129600) {
                $freq = 'daily';
                $rank = 0.5;
                if ($show == 1) {
                    $rank = $rank + 0.2;
                }
                if ($show == 0) {
                    $freq = 'monthly';
                }
            } else if ($timeDiff < 604800) {
                $freq = 'weekly';
                $rank = 0.4;
                if ($show == 1) {
                    $rank = $rank + 0.2;
                }
                if ($show == 0) {
                    $freq = 'monthly';
                }
            } else if ($timeDiff < 2592000) {
                $freq = 'monthly';
                $rank = 0.3;
                if ($show == 1) {
                    $rank = $rank + 0.2;
                }
                if ($show == 0) {
                    $freq = 'yearly';
                }
            } else if ($timeDiff < 31104000) {
                $freq = 'yearly';
                $rank = 0.2;
                if ($show == 1) {
                    $rank = $rank + 0.2;
                }
            } else if ($timeDiff > 31104000) {
                $freq = 'never';
                $rank = 0.1;
                if ($show == 1) {
                    $rank = $rank + 0.2;
                }
            }
            $sitemap->add($url, date('c', $time), $freq, $rank);
        }

        try {

            // create sitemap
            $sitemap->store('xml', 'sitemap');

        } catch (Exception $e) {
            dd($e);
        }

        return redirect()->to('sitemap.xml');
    }
}
