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
	<nav class="crumbs">
		<ol>
			<li class="crumb"><a href="index.php">Top</a></li>
			<li class="crumb"><a href="profile.php">profile</a></li>
			<li class="crumb">User List</li>
		</ol>
	</nav>
	<section class="user01">
		<div class="follow">
			<h2>Follow list</h2>
		</div>

		<div class="follower">
			<h2>Follower list</h2>
		</div>

		<div class="block">
			<h2>Block list</h2>
		</div>
	</section>
	<?php include 'inc/footer.php'; ?> <!-- footer.php の読み込み -->
</body>
</html>
