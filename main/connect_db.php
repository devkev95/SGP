<?php

 $link=mysql_connect("localhost","sgp_user","56p_2016");
 
 if ($link) {
 	mysql_select_db("sgp_system", $link);
 	# code...
 }

?>