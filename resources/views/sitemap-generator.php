<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
<?php
$time = explode(" ", microtime());
$time = $time[1];

// include class
include 'SitemapGenerator.php';
include 'database.php';

// create object
$sitemap = new SitemapGenerator("http://beta.animecenter.tv");

// will create also compressed (gzipped) sitemap
$sitemap->createGZipFile = true;

// determine how many urls should be put into one file
$sitemap->maxURLsPerSitemap = 25000;

// sitemap file name
$sitemap->sitemapFileName = "sitemap.xml";

// sitemap index file name
$sitemap->sitemapIndexFileName = "sitemap-index.xml";

// robots file name
$sitemap->robotsFileName = "robots.txt";

// Add Static URLS
$time = '1370052000';
// $sitemap->addUrl("http://beta.animecenter.tv",               				date('c', $time),  'always',    '1');

// Add series dynamic URLS
$result = mysql_query("SELECT a_title, a_type2, a_date, a_date2 FROM an_series WHERE 1")
or die(mysql_error());
$now = time();
while ($row = mysql_fetch_array($result)) {
    $created = $row['date'];
    $lastmod = $row['date2'];
    if (isset($lastmod)) {
        $timediff = $now - $lastmod;
        $time = $lastmod;
    } else {
        $timediff = $now - $created;
        $time = $created;
    }

    $url = "http://www.animecenter.tv/";
    $title = $row['title'];
    $title = str_replace(" ", "-", strtolower($title));
    $sub = $row['type2'] . "-anime/";
    $url = $url . $sub . $title;
    $type = 1;
    if ($type == 1) {
        $rank = 0.7;
    }
    if ($type == 2) {
        $rank = 0.6;
    }
    if ($timediff < 31104000) {
        $freq = 'yearly';
        if ($type == 1) {
            $rank = 0.3;
        }
        if ($type == 2) {
            $rank = 0.2;
        }
    }
    if ($timediff < 2592000) {
        $freq = 'monthly';
        if ($type == 1) {
            $rank = 0.4;
        }
        if ($type == 2) {
            $rank = 0.3;
        }
    }
    if ($timediff < 604800) {
        $freq = 'weekly';
        if ($type == 1) {
            $rank = 0.5;
        }
        if ($type == 2) {
            $rank = 0.4;
        }
    }
    if ($timediff < 129600) {
        $freq = 'daily';
        if ($type == 1) {
            $rank = 0.6;
        }
        if ($type == 2) {
            $rank = 0.5;
        }
    }
    if ($timediff < 42300) {
        $freq = 'hourly';
        if ($type == 1) {
            $rank = 0.7;
        }
        if ($type == 2) {
            $rank = 0.6;
        }
    }
    if ($timediff < 3600) {
        $freq = 'always';
        if ($type == 1) {
            $rank = 0.8;
        }
        if ($type == 2) {
            $rank = 0.6;
        }
    }
    $rank = 0.8;
    $sitemap->addUrl($url, date('c', $time), $freq, $rank);
}

// Add EPISODES
$result = mysql_query("SELECT e_title, e_date, e_date2, e_show FROM an_episodes WHERE 1")
or die(mysql_error());
$now = time();
while ($row = mysql_fetch_array($result)) {
    $created = $row['e_date'];
    $lastmod = $row['e_date2'];
    if (isset($lastmod)) {
        $timediff = $now - $lastmod;
        $time = $lastmod;
    } else {
        $timediff = $now - $created;
        $time = $created;
    }

    $url = "http://www.animecenter.tv/";
    $title = $row['e_title'];
    $show = $row['e_show'];
    $title = str_replace(" ", "-", strtolower($title));
    $sub = "watch/";
    $url = $url . $sub . $title;
    $type = 2;
    if ($type == 1) {
        $rank = 0.7;
    }
    if ($type == 2) {
        $rank = 0.6;
    }
    if ($timediff < 31104000) {
        $freq = 'yearly';
        if ($type == 1) {
            $rank = 0.3;
        }
        if ($type == 2) {
            $rank = 0.2;
        }
        if ($show == 1) {
            $rank = $rank + 0.2;
        }
    }
    if ($timediff < 2592000) {
        $freq = 'monthly';
        if ($type == 1) {
            $rank = 0.4;
        }
        if ($type == 2) {
            $rank = 0.3;
        }
        if ($show == 1) {
            $rank = $rank + 0.2;
        }
        if ($show == 0) {
            $freq = 'yearly';
        }
    }
    if ($timediff < 604800) {
        $freq = 'weekly';
        if ($type == 1) {
            $rank = 0.5;
        }
        if ($type == 2) {
            $rank = 0.4;
        }
        if ($show == 1) {
            $rank = $rank + 0.2;
        }
        if ($show == 0) {
            $freq = 'monthly';
        }
    }
    if ($timediff < 129600) {
        $freq = 'daily';
        if ($type == 1) {
            $rank = 0.6;
        }
        if ($type == 2) {
            $rank = 0.5;
        }
        if ($show == 1) {
            $rank = $rank + 0.2;
        }
        if ($show == 0) {
            $freq = 'monthly';
        }
    }
    if ($timediff < 42300) {
        $freq = 'hourly';
        if ($type == 1) {
            $rank = 0.7;
        }
        if ($type == 2) {
            $rank = 0.6;
        }
        if ($show == 1) {
            $rank = $rank + 0.2;
        }
        if ($show == 0) {
            $freq = 'monthly';
        }
    }
    if ($timediff < 3600) {
        $freq = 'always';
        if ($type == 1) {
            $rank = 0.8;
        }
        if ($type == 2) {
            $rank = 0.6;
        }
        if ($show == 1) {
            $rank = $rank + 0.2;
        }
        if ($show == 0) {
            $freq = 'monthly';
        }
    }
    $sitemap->addUrl($url, date('c', $time), $freq, $rank);
}


try {
    // create sitemap
    $sitemap->createSitemap();

    // write sitemap as file
    $sitemap->writeSitemap();

    // update robots.txt file
    $sitemap->updateRobots();

    // submit sitemaps to search engines
    $result = $sitemap->submitSitemap("");
} catch (Exception $exc) {
}
?>
</body>
</html>
