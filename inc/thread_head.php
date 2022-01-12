<?php 
if(isset($_SESSION['id'])){
           session_start();
}
		
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
	<!-- 読み込み元ファイルの2行目の $title -->
   <title><?php echo $title; ?></title> 
   <meta name="description" content="<?php echo $description; ?>">
