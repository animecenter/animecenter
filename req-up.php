<?php
require_once("admin/conf/config.php");
require_once("admin/includes/functions.php");

if(!isset($_SESSION)) session_start();

if (isset($_SESSION['m_id']) and isset($_POST['id']))
{

        $id=GetSQLValueString($_POST['id'],"int");
        $type=GetSQLValueString($_POST['type'],"text");
         //echo $id."".$type;
        if($_POST['type']=="del"){
        $ob->del_data("an_freindship","f_id=".$id." and f_dest_user=".$_SESSION['m_id']);
        }
        elseif($_POST['type']=="accept"){
		$sql = "update an_freindship set f_status='accept' where f_id=$id and f_dest_user='$_SESSION[m_id]'";
		echo $sql;
		$res = mysql_query($sql);
		echo mysql_affected_rows();	
    }//end else
    elseif($_POST['type']=="del2"){
        $ob->del_data("an_freindship","f_id=".$id." and (f_src_user=$_SESSION[m_id] or f_dest_user=$_SESSION[m_id])");
        }
	
}


?>