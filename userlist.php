<!DOCTYPE html>
<html>
<?php
ini_set("auto_detect_line_endings",true);
	$title = 'Bullentin board | Sin・System Engineers';
	$description = 'フォロー管理';
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
	<section>
		<h2>Follow list</h2>
		<h2>Follower list</h2>
		<h2>Block list</h2>
	</section>
	<?php include 'inc/footer.php'; ?> <!-- footer.php の読み込み -->
</body>
</html>
