<?php
session_save_path('/var/www/animecenter/sessions');
ini_set('session.gc_maxlifetime', 10 * 24 * 60 * 60); // 3 hours
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 100);
ini_set('session.cookie_secure', false);
ini_set('session.use_only_cookies', true);
if (!isset($_SESSION)) {
    session_start();
}
$cache_key = md5($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . $_SERVER['QUERY_STRING']);
$cachefile = 'cached/cached-' . $cache_key . '.html';
$cachetime = 1;

// Serve from the cache if it is younger than $cachetime
if (file_exists($cachefile) && ! (isset($_SESSION['u_username'])) && time() - $cachetime < filemtime($cachefile) && $_SERVER['REQUEST_URI'] == '/') {
    //echo "<!-- Cached copy, generated ".date('H:i', filemtime($cachefile))." -->\n";
    include($cachefile);
    exit;
}
ob_start(); // Start the output buffer
