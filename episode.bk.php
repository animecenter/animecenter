<?php
 require_once("header.php");
if((isset($_GET['id']) and $_GET['id']!=NULL)){
$id=$episode_content['e_id'];	
$ser=mysql_fetch_assoc($ob->get_table("an_series","a_id=".$episode_content['e_series']));
$current_order=$episode_content['e_order'];
$next_episode=mysql_fetch_assoc($ob->get_table("an_episodes","e_series=".$episode_content['e_series']." and e_order >=".$current_order." and e_id!=".$id." order by e_order ASC"));
$prev_episode=mysql_fetch_assoc($ob->get_table("an_episodes","e_series=".$episode_content['e_series']." and e_order <=".$current_order." and e_id!=".$id." order by e_order desc"));
$type=explode("/",$_GET['id']);
$main_link=$url.$options[4]['o_value'].str_replace(" ","-",strtolower($episode_content['e_title']));
if(isset($type[2])){
switch($type[2]){
case 'mirror1':$cont=$episode_content['e_mirror1'];break;
case 'mirror2':$cont=$episode_content['e_mirror2'];break;
case 'mirror3':$cont=$episode_content['e_mirror3'];break;
case 'mirror4':$cont=$episode_content['e_mirror4'];break;
case 'raw':$cont=$episode_content['e_raw'];break;
case 'hd':$cont=$episode_content['e_hd'];break;
default:$cont=($episode_content['e_subdub']==NULL)?$episode_content['e_raw']:$episode_content['e_subdub'];
}//end switch
}//end if type
else $cont=($episode_content['e_subdub']==NULL)?$episode_content['e_raw']:$episode_content['e_subdub'];
?>
<div id="wrap">
   <div id="content">
   <?php include_once("banner.php");?>
       <div id="left_content">
       <div class="sec_top_one">
	        <?php if(isset($_SESSION['u_username'])){?>
	        <a href="<?php echo $url;?>admin/index.php?page=episode_up&id=<?php echo $episode_content['e_id']; ?>" class="edit_top">Edit</a>
	        <?php } ?>
       </div>
	<?php
	if($episode_content['e_mirror1']=='' and $episode_content['e_mirror2']=='' and $episode_content['e_mirror3']=='' and $episode_content['e_mirror4']=='' and $episode_content['e_hd']==''){
	echo '<meta name="test" content="no mirrors">';
	}
	?>
        <div class="sections" id="video">
            <div class="video"><div class="title"><?php echo $episode_content['e_title']; ?></div>
            <?php if($episode_content['e_not_yeird']==NULL or $episode_content['e_not_yeird']==''){?>
            <div class="tabs">
            <?php if($episode_content['e_subdub']!=NULL or $episode_content['e_subdub']!=''){?>
                <div class="block">
                  <a href="<?php echo $main_link; ?>">
				  <div class="tab <?php echo $ser['a_type2']; echo (!(isset($type[2])) or $type[2]=='')?' active':'';?>">English <?php echo $ser['a_type2'];?></div>
				  </a>
                </div><!--/block-->
             <?php }?>   
             <?php if($episode_content['e_mirror1']!=NULL or $episode_content['e_mirror1']!=''){?>
                <div class="block">
				<a href="<?php echo $main_link; ?>/mirror1">
                  <div class="tab <?php echo $ser['a_type2']; echo (isset($type[2]) and $type[2]=='mirror1')?' active':'';?>">Mirror 1</div>
				 </a> 
                </div><!--/block-->
             <?php }?>     
              <?php if($episode_content['e_mirror2']!=NULL or $episode_content['e_mirror2']!=''){?>
                <div class="block">
				<a href="<?php echo $main_link; ?>/mirror2">
                  <div class="tab <?php echo $ser['a_type2']; echo (isset($type[2]) and $type[2]=='mirror2')?' active':'';?>">Mirror 2</div>
				</a>  
                </div><!--/block-->
             <?php }?>     
              <?php if($episode_content['e_mirror3']!=NULL or $episode_content['e_mirror3']!=''){?>
                <div class="block">
				<a href="<?php echo $main_link; ?>/mirror3">
                  <div class="tab <?php echo $ser['a_type2']; echo (isset($type[2]) and $type[2]=='mirror3')?' active':'';?>">Mirror 3</div>
                </a>
				</div><!--/block-->
             <?php }?>     
              <?php if($episode_content['e_mirror4']!=NULL or $episode_content['e_mirror4']!=''){?>
                <div class="block">
				<a href="<?php echo $main_link; ?>/mirror4">
                  <div class="tab <?php echo $ser['a_type2']; echo (isset($type[2]) and $type[2]=='mirror4')?' active':'';?>">Mirror 4</div>
                </a>
				</div><!--/block-->
             <?php }?>
			 <?php if($episode_content['e_raw']!=NULL or $episode_content['e_raw']!=''){?>
                <div class="block">
				<a href="<?php echo $main_link; ?>/raw">
                  <div class="tab <?php echo $ser['a_type2']; echo ((isset($type[2]) and $type[2]=='raw')
				  or $episode_content['e_subdub']==NULL)?' active':'';?> raw">RAW</div>
				</a>  
                </div><!--/block-->
             <?php }?> 
             <?php if($episode_content['e_hd']!=NULL or $episode_content['e_hd']!=''){?>
                <div class="block">
				<a href="<?php echo $main_link; ?>/hd">
                  <div class="tab <?php echo $ser['a_type2']; echo (isset($type[2]) and $type[2]=='hd')?' active':'';?> mirror" >Mirror HD</div>
                </a>
				</div><!--/block-->
             <?php }?>   			 
            </div><!--/tabs-->
            <div class="embbed_content">
					
			<?php echo $cont;?></div>
            <?php }//end if yeird?>
            <?php if($episode_content['e_not_yeird']!=NULL and $episode_content['e_coming_date']!=NULL){
				  $comming=$episode_content['e_coming_date'];
					  $first  = new DateTime("now");
					  $second = new DateTime($comming);
					  $diff = $first->diff( $second );
					  $day=$diff->format( '%d')+($diff->format( '%y')*365);
			   		  $hr=$diff->format( '%H');
					  $min=$diff->format( '%i'); 
					  $second=$diff->format( '%s');     
					  $total_s=($day*86400)+($hr*3600)+($min*60)+$second;
			?>
			<script  src="<?php echo $url; ?>css/js/countdown.js"></script>
            <div class="date_con"> 
            <script>
            var myCountdown1 = new Countdown({
								 	time: <?php echo $total_s; ?>, // 86400 seconds = 1 day
									width:250, 
									height:60,  
									rangeHi:"day",
									style:"flip"	// <- no comma on last item!
									});
            </script>
            </div>
            <div class="date_img"><img src="<?php echo $url."/images/".$ser['a_image']; ?>" /></div>
            <h2 style="width: 300px; float: left; text-align: center; color: rgb(255, 255, 255); font-size: 16px; margin-left: 26%; margin-bottom: 5px;">ETA</h2>
			<?php }//end else if
			if($episode_content['e_not_yeird']!=NULL){echo $episode_content['e_not_yeird'];}
			?>
			
            </div>
            
        
        <div class="rating_div">
        <div class="views_value view_episode" id="<?= $episode_content['e_id']; ?>"></div>
        <div id='rateContainor' style='float: left; width: 200px; margin-left: 20px;'>
              <div style='float:left;' class='rating' id='rateDiv'></div> 
              <div style='float: left; font-size: 8pt; clear: both; width: 100%; display:none' id='hint'></div> <div id="hint2" style='float:left;font-size:8pt'>   <?php echo "Average: ".sprintf ("%.2f",$episode_content['e_rating'])." ( ".$episode_content['e_votes']." votes)"  ?> </div>
        </div>
        </div>
        <div class="links_btns">
		    <div class="fb-like" style="margin-top:3px;" data-href="<?php echo $url."watch/".str_replace(" ","-",strtolower($episode_content['e_title'])); ?>" data-width="450" data-show-faces="false" data-send="true"></div>
	        <div class="report_vid" val="<?php echo $url.'episode.php?id='.$episode_content['e_id']; ?>">Report Broken Video</div>
	 </div>       
        
           <div class="navigation">
            <?php if(isset($prev_episode) and $prev_episode['e_id']!=NULL){
				$link=$url.$options[4]['o_value'].str_replace(" ","-",strtolower($prev_episode['e_title']));
				?>
                <a href="<?php echo $link; ?>" class="prev">Previous Episode</a>
              <?php } 
			  $ser_row=mysql_fetch_assoc($ob->get_table("an_series","a_id=".$episode_content['e_series']));
				$sublink=($ser_row['a_type2']=="dubbed")?$options[3]['o_value']:$options[2]['o_value'];
				$link=$url.$sublink.str_replace(" ","-",strtolower($ser_row['a_title'])); 
			  ?>  
                <a href="<?php echo $link;?>" class="all">All Episodes</a>
                <?php if(isset($next_episode) and $next_episode['e_id']!=NULL){
					$link=$url.$options[4]['o_value'].str_replace(" ","-",strtolower($next_episode['e_title']));
					?>
                <a href="<?php echo $link; ?>" class="next">Next Episode</a>
                <?php }?>
            </div><!--/navigation-->
   
        </div><!--/sections-->
		
		        <div style="width:100%;float:left;margin-bottom:20px" class="">
		<!-- AnimeCenter - 120x100 - Game Advertising Online -->
