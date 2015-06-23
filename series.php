<?php
require_once("header.php"); 
if((isset($_GET['id']) and $_GET['id']!=NULL)){
$genres=explode(",",$series_content['a_genres']);
$type=explode(",",$series_content['a_type']);
$id=$series_content['a_id'];
$episodes=$ob->get_table("an_episodes","e_series=".$id." order by e_order ASC");
$last_episodes=mysql_fetch_assoc($ob->get_table("an_episodes","e_series=".$id." and ISNULL(e_not_yeird) order by e_id DESC"));
$gen_str=str_replace(",","|",$series_content['a_genres']);
$count_sim=mysql_num_rows($ob->get_table("an_series","a_id <> ".$id." and a_genres REGEXP '".$gen_str."' limit 0,12"));
$li=rand(0,$count_sim);
$similar_series=$ob->get_table("an_series","a_id <> ".$id." and a_genres REGEXP '".$gen_str."' limit ".$li.",4");
//Get Age Color
switch($series_content['a_age']){
case "Anyone":$color="#EE82EE";break;
case "Teen +17":$color="#CC0033";break;
case "Teen +18":$color="#FF0000";break;
default:$color="#C86464";
}//end switch
?>
<div id="wrap">
   <div id="content">
   <?php include_once("banner.php");?>
       <div id="left_content">
       <div class="sec_top_one">
	       <div class="fb-like" style="height:30px;" data-href="<?php echo $url.$series_content['a_type2']."-anime/".str_replace(" ","-",strtolower($series_content['a_title'])); ?>" data-width="450" data-show-faces="false" data-send="true"></div>
	        <?php if(isset($_SESSION['u_username'])){?>
	        <a href="<?php echo $url;?>admin/index.php?page=series_up&id=<?php echo $series_content['a_id']; ?>" class="edit_top">Edit</a>
	        <?php } ?>
       </div>
        <div class="sections" id="series">
        <div class="series">
        <div class="main_title"><?php echo $series_content['a_title']; ?>
        
        <div class="login">
        <?php if(isset($_SESSION['u_username'])){?>
        <select class="member-select episodess">
        <option selected="selected" value="0">Add Episode</option>
        <option value="<?php echo $url;?>admin/index.php?page=episode_add&id=<?php echo $series_content['a_id']; ?>">Add Episode Manually</option>
        <option value="<?php echo $url;?>episode_auto_add.php" val="<?php echo $series_content['a_id']; ?>">Add Episode Automatically</option>
        </select>
        <?php }?>
        
        </div><!--/login-->
        </div>
        
        <div class="content">
        <div class="categories">
        <a href="#" class="<?php echo $series_content['a_type2']; ?>">English <?php echo $series_content['a_type2']; ?></a>
        </div>
           <div class="img"><img src="<?php echo $url;?>images/<?php echo $series_content['a_image']; ?>" /></div>
           
           <div class="texts">
             <?php if(isset($series_content['a_content']) and $series_content['a_content']!=NULL) 
			 echo $series_content['a_content']; else{?>
              <div class="text"><span>Genres:</span><?php echo str_replace(",",", ",$series_content['a_genres']); ?></div>
               <div class="text"><span>Episodes:</span> <?php echo $series_content['a_episodes']; ?></div>
               <div class="text"><span>Type:</span> <?php echo $series_content['a_type']; ?></div>
                <?php if($series_content['a_prequel']!=NULL){$ser_ser=explode(",",$series_content['a_prequel']);
				$ser_row=mysql_fetch_assoc($ob->get_table("an_series","a_id=".$ser_ser[0]));
				$link=$url.$ser_row['a_type2']."-anime/".str_replace(" ","-",strtolower($ser_row['a_title'])); 
				?><div class="text"><span>Prequel: </span> 
               <a href="<?php echo $link;?>"><?php echo $ser_ser[1]; ?></a></div><?php }?>
                <?php if($series_content['a_sequel']!=NULL){$ser_ser=explode(",",$series_content['a_sequel']);
				$ser_row=mysql_fetch_assoc($ob->get_table("an_series","a_id=".$ser_ser[0]));
				$sublink=($ser_row['a_type2']=="dubbed")?$options[3]['o_value']:$options[2]['o_value'];
				$link=$url.$sublink.str_replace(" ","-",strtolower($ser_row['a_title'])); 
				?><div class="text"><span>Sequel: </span> 
               <a href="<?php echo $link;?>"><?php echo $ser_ser[1]; ?></a></div><?php }?>
                <?php if($series_content['a_story']!=NULL){$ser_ser=explode(",",$series_content['a_story']);
				$ser_row=mysql_fetch_assoc($ob->get_table("an_series","a_id=".$ser_ser[0]));
				$sublink=($ser_row['a_type2']=="dubbed")?$options[3]['o_value']:$options[2]['o_value'];
				$link=$url.$sublink.str_replace(" ","-",strtolower($ser_row['a_title'])); 
				?><div class="text"><span>Parent Story: </span> 
               <a href="<?php echo $link;?>"><?php echo $ser_ser[1]; ?></a></div><?php }?>
                <?php if($series_content['a_side_story']!=NULL){$ser_ser=explode(",",$series_content['a_side_story']);
				$ser_row=mysql_fetch_assoc($ob->get_table("an_series","a_id=".$ser_ser[0]));
				$sublink=($ser_row['a_type2']=="dubbed")?$options[3]['o_value']:$options[2]['o_value'];
				$link=$url.$sublink.str_replace(" ","-",strtolower($ser_row['a_title'])); 
				?><div class="text"><span>Side Story: </span> 
               <a href="<?php echo $link;?>"><?php echo $ser_ser[1]; ?></a></div><?php }?>
                <?php if($series_content['a_spin_off']!=NULL){$ser_ser=explode(",",$series_content['a_spin_off']);
				$ser_row=mysql_fetch_assoc($ob->get_table("an_series","a_id=".$ser_ser[0]));
				$sublink=($ser_row['a_type2']=="dubbed")?$options[3]['o_value']:$options[2]['o_value'];
				$link=$url.$sublink.str_replace(" ","-",strtolower($ser_row['a_title'])); 
				?><div class="text"><span>Spin Off: </span> 
               <a href="<?php echo $link; ?>"><?php echo $ser_ser[1]; ?></a></div><?php }?>
                <?php if($series_content['a_alternative']!=NULL){$ser_ser=explode(",",$series_content['a_alternative']);
				$ser_row=mysql_fetch_assoc($ob->get_table("an_series","a_id=".$ser_ser[0]));
				$sublink=($ser_row['a_type2']=="dubbed")?$options[3]['o_value']:$options[2]['o_value'];
				$link=$url.$sublink.str_replace(" ","-",strtolower($ser_row['a_title'])); 
				?><div class="text"><span>Alternative: </span> 
               <a href="<?php echo $link; ?>"><?php echo $ser_ser[1]; ?></a></div><?php }?>
                <?php if($series_content['a_other']!=NULL){$ser_ser=explode(",",$series_content['a_other']);
				$ser_row=mysql_fetch_assoc($ob->get_table("an_series","a_id=".$ser_ser[0]));
				$sublink=($ser_row['a_type2']=="dubbed")?$options[3]['o_value']:$options[2]['o_value'];
				$link=$url.$sublink.str_replace(" ","-",strtolower($ser_row['a_title'])); 
				?><div class="text"><span>Other: </span> 
               <a href="<?php echo $link; ?>"><?php echo $ser_ser[1]; ?></a></div><?php }?>
               <div class="text age"><span>Age Permission: </span> <span class="age" style="background:<?php echo $color;?>"><?php echo $series_content['a_age']; ?></span></div>
               <div class="text"><span>Plot Summary:</span> <?php echo $series_content['a_description']; ?></div>
               <div class="text alternative"><span>Alternative Titles:</span> <?php echo $series_content['a_alternative_title']; ?></div>
               <?php }//end else conren?>
           </div><!--/texts-->
           <?php if(isset($last_episodes) and $last_episodes['e_id']!=NULL){
			 $link=$url.$options[4]['o_value'].str_replace(" ","-",strtolower($last_episodes['e_title']));
			 ?>
           <div class="latest-episode">
           <a href="<?php echo $link;?>">
               <div class="row main">Latest Episode</div>
               <div class="row sec"><?php echo str_replace($series_content['a_title'],"",$last_episodes['e_title']);?></div>
               <div class="row la">Watch now</div>
            </a>   
           </div><!--/lates-episode-->
          <?php }?> 
        </div><!--/content-->
        </div><!--/series-->
        <div class="rating_div">
        <div class="views_value  view_series" id="<?= $series_content['a_id']; ?>"></div>
	        <div id='rateContainor' style='float: left; width: 200px; margin-left: 20px;'>
	              <div style='float:left;' value="<?php echo $series_content['a_rating']; ?>" id="rateDiv" class='rating'></div> 
	                   <div style='float: left; font-size: 8pt; clear: both; width: 100%; display:none' id='hint'></div> <div id='hint2' style='float:left;font-size:8pt'>   <?php echo "Average: ".(($series_content['a_rating']) ? sprintf("%.2f",$series_content['a_rating']) : 0)." ( ".(($series_content['a_votes']) ? $series_content['a_votes'] : 0)." votes)"  ?> </div>
	        </div>
        </div>
        
            
        

        <div class="title" style="margin-bottom:5px;"><?php echo $series_content['a_title']; ?> Episodes</div>
        <div class="episodes">
        <ul>
        <?php 
		while($episode=mysql_fetch_assoc($episodes)){
		$link=$url.$options[4]['o_value'].str_replace(" ","-",strtolower($episode['e_title']));
		?>
		<li class="leaf"><a href="<?php echo $link;?>">
			<?php echo $episode['e_title'];?></a>
			<?php if($episode['e_not_yeird']!=NULL) echo "<span>Not Yet Aired</span>";?></li>
		<?php }//edn while ?>
		</ul>
        </div><!--/episodes-->
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

<div style="width:100%;float:left;margin-bottom:10px" class="">

</div>		
       </div><!--/left_content-->
       <div id="right_content"><?php include_once("sidebar.php");?></div>
   </div><!--/content-->
<script>

$(document).ready(function(e) {
   $("#rateDiv").hover(function(){
   $("#hint").show();
   $("#hint2").hide();
   });
   $("#rateDiv").mouseleave(function(){
   $("#hint").hide();
   $("#hint2").show();
   });
   $("#rateDiv").raty({ 
   score:<?php echo $series_content['a_rating']; ?> ,
   starHalf: '<?php echo $url; ?>/images/star-half.png',
	starOff : '<?php echo $url; ?>/images/star-off.png',
	starOn : '<?php echo $url; ?>/images/star-on.png',
	starHover: '<?php echo $url; ?>/images/star-hover.png',
   target:("#hint"),
   click: function(score, evt) {
   $("#hint").show().text("Saving your vote...");
   $("#hint2").hide();
    $.post("<?php echo $url; ?>rate-up.php",{sid:<?php echo $series_content['a_id']; ?> ,rate:score},function(data){
	$("#hint").show().text("your vote has been saved");
	$("#hint2").hide();
	setTimeout(function(){
	$("#hint").hide();
   $("#hint2").show().text(data);
	},1000);	
	});
  },
   width:110,
   targetKeep: true,
   });	
});
</script>   
<?php require_once("footer.php"); 
}//end if
?>   