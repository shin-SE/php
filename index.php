<?php
	// エラーを出力する
	ini_set('display_errors', "On");
      ini_set("auto_detect_line_endings",true);
	//１ページに表示する件数
	$no_of_records_per_page = 10;
	
    $tablename="trd";
	include ('source/dbconnect.php');
	
	$conn=mysqli_connect($host,$user,$password,$name);
	if (mysqli_connect_errno()){
		echo "データベース接続失敗: " . mysqli_connect_error();
		die();
	}
	$sql = "SELECT * FROM trd ORDER BY last_post_time desc LIMIT 15;";
	//SQL実行
	$res_data = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html>
	<?php
	$title = 'Bullentin board | Sin・System Engineers';
	$description = 'ホームページ';
	$is_home = true; //トップページの判定用の変数
	$is_snyc = false;//会員登録、ログイン、パスワード変更などの場合だけはtrue
	include 'inc/head.php'; // head.php の読み込み
?>
	<!-- 特定のページでのみ読み込むスタイルシートなどがあればここに追加 -->
</head>
<body>
	
	<?php include 'inc/header.php'; ?> <!-- header.php の読み込み -->
	
	<nav class="crumbs">
		<!-- ページのナビゲーション-->
		<ol>
			<li class="crumb">Top</li>
		</ol>
	</nav>
	
	<div class="float_box-wrap">
		<div class="indexbody">
			<article>
				<?php include 'source/thread_create.php'?>
				<!-- スレッド一覧-->  
				<?php include 'source/showthreads.php'?>
				<a href="thread_top.php" class="btn btn--green btn--radius">スレッドトップへ</a>
				
				<hr>  <!-- 横線 -->
				
				<?php include 'source/thread_create.php'?>
				<div class="postbox">
					<a id="postjump"></a>
					<h2>新しいスレッド</h2><br>
<!-- スレッド投稿 -->
	<?php include 'source/thread_create.php'?>
	<div class="postbox">
	<a id="postjump"></a>
	<form action="" method="post">
		<p>ユーザー名：<input <?php if(isset( $_SESSION['name'])==true){echo $_SESSION['name'];} ?> disabled></input>
		<p>タイトル：&nbsp;&nbsp;&nbsp;<input type="text" name="title"></p>
		<p>内容:</p><textarea name="body"></textarea>
		<p>ジャンル:&nbsp;&nbsp;&nbsp;
			<select name="category">
				<option value="entertainment">エンタメ</option>
				<option value="fashion">ファッション</option>
				<option value="travel">旅行</option>
				<option value="sports">スポーツ</option>
				<option value="games">ゲーム</option>
				<option value="animation">アニメ</option>
				<option value="gourmet">グルメ</option>
				<option value="other">その他</option>
			</select>
		</p>
		<p><button type="submit" class="<?php if(!isset($_SESSION['name'])){ echo 'disabled'; } ?> btn btn--green btn--radius">書き込む</button></p>
	</form>
	<!-- スレッド投稿end -->
				</div>
			</article>
			<?php include './inc/aside.php' ?>
		</div>
	</div>
<?php include 'inc/footer.php'; ?> <!-- footer.php の読み込み -->
