<?php
$page_title="Watch Upcoming Episodes";
$meta_title=$page_title." | Watch Anime Online Free";
$meta_desc="Watch ".$page_title."!,Watch ".$page_title."! English Subbed/Dubbed,Watch ".$page_title." English Sub/Dub, Download ".$page_title." for free,Watch ".$page_title."! Online English Subbed and Dubbed  for Free Online only at Anime Center";
$meta_key="Download ".$page_title.",Watch ".$page_title." on iphone,watch anime online, English Subbed/Dubbed, English Sub/Dub,Watch Anime for free,Download Anime,High Quality Anime";

 require_once("header.php"); 
?>
<div id="wrap">
   <div id="content">
   <?php include_once("banner.php");?>
       <div id="left_content">
        <div id="sec4" class="sections">
           <div class="title">Watch Upcoming Subbed Episodes</div>
	   <script  src="<?php echo $url; ?>css/js/countdown.js"></script>
<?php
$episodess=$ob->get_table("an_episodes","e_coming_date!='' and e_not_yeird!='' order by e_coming_date ASC");
while($episode=mysql_fetch_assoc($episodess)){
           $ser=mysql_fetch_assoc($ob->get_table("an_series","a_id=".$episode['e_series']));
		   $comming=$episode['e_coming_date'];
					  $first  = new DateTime("now");
					  $second = new DateTime($comming);
					  $diff = $first->diff( $second );
					  $day=$diff->format( '%d')+($diff->format( '%y')*365);
			   		  $hr=$diff->format( '%H');
					  $min=$diff->format( '%i');
					  $second=$diff->format( '%s')
					  $total_s=($day*86400)+($hr*3600)+($min*60)+$second;
			$link=$url.$options[4]['o_value'].str_replace(" ","-",strtolower($episode['e_title']));
?>
    <div class="block">
    <a href="<?php echo $link;?>">
    <img alt='image' class='eimg' src="<?php echo get_thumbnail('images/'.$ser['a_image'], 50, 75);?>" width="50" height="75" /><!--timthumb.php?src=<?php echo $url$
    <div class="sub_title" style="width:225px;font-family:helvetica;"><?php echo (strlen($ser['a_title'])<30)?$ser['a_title']:substr($ser['a_title'],0,30)."..."; ?>$
        <span style="font-weight:normal;margin-top:5px;float:left"><?php $tit=explode(" ",$episode['e_title']);echo "Episode ".end($tit);?></span></div>
     </a>
	 <style>
	 div[id^="Box_jbeeb_"]{
	 display:none;
	 }
	 </style>
     <div class="date_con2" style="float: left;width: 180px; position: absolute;right: 10px;bottom: 10px;"> 
            <script>
            var myCountdown1 = new Countdown({
								 	time: <?php echo $total_s; ?>, // 86400 seconds = 1 day
									width:180, 
									height:30,  
									rangeHi:"day",
									
									numbers		: 	{
													font 	: "Arial",
													color	: "#FFFFFF",
													bkgd	: "#00ae45",
													rounded	: 0.0001,				// percentage of size 
												
													} // <- no comma on last item!
									});
            </script>
            </div>			
    </div><!--/block-->
   
   
<?php } ?>
       </div><!--/sections-->
        
       </div><!--/left_content-->
       <div id="right_content"><?php include_once("sidebar.php");?></div>
   </div><!--/content-->
<?php require_once("footer.php"); ?>   
