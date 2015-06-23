<?php
// Cache the contents to a file

#if(!isset($_SESSION['u_username']) && time() - $cachetime < filemtime($cachefile)){
#	$cached = fopen($cachefile, 'w');
#	fwrite($cached, ob_get_contents());
#	fclose($cached);
#	ob_end_flush(); // Send the output to the browser
#}
?>