<iframe  marginheight="0" marginwidth="0" scrolling="no" frameborder="0" width="640" height="165" src="http://www3.game-advertising-online.com/process/serve-f.php?section=serve&id=6120&subid=&v=2hgao&output=gabo" target="_blank"></iframe><noframes>Game advertisements by <a href="http://www.game-advertising-online.com" target="_blank">Game Advertising Online</a> require iframes.</noframes>
<!-- END GAO 120x100 -->
		</div>
<div style="width:100%;float:left;margin-bottom:10px" class="">
		   <div id="disqus_thread"></div>
    <script type="text/javascript" data-cfasync='true'>
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = 'animecentertvnetwork'; // required: replace example with your forum shortname

        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
    <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
</div>
<div class="bottom_text">
 You are going to <b>Watch <?php echo $episode_content['e_title']; ?> </b> in <b> English Subbed/Dubbed </b>from <b><?php echo $ser['a_title']; ?> </b> Anime. Watch <b><?php echo $episode_content['e_title']; ?> </b>online and the other episodes of <b><?php echo $ser['a_title']; ?> </b>with High Quality Streaming for <b>FREE</b>
</div> 

       </div><!--/left_content-->
       <div id="right_content"><?php include_once("sidebar.php");?></div>
	   
   </div><!--/content-->
<script>
$(document).ready(function(e) {
   $(".popup_ads .close").click(function(){
      $(".popup_ads ").hide();
   });
   $("#rateDiv").hover(function(){
   $("#hint").show();
   $("#hint2").hide();
   });
   $("#rateDiv").mouseleave(function(){
   $("#hint").hide();
   $("#hint2").show();
   });
   $("#rateDiv").raty({ 
   score:<?php echo $episode_content['e_rating']; ?>,
    starHalf: '<?php echo $url; ?>/images/star-half.png',
	starOff : '<?php echo $url; ?>/images/star-off.png',
	starOn : '<?php echo $url; ?>/images/star-on.png',
	starHover: '<?php echo $url; ?>/images/star-hover.png',
   target:("#hint"),
   click: function(score, evt) {
   $("#hint").show().text("Saving your vote...");
   $("#hint2").hide();
    $.post("<?php echo $url; ?>rate-up.php",{eid:<?php echo $episode_content['e_id']; ?>,rate:score},function(data){
	$("#hint").show().text("your vote has been saved");
	$("#hint2").hide();
	setTimeout(function(){
	$("#hint").hide();
   $("#hint2").show().text(data);
	},1000);
	});
  },
   width:120,
   targetKeep: true,
   }
   
   ); 

});
 

</script>
<?php require_once("footer.php"); 
}//end if
?>
