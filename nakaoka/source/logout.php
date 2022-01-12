<?php 
      ini_set("auto_detect_line_endings",true);
      session_start();
	session_destroy();
	header("location: index.php");
?>