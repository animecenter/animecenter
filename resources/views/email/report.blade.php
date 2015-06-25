<?php
if (isset($_POST['id']) and $_POST['id'] != null) {

    // multiple recipients
//$to  = 'aidan@example.com' . ', '; // note the comma
    $to = 'project.01@hotmail.com';
    $name = "AnimecentTv";

// subject
    $subject = 'Report Broken link - AnimecentTv';

    $link = $_POST['id'];
// message
    $message = '
<html>
<head>
  <title>Report Broken link -  AnimecentTv</title>
</head>
<body>
<p>Link: ' . $link . '</p></br>
</body>
</html>
';

// To send HTML mail, the Content-type header must be set
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf8' . "\r\n";

// Additional headers
    $headers .= 'From: ' . $name . "\r\n";

// Mail it
    mail($to, $subject, $message, $headers);
}
