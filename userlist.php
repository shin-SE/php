<!DOCTYPE html>
<html>
<?php
    ini_set('display_errors', "On");
    ini_set("auto_detect_line_endings",true);
	$title = 'Bullentin board | Sin・System Engineers';
	$description = 'フォロー管理';
	$is_home = false; //トップページの判定用の変数
	$is_snyc = false;//会員登録、ログイン、パスワード変更などの場合だけはtrue
	include 'inc/head.php'; // head.php の読み込み

	// データベースに接続
	include('source/dbconnect.php');
	$conn=mysqli_connect($host,$user,$password,$name);
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
                <?php   
                	$id=$_SESSION['id'];
                	$stmt_follow = mysqli_prepare($conn, "SELECT user_name FROM user_kihon where user_id IN(SELECT follow_id FROM follow WHERE follower_id=?)");
                	$stmt_follow->bind_param("i", $id);
                    $stmt_follow->execute();
                    $stmt_follow->bind_result($name);
                    while ($stmt_follow->fetch()) {
                        echo $name."<br>"; 
                    }
                ?>
		</div>

	<div class="follower">
			<h2>Follower list</h2>
                <?php   
                	$stmt_follower = mysqli_prepare($conn, "SELECT user_name FROM user_kihon where user_id IN(SELECT follower_id FROM follow WHERE follow_id=?)");
                	$stmt_follower->bind_param("i", $id);
                    $stmt_follower->execute();
                    $stmt_follower->bind_result($name);
                    while ($stmt_follower->fetch()) {
                        echo $name."<br>"; 
                    }
                	?>
		</div>

		<div class="block">
			<h2>Block list</h2>
                 <?php   
                 	$stmt_block = mysqli_prepare($conn, "SELECT user_name FROM user_kihon where user_id IN(SELECT blockoppoment_id FROM block WHERE user_id=?)");
                 	$stmt_block->bind_param("i", $id);
                    $stmt_block->execute();
                    $stmt_block->bind_result($name);
                    while ($stmt_block->fetch()) {
                          echo $name."<br>"; 
                     }
                 	?>
		</div>
	</section>
	<?php include 'inc/footer.php'; ?> <!-- footer.php の読み込み -->
</body>
</html>
