<?php

$url = 'http://markstcyr.com/2016/02/07/dot-com-2-0-the-sequel-unfolds/';
$content = file_get_contents($url);
$first_step = explode( "<h1" , $content );
$second_step = explode( ">" , $first_step[1] );
$third_step = explode( "</h1>" , $second_step[1] );


echo $third_step[0];

?>