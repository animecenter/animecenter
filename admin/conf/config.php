<?php
ob_start();
$url = "http://beta.animecenter.tv/";
$hostname_config = "localhost";
$database_config = "animecenter";
$username_config = "animecenter";
$password_config = "PzTzyhLrtK2Z5uFJ";
$config = mysql_pconnect($hostname_config, $username_config, $password_config) or trigger_error(mysql_error(), E_USER_ERROR);
mysql_select_db($database_config);
?>
<?php
if (!function_exists("GetSQLValueString")) {
    function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") {
        if (PHP_VERSION < 6) {
            $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
        }
        $theValue = function_exists("mysql_real_escape_string") ?
            mysql_real_escape_string($theValue) :
            mysql_escape_string($theValue);
        switch ($theType) {
            case "textarea":
            case "text":
                $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
                break;
            case "long":
            case "int":
                $theValue = ($theValue != "") ? intval($theValue) : "NULL";
                break;
            case "double":
                $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
                break;
            case "datetime":
            case "date":
                $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
                break;
            case "defined":
                $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
                break;
        }
        return $theValue;
    }
}

function thumbcreate($video_field) {
    global $url;
    $video = str_replace("<iframe", "", $video_field);
    $start = '"http:';
    $end = '"';
    $path = '';
    if (preg_match_all('/' . preg_quote($start) . '(.*?)' . preg_quote($end) . '/', $video, $matches)) {
        $match_val = str_replace('"', '', $matches['0']['0']);
        $match_val_new = parse_url($match_val);
        isset($match_val_new['query']) ? parse_str($match_val_new['query'], $match) : '';
        $file = isset($match['file']) ? $match['file'] : '';
        if (file_exists('animethumb/' . $file . '.jpg')) {
            $path = $url . 'animethumb/' . $file . '.jpg';
        } else {
            $path = $url . 'css/imgs/no-image.jpg';
        }
    }
    return $path;
}

date_default_timezone_set("UTC");
