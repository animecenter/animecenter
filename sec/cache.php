<?php
if (isset($_GET['url'])) {
    $cache_path = '/home/nginx-cache/animecenter/';
    if ($_GET['url'] == 'all') {
        exec("find $cache_path -type f -delete");
        echo "All Cache => Purge initiated";
    } else {
        $url = parse_url($_GET['url']);
        if ( ! $url) {
            echo 'Invalid URL entered';
            die();
        }
        $scheme = $url['scheme'];
        $host = $url['host'];
        $requesturi = $url['path'];
        $hash = md5($scheme . 'GET' . $host . $requesturi);
        $cache_path . substr($hash, -1) . '/' . substr($hash, -3, 2) . '/' . $hash;
        #$cache_file = exec("grep -lr '$requesturi' $cache_path | xargs rm");
        if (unlink($cache_path . substr($hash, -1) . '/' . substr($hash, -3, 2) . '/' . $hash)) {
            echo $_GET['url'] . " => Purge initiated";
        }
    }
}
?>