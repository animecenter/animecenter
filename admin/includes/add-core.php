<?php
if(!isset($url)){ die("Error");exit();}
//add series
if(isset($_POST['add_series'])){
	$title=GetSQLValueString($_POST['title'],"text");
	$genres=implode("," , $_POST['genres']);
	$genres=GetSQLValueString($genres,"text");
	$episodes=GetSQLValueString($_POST['episodes'],"text");
	$type=GetSQLValueString($_POST['type'],"text");
	$type2=GetSQLValueString($_POST['type2'],"text");
	$status=GetSQLValueString($_POST['status'],"text");
	$prequel=GetSQLValueString($_POST['prequel'],"text");
	$sequel=GetSQLValueString($_POST['sequel'],"text");
	$story=GetSQLValueString($_POST['story'],"text");
	$s_story=GetSQLValueString($_POST['s_story'],"text");
	$spin_off=GetSQLValueString($_POST['spin_off'],"text");
	$alternative_2=GetSQLValueString($_POST['alternative_2'],"text");
	$other=GetSQLValueString($_POST['other'],"text");
	$age=GetSQLValueString($_POST['age'],"text");
	$description=GetSQLValueString($_POST['description'],"text");
	$alternative=GetSQLValueString($_POST['alternative'],"text");
	
	$date=time();
	
	if(isset($_POST['position1']) and isset($_POST['position2'])) $position="all";
	elseif(isset($_POST['position1']) and !isset($_POST['position2'])) $position="recently";
	elseif(!isset($_POST['position1']) and isset($_POST['position2'])) $position="featured";
	else $position="none";
    
	$filename=rand(00000000,99999999).'_'.$_FILES['img_file']['name']; 
    move_uploaded_file($_FILES['img_file']['tmp_name'],"/home/daiky/public_html/images/".$filename);
        @chmod("/home/daiky/public_html/images/".$filename,0644);
	$in=$ob->insert_data("an_series(a_title,a_genres,a_episodes,a_type,a_age,a_type2,a_status,a_prequel,a_sequel,a_story,a_side_story,a_spin_off,a_alternative,a_other,a_position,a_description,a_alternative_title,a_image,a_date,a_date2)","$title,$genres,$episodes,$type,$age,$type2,$status,$prequel,$sequel,$story,$s_story,$spin_off,$alternative_2,$other,'$position',$description,$alternative,'$filename',$date,$date");
	$insert_id=mysql_insert_id();
	$ob->up_data("an_f_data","d_s_add=concat(d_s_add,'".$insert_id.",')","d_id=1");
	$ob->up_data("an_r_data","d_s_add=concat(d_s_add,'".$insert_id.",')","d_id=1");
	if($in){
		$max=mysql_fetch_assoc($ob->get_table("an_series","a_id=(select max(a_id) from an_series)"));
		header('location:'.$url.$max['a_type2']."-anime/".str_replace(" ","-",strtolower($max['a_title'])));
	}
	else{
		header('location:index.php?page=series&msg=f');
	}
}
//end add series

//add episode
if(isset($_POST['add_episode'])){
	$title=GetSQLValueString($_POST['title'],"text");
	$subdub=GetSQLValueString($_POST['subdub'],"text");
	$yeird=GetSQLValueString($_POST['not_yeird'],"text");
	$raw=GetSQLValueString($_POST['raw'],"text");
	$hd=GetSQLValueString($_POST['hd'],"text");
	$mirror1=GetSQLValueString($_POST['mirror1'],"text");
	$mirror2=GetSQLValueString($_POST['mirror2'],"text");
	$mirror3=GetSQLValueString($_POST['mirror3'],"text");
	$mirror4=GetSQLValueString($_POST['mirror4'],"text");
	$series=GetSQLValueString($_POST['series'],"int");
	$order=explode(' ',$_POST['title']);
    $order=(int)end($order);
	$coming_date=GetSQLValueString($_POST['coming_date'],"date");
	if(isset($_POST['show'])) $show=1; else $show=0;
	
	$date=time();
	$in=$ob->insert_data("an_episodes(e_title,e_subdub,e_show,e_not_yeird,e_raw,e_hd,e_mirror1,e_mirror2,e_mirror3,e_mirror4,e_series,e_date,e_date2,e_order,e_coming_date)","$title,$subdub,$show,$yeird,$raw,$hd,$mirror1,$mirror2,$mirror3,$mirror4,$series,$date,$date,$order,$coming_date");
	$insert_id=mysql_insert_id();
	$ob->up_data("an_f_data","d_e_add=concat(d_e_add,'".$insert_id.",')","d_id=1");
	$ob->up_data("an_r_data","d_e_add=concat(d_e_add,'".$insert_id.",')","d_id=1");
	if($in){
		$max=mysql_fetch_assoc($ob->get_table("an_episodes","e_id=(select max(e_id) from an_episodes)"));
		header('location:'.$url."watch/".str_replace(" ","-",strtolower($max['e_title'])));
	}
	else{
		header('location:index.php?page=episodes&msg=f');
	}
}
//end add_episode

//add page
if(isset($_POST['add_page'])){
	$title=GetSQLValueString($_POST['title'],"text");
	$content=GetSQLValueString($_POST['content'],"text");
	$order=GetSQLValueString($_POST['order'],"int");
	$position=GetSQLValueString($_POST['position'],"text");
	$link=GetSQLValueString($_POST['link'],"text");
    
	$in=$ob->insert_data("an_pages(p_title,p_content,p_link,p_order,p_position)","$title,$content,$link,$order,$position");
	if($in){
		header('location:index.php?page=pages&msg=ok');
	}
	else{
		header('location:index.php?page=pages&msg=f');
	}
}
//end add_page

//add image
if(isset($_POST['add_image'])){
	$bigtitle=GetSQLValueString($_POST['bigtitle'],"text");
	$smalltitle=GetSQLValueString($_POST['smalltitle'],"text");
	$desc=GetSQLValueString($_POST['desc'],"text");
	$link=GetSQLValueString($_POST['link'],"text");
	$date=date("Y-m-d H:i:s");
	$filename=rand(00000000,99999999).'_'.$_FILES['img_file']['name']; 
    move_uploaded_file($_FILES['img_file']['tmp_name'],"/home/daiky/public_html/images/".$filename);
        @chmod("/home/daiky/public_html/images/".$filename,0644);
    
	$in=$ob->insert_data("an_images(i_bigtitle,i_smalltitle,i_link,i_desc,i_file,i_date)","$bigtitle,$smalltitle,$link,$desc,'$filename','$date'");
	if($in){
		header('location:index.php?page=images&msg=ok');
	}
	else{
		header('location:index.php?page=images&msg=f');
	}
}
//end add_image