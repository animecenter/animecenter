<?php
if(isset($_POST['url'])){
	$cache_path = '/home/nginx-cache/animecenter/';
	if($_POST['url']=='all'){
		exec("find $cache_path -type f -delete");
		echo "All Cache => Purge initiated";
	}else{
		$url = parse_url($_POST['url']);
		if(!$url){
			echo 'Invalid URL entered';
			die();
		}
		$scheme 	= $url['scheme'];
		$host 		= $url['host'];
		$requesturi = $url['path'];
		$hash = md5($scheme.'GET'.$host.$requesturi);
		$cache_path . substr($hash, -1) . '/' . substr($hash,-3,2) . '/' . $hash;
		#$cache_file = exec("grep -lr '$requesturi' $cache_path | xargs rm");
		if(unlink($cache_path . substr($hash, -1) . '/' . substr($hash,-3,2) . '/' . $hash)){
			echo $_POST['url']." => Purge initiated";
		}
	}
}
?>
<form enctype="multipart/form-data" method="post" action="">
	<div style="width:100%;" class="inputNOption">
		<input type="text" style="width:80%;" class="textInput" value="" name="url" placeholder="http://www.animecenter.tv/watch/fairy-tail-2014-episode-8 or all">
		<input id="submit" type="submit" value="Purge Cache" name="Purge" style="margin-top: -5px">
	</div>	
</form>