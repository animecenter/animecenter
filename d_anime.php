<?php
$page_title="Watch Anime Online / Dubbed Anime List";
$meta_title=$page_title." | Watch Anime Online Free";
$meta_desc="Watch ".$page_title."!,Watch ".$page_title."! English Subbed/Dubbed,Watch ".$page_title." English Sub/Dub, Download ".$page_title." for free,Watch ".$page_title."! Online English Subbed and Dubbed  for Free Online only at Anime Center";
$meta_key="Download ".$page_title.",Watch ".$page_title." on iphone,watch anime online, English Subbed/Dubbed, English Sub/Dub,Watch Anime for free,Download Anime,High Quality Anime";

 require_once("header.php"); 
if(isset($_GET['filter']) and $_GET['filter']!=null){
$s=mysql_real_escape_string((string)$_GET['filter']);
$seriess=$ob->get_table("an_series","a_type2='dubbed' and a_title like '".$s."%' order by a_title ASC");
}
else{
$seriess=$ob->get_table("an_series","a_type2='dubbed' and a_title like 'a%' order by a_title ASC");
}
?>
<div id="wrap">
   <div id="content">
   <?php include_once("banner.php");?>
       <div id="left_content">
        <div id="sec4" class="sections">
    
           <div class="title">Watch Anime Online / Dubbed Anime List</div>
          <div class="filtering">
                <a href="<?php echo $url."anime-list-dubbed?filter=0";?>">0</a> 
          	<a href="<?php echo $url."anime-list-dubbed?filter=1";?>">1</a>
          	<a href="<?php echo $url."anime-list-dubbed?filter=5";?>">5</a>
          	<a href="<?php echo $url."anime-list-dubbed?filter=A";?>">A</a>
          	<a href="<?php echo $url."anime-list-dubbed?filter=B";?>">B</a>
          	<a href="<?php echo $url."anime-list-dubbed?filter=C";?>">C</a>
          	<a href="<?php echo $url."anime-list-dubbed?filter=D";?>">D</a>
          	<a href="<?php echo $url."anime-list-dubbed?filter=E";?>">E</a>
          	<a href="<?php echo $url."anime-list-dubbed?filter=F";?>">F</a>
          	<a href="<?php echo $url."anime-list-dubbed?filter=G";?>">G</a>
          	<a href="<?php echo $url."anime-list-dubbed?filter=H";?>">H</a>
          	<a href="<?php echo $url."anime-list-dubbed?filter=I";?>">I</a>
          	<a href="<?php echo $url."anime-list-dubbed?filter=J";?>">J</a>
          	<a href="<?php echo $url."anime-list-dubbed?filter=K";?>">K</a>
          	<a href="<?php echo $url."anime-list-dubbed?filter=L";?>">L</a>
          	<a href="<?php echo $url."anime-list-dubbed?filter=M";?>">M</a>
          	<a href="<?php echo $url."anime-list-dubbed?filter=N";?>">N</a>
          	<a href="<?php echo $url."anime-list-dubbed?filter=O";?>">O</a>
          	<a href="<?php echo $url."anime-list-dubbed?filter=P";?>">P</a>
          	<a href="<?php echo $url."anime-list-dubbed?filter=Q";?>">Q</a>
          	<a href="<?php echo $url."anime-list-dubbed?filter=R";?>">R</a>
          	<a href="<?php echo $url."anime-list-dubbed?filter=S";?>">S</a>
          	<a href="<?php echo $url."anime-list-dubbed?filter=T";?>">T</a>
          	<a href="<?php echo $url."anime-list-dubbed?filter=U";?>">U</a>
          	<a href="<?php echo $url."anime-list-dubbed?filter=V";?>">V</a>
          	<a href="<?php echo $url."anime-list-dubbed?filter=W";?>">W</a>
          	<a href="<?php echo $url."anime-list-dubbed?filter=X";?>">X</a>
          	<a href="<?php echo $url."anime-list-dubbed?filter=Y";?>">Y</a>
            	<a href="<?php echo $url."anime-list-dubbed?filter=Z";?>">Z</a>
          </div>

           <?php 
	   while($series=mysql_fetch_assoc($seriess)) {
		   $sublink=($series['a_type2']=="dubbed")?$options[3]['o_value']:$options[2]['o_value'];
			$link=$url.$sublink.str_replace(" ","-",strtolower($series['a_title']));
		   ?>
        <a href="<?php echo $link;?>">
            <div class="block">
	     <a href="<?php echo $link;?>">
	    <img class='eimg' src="images/<?php echo $series['a_image']; ?>" />
	    <div class="sub_title"><?php echo (strlen($series['a_title'])<20)?$series['a_title']:substr($series['a_title'],0,20)."..."; ?></div>
	     </a>
	     <div class='rateContainor'  style='width:220px;;margin-top:5px;float:left'>
               <div style='float:left;' value="<?php echo $series['a_rating']; ?>" id="<?php echo $series['a_id']; ?>" class='rateDiv'></div> 
              <div style='float: left; font-size: 8pt;  width: 100%; display:none' id='hint<?php echo $series['a_id']; ?>' > </div><div
			  id='hint2<?php echo $series['a_id']; ?>' style='width:100%;font-size:8pt;float:left'>   <?php echo "Average: ". sprintf ("%.2f",$series['a_rating'])." ( ". $series['a_votes']." votes)"  ?> </div>
                </div>
	    </div><!--/block-->
        <?php } ?>
       </div><!--/sections-->
        
       </div><!--/left_content-->
       <div id="right_content"><?php include_once("sidebar.php");?></div>
   </div><!--/content-->
<?php require_once("footer.php"); ?>   
<script>
$(document).ready(function(e) {
	 $(".rateDiv").hover(function(){
   $("#hint"+$(this).attr("id")).show();
   $("#hint2"+$(this).attr("id")).hide();
   });
   $(".rateDiv").mouseleave(function(){
   $("#hint"+$(this).attr("id")).hide();
   $("#hint2"+$(this).attr("id")).show();
   });
	$(".rateDiv").each(function(index, element) {
	var thiss=$(element);	
      $(element).raty({ 
   score:$(this).attr("value"),
   starHalf: '<?php echo $url; ?>/images/star-half.png',
	starOff : '<?php echo $url; ?>/images/star-off.png',
	starOn : '<?php echo $url; ?>/images/star-on.png',
	starHover: '<?php echo $url; ?>/images/star-hover.png',
 width:120,
target:$("#hint"+$(this).attr("id")),
 click: function(score, evt) {
 $("#hint"+$(this).attr("id")).show().text("Saving your vote...");
   $("#hint2"+$(this).attr("id")).hide();
   $.post("<?php echo $url; ?>rate-up.php",{sid:$(this).attr("id"),rate:score},function(data){
   $("#hint"+thiss.attr("id")).show().text("your vote has been saved");
	$("#hint2"+thiss.attr("id")).hide();
	setTimeout(function(){
	$("#hint"+thiss.attr("id")).hide();
   $("#hint2"+thiss.attr("id")).show().text(data);
	},1000);
   });
  },

	  
	   targetKeep:true
   }
   
   ); 

    });

});
</script>
