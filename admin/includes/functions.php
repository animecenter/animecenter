<?php

class data
{
    public function get_table($tab, $con = '')
    {
        if (empty($con) || $con == null) {
            global $config;
            $query = "select * from " . $tab;
            $res = mysql_query($query, $config) or die(mysql_error());

            return $res;
        } else {
            global $config;
            $query = "select * from " . $tab . " where " . $con;
            $res = mysql_query($query, $config) or die(mysql_error());

            return $res;
        }
    }

    public function get_table_limit($tab, $con = '', $lim = 0, $max = '10')
    {
        if (empty($con) || $con == null) {
            global $config;
            $query = "select * from " . $tab . " limit " . $lim . "," . $max;
            $res = mysql_query($query, $config) or die(mysql_error());

            return $res;
        } else {
            global $config;
            $query = "select * from " . $tab . " where " . $con . " limit " . $lim . "," . $max;
            $res = mysql_query($query, $config) or die(mysql_error());

            return $res;
        }
    }

    public function insert_data($tab, $val = '')
    {
        global $config;
        $query = "insert into " . $tab . " values(" . $val . ")";
        $res = mysql_query($query, $config) or die(mysql_error());

        return $res;
    }

    public function up_data($tab, $val = '', $con = '')
    {
        global $config;
        $query = "update " . $tab . " set " . $val . " where " . $con;
        $res = mysql_query($query, $config) or die(mysql_error());

        return $res;
    }

    public function del_data($tab, $con = '')
    {
        global $config;
        $query = "delete from " . $tab . " where " . $con;
        $res = mysql_query($query, $config) or die(mysql_error());

        return $res;
    }

    public function put_cont($file, $con)
    {
        if (is_writable($file)) {
            if ( ! $handle = fopen($file, 'w+')) {
                return 0;
            }
            if (fwrite($handle, $con) === false) {
                return 0;
            }
            fclose($handle);

            return 1;
        } else {
            return 0;
        }


    }
}

$ob = new data();