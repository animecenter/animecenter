<?
$country = $_SERVER["HTTP_CF_IPCOUNTRY"];
echo '<meta description="'.$country.'"/>';
$t1 = array('us','ca','au','gb');
$c = '';
if (in_array(strtolower($country), $t1)) { 
    $c = 'T1'; 
}
if($c === 'T1') { ?>
	<!-- BEGIN S0008278 POP -->

	<script>
		var _gunggo={settings:{siteID:"S0008278",pop:{type:"tab"}}};
		_gunggo.settings.pop.freqcap={frequency:1,duration:24};
	</script>
	<script src="//cdn.directrev.com/js/gp.min.js?s=S0008278"></script>

	<!-- END S0008278 POP -->
<?php } ?>

<div id="footer">

   <div class="menu">
       <div class="title">AnimeCenter</div>
       <ul>
       <?php foreach($bottom_pages_list as $bottom_page){
		if(isset($bottom_page['p_link']) and $bottom_page['p_link']!=NULL) $link=$bottom_page['p_link'];
		else $link=$url."page.php?page_id=".$bottom_page['p_id'];
		?>
            <li><a href="<?php echo $link;?>"><?php echo $bottom_page['p_title']?></a></li>
            <?php }?>
       </ul>
   </div><!--/menu-->

   <div class="menu">
       <div class="title">Popular Anime Series</div>
       <ul>
       <?php foreach($bottom2_pages_list as $bottom_page){
		if(isset($bottom_page['p_link']) and $bottom_page['p_link']!=NULL) $link=$bottom_page['p_link'];
		else $link=$url."page.php?page_id=".$bottom_page['p_id'];
		?>
            <li><a href="<?php echo $link;?>"><?php echo $bottom_page['p_title']?></a></li>
       <?php }?>
       </ul>
	  </div>
   <!--/menu-->

   <div class="menu">
       <div class="title">Affiliates</div>
       <ul>
       <?php foreach($bottom3_pages_list as $bottom_page){
	    if(isset($bottom_page['p_link']) and $bottom_page['p_link']!=NULL) $link=$bottom_page['p_link'];
		else $link=$url."page.php?page_id=".$bottom_page['p_id'];
		?>
            <li><a href="<?php echo $link;?>"><?php echo $bottom_page['p_title']?></a></li>
       <?php }?>
       </ul>
   </div><!--/menu-->
   </div><!--/footer-->
</div><!--wrap-->

<?
$page = $actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
if( $page != "http://www.animecenter.tv/index.php") {?>
<? } ?>
<script type="text/javascript">
$(document).ready(function(e){
  $("#ad-close").click(function(e){$("#popup-ad").remove();});
});
</script>

<script type="text/javascript">
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-47886553-1', 'animecenter.tv');
  ga('send', 'pageview');
</script>

</body>
</html>
<?php
require_once("bottom-cache.php");
?>
