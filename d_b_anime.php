<?php
$page_title="Watch Anime Online / Dubbed Browse A-Z";
$meta_title=$page_title." | Watch Anime Online Free";
$meta_desc="Watch ".$page_title."!,Watch ".$page_title."! English Subbed/Dubbed,Watch ".$page_title." English Sub/Dub, Download ".$page_title." for free,Watch ".$page_title."! Online English Subbed and Dubbed  for Free Online only at Anime Center";
$meta_key="Download ".$page_title.",Watch ".$page_title." on iphone,watch anime online, English Subbed/Dubbed, English Sub/Dub,Watch Anime for free,Download Anime,High Quality Anime";

 require_once("header.php"); 
if(isset($_GET['offset']) and $_GET['offset']!=NULL){
$off=GetSQLValueString($_GET['offset'],"int");
if($off==1) $start=0;
else{$start=($off-1)*20;}
}
else{$start=0;}

if(isset($_GET['filter']) and $_GET['filter']!=null){
$s=mysql_real_escape_string((string)$_GET['filter']);

$seriess=$ob->get_table("an_series","a_type2='dubbed' and a_title like '".$s."%' order by a_id DESC");
$count=mysql_num_rows($seriess);
$num_pages=ceil($count/20);

$seriess=$ob->get_table("an_series","a_type2='dubbed' and a_title like '".$s."%' order by a_title ASC limit ".$start.", 20");
}
else{
$seriess=$ob->get_table("an_series","a_type2='dubbed'  and a_title like 'a%' order by a_id DESC");
$count=mysql_num_rows($seriess);
$num_pages=ceil($count/20);

$seriess=$ob->get_table("an_series","a_type2='dubbed' and a_title like 'a%' order by a_title ASC limit ".$start.", 20");
}
?>
<div id="wrap">
   <div id="content">
   <?php include_once("banner.php");?>
       <div id="left_content">
        <div id="sec3" class="sections">
    
           <div class="title">Watch Anime Online / Dubbed Browse A-Z</div>
          <div class="filtering">
                <a href="<?php echo $url."browse_a-z-dubbed?filter=0";?>">0</a> 
          	<a href="<?php echo $url."browse_a-z-dubbed?filter=1";?>">1</a>
          	<a href="<?php echo $url."browse_a-z-dubbed?filter=5";?>">5</a>
          	<a href="<?php echo $url."browse_a-z-dubbed?filter=A";?>">A</a>
          	<a href="<?php echo $url."browse_a-z-dubbed?filter=B";?>">B</a>
          	<a href="<?php echo $url."browse_a-z-dubbed?filter=C";?>">C</a>
          	<a href="<?php echo $url."browse_a-z-dubbed?filter=D";?>">D</a>
          	<a href="<?php echo $url."browse_a-z-dubbed?filter=E";?>">E</a>
          	<a href="<?php echo $url."browse_a-z-dubbed?filter=F";?>">F</a>
          	<a href="<?php echo $url."browse_a-z-dubbed?filter=G";?>">G</a>
          	<a href="<?php echo $url."browse_a-z-dubbed?filter=H";?>">H</a>
          	<a href="<?php echo $url."browse_a-z-dubbed?filter=I";?>">I</a>
          	<a href="<?php echo $url."browse_a-z-dubbed?filter=J";?>">J</a>
          	<a href="<?php echo $url."browse_a-z-dubbed?filter=K";?>">K</a>
          	<a href="<?php echo $url."browse_a-z-dubbed?filter=L";?>">L</a>
          	<a href="<?php echo $url."browse_a-z-dubbed?filter=M";?>">M</a>
          	<a href="<?php echo $url."browse_a-z-dubbed?filter=N";?>">N</a>
          	<a href="<?php echo $url."browse_a-z-dubbed?filter=O";?>">O</a>
          	<a href="<?php echo $url."browse_a-z-dubbed?filter=P";?>">P</a>
          	<a href="<?php echo $url."browse_a-z-dubbed?filter=Q";?>">Q</a>
          	<a href="<?php echo $url."browse_a-z-dubbed?filter=R";?>">R</a>
          	<a href="<?php echo $url."browse_a-z-dubbed?filter=S";?>">S</a>
          	<a href="<?php echo $url."browse_a-z-dubbed?filter=T";?>">T</a>
          	<a href="<?php echo $url."browse_a-z-dubbed?filter=U";?>">U</a>
          	<a href="<?php echo $url."browse_a-z-dubbed?filter=V";?>">V</a>
          	<a href="<?php echo $url."browse_a-z-dubbed?filter=W";?>">W</a>
          	<a href="<?php echo $url."browse_a-z-dubbed?filter=X";?>">X</a>
          	<a href="<?php echo $url."browse_a-z-dubbed?filter=Y";?>">Y</a>
            <a href="<?php echo $url."browse_a-z-dubbed?filter=Z";?>">Z</a>
          </div>

           <?php 
	   while($series=mysql_fetch_assoc($seriess)) {
		   $sublink=($series['a_type2']=="dubbed")?$options[3]['o_value']:$options[2]['o_value'];
			$link=$url.$sublink.str_replace(" ","-",strtolower($series['a_title']));
		   ?>
        <a href="<?php echo $link;?>">
	         <div class="block">
	         <div class="img"><img src="images/<?php echo $series['a_image']; ?>" /></div>
	         <div class="main_title"><?php echo (strlen($series['a_title'])<10)?$series['a_title']:substr($series['a_title'],0,10)."..."; ?></div>
	         </div><!--/block-->
           </a>
           <?php } ?>
           
            <div class="pagination" <?php if($num_pages<=1){echo "style='display:none'";}?>>
                      <?php 
					   if(isset($_GET['offset'])){
						  if($_GET['offset']==1){$next=2;$prev=1;}
						  elseif($_GET['offset']>1 and $_GET['offset']<$num_pages){$next=$_GET['offset']+1;$prev=$_GET['offset']-1;}
						  elseif($_GET['offset']>=$num_pages){$next=$num_pages;$prev=$num_pages-1;}
					  }
					  else{$next=2;$prev=1;}
					  if(isset($_GET['position']) and $_GET['position']!=NULL){$position=$_GET['position'];}
					  else{$position=NULL;}
					  ?>
                       <?php if(isset($_GET['offset']) and $_GET['offset']>1){ ?><a href="<?php echo $url; ?>browse_a-z-dubbed" title="First Page">&laquo; First</a><?php }?>
                       <?php if(isset($_GET['offset']) and $_GET['offset']>1){ ?><a href="?offset=<?php echo $prev; ?>" title="Previous Page">&laquo; Previous</a><?php }?>
                       <?php 
					   if($num_pages<=12){
					   for($i=1;$i<=$num_pages;$i++){ ?>
                       <a href="?offset=<?php echo $i; ?>" class="number" title="1"><?php echo $i;?></a>
                       <?php }
					   }//end if number page
					   else{
					   $i=isset($_GET['offset'])?$_GET['offset']:1;
					   $targ=(($i+11)<=$num_pages)?$i+11:$num_pages;
					   $i=(($i+11)<=$num_pages)?$i:$num_pages-11;
					   for($i;$i<=$targ;$i++){
					   ?>
					   <a href="?offset=<?php echo $i; ?>" class="number" title="1"><?php echo $i;?></a>
					   <?php
					   }}//end else number page
					   ?>
                       <?php if(!isset($_GET['offset']) or $_GET['offset']<$num_pages){ ?><a href="?offset=<?php echo $next; ?>" title="Next Page">Next &raquo;</a><?php }?>
                       <?php if(!isset($_GET['offset']) or $_GET['offset']<$num_pages){ ?><a href="?offset=<?php echo $num_pages; ?>" title="Last Page">Last &raquo;</a><?php }?>
                     
                      </div>
	                  <!-- End .pagination -->
       </div><!--/sections-->
        
       </div><!--/left_content-->
       <div id="right_content"><?php include_once("sidebar.php");?></div>
   </div><!--/content-->
<?php require_once("footer.php"); 
?>   