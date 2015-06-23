<?php 
$meta_title="Latest Episodes | Watch Anime Online Free";
$meta_desc="Watch Latest Episodes!,Watch Latest Episodes! English Subbed/Dubbed,Watch Latest Episodes English Sub/Dub, Download Latest Episodes for free,Watch Latest Episodes! Online English Subbed and Dubbed  for Free Online only at Anime Center";
$meta_key="Download Latest Episodes,Watch Latest Episodes on iphone,watch anime online, English Subbed/Dubbed, English Sub/Dub,Watch Anime for free,Download Anime,High Quality Anime  ";

require_once("header.php"); 

if(isset($_GET['offset']) and $_GET['offset']!=NULL){
$off=GetSQLValueString($_GET['offset'],"int");
if($off==1) $start=0;
else{$start=($off-1)*24;}
}
else{$start=0;}

$episodes=$ob->get_table("an_episodes","e_show=1 order by e_date DESC");
$count=mysql_num_rows($episodes);
$num_pages=ceil($count/24);

$episodes=$ob->get_table("an_episodes","e_show=1 order by e_date DESC limit ".$start.",24");
?>
<div id="wrap">
   <div id="content">
   <?php include_once("banner.php");?>
       <div id="left_content">
        <div id="sec2" class="sections">
           <div class="title">Latest Episodes</div>
           <?php 
		   $day1=date("Y-m-d");
		   $hr1=date("H:i:s");
		   $cp = 0;
		   while($episode=mysql_fetch_assoc($episodes)) {
		   $cp = $cp + 1;
		   $ser=mysql_fetch_assoc($ob->get_table("an_series","a_id=".$episode['e_series']));
		   $day2=date("Y-m-d H:i:s");
		   $hr2=date("Y-m-d H:i:s",$episode['e_date']);
		   
		   $first  = new DateTime($day2);
		   $second = new DateTime($hr2);
			
			$diff = $first->diff( $second );
			$link=$url.$options[4]['o_value'].str_replace(" ","-",strtolower($episode['e_title']));
			$image=thumbcreate($episode['e_subdub']);
		   ?>
           <a href="<?php echo $link;?>">
           <div class="block <? echo $cp?>">
           <div class="main_title"><?php echo (strlen($ser['a_title'])<20)?$ser['a_title']:substr($ser['a_title'],0,20)."..."; ?></div>
           <?php
           $sn = $ser['a_title'];
           $sn = str_replace(' ','-',$sn);
	   $sn = str_replace(':','',$sn);
           $snf = strtolower('/thumb/'.$sn.'-thumb.jpg');
           $path = '/home/daiky/public_html';
           $check = $path.$snf;
           if (file_exists($check)) {
                   $image = $snf;
           }
           ?>
           <div class="img"><img src="<?php echo $image; ?>" /><div class="type <?php echo $ser['a_type2']; 
		   if($episode['e_raw']!=NULL and $episode['e_subdub']==NULL) echo " raw"; ?>">
		   <?php if($episode['e_raw']!=NULL and $episode['e_subdub']==NULL) echo "RAW"; else echo $ser['a_type2']; ?></div>
	   <?php if($episode['e_hd']!=NULL){?>	   
           <div class="type mirror">HD</div>
            <?php }?>
           </div>
           <div class="play"></div>
           
           <div class="sub_title"><?php $tit=explode(" ",$episode['e_title']);echo "Episode ".end($tit);?></div>
           <div class="times">
          <?php  
           $day=$diff->format( '%d')+($diff->format( '%y')*365);
           $hr=$diff->format( '%H');  
           if($day<=0){
             if($hr<=0){
             echo $diff->format( '%i min' )." ago";
             }
             else{
             echo $diff->format( '%H hours %i min' )." ago";
             }
           }
           else{
           echo $diff->format( '%d day %H hours' )." ago";
           }
           ?> 
           </div>
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
                       <?php if(isset($_GET['offset']) and $_GET['offset']>1){ ?><a href="<?php echo $url; ?>latest-episodes" title="First Page">&laquo; First</a><?php }?>
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
