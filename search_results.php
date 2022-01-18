<!DOCTYPE html>
<html>
<?php
    ini_set("auto_detect_line_endings",true);
    if(!isset($_SESSION['id'])){
		session_start();
	}
	$title = 'Bullentin board | Sin・System Engineers';
	$description = '検索結果';
	$is_home = false; //トップページの判定用の変数
	$is_snyc = false;//会員登録、ログイン、パスワード変更などの場合だけはtrue
	include 'inc/head.php'; // head.php の読み込み


	// データベースに接続
	include('source/dbconnect.php');
?>	
	<!-- 特定のページでのみ読み込むスタイルシートなどがあればここに追加 -->
</head>
<body>
	<?php include 'inc/header.php'; ?> <!-- header.php の読み込み -->
	<nav class="crumbs">
		<ol>
			<li class="crumb"><a href="index.php">Top</a></li>
			<li class="crumb"><a href="search.php">Search</a></li>
			<li class="crumb">Search Results</li>
		</ol>
	</nav>
		
	<section>
		<h1>Search results</h1>
	</section>
	<?php include 'inc/footer.php'; ?> <!-- footer.php の読み込み -->
</body>
</html>
