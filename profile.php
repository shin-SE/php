<html>
<?php
    // エラーを出力する
    ini_set('display_errors', "On");ini_set("auto_detect_line_endings",true);
    // データベースに接続
    include('source/dbconnect.php');
	$description = 'プロファイル';
?>	
	<!-- 特定のページでのみ読み込むスタイルシートなどがあればここに追加 -->
</head>
<body>
	<?php include 'inc/header.php'; ?> <!-- header.php の読み込み -->
	<nav class="crumbs">
		<!-- ページのナビゲーション-->
		<ol>
			<li class="crumb"><a href="index.php">Top</li>
			<li class="crumb">Profile</li>
		</ol>
	</nav>
	<?php
	if (!isset($_SESSION['name'])) {
	header('Location: index.php');
    }else{
		$title = 'Bullentin board | Sin・System Engineers';
		$description = 'プロファイルtest';
		$is_home = false; //トップページの判定用の変数
		$is_snyc = false;//会員登録、ログイン、パスワード変更などの場合だけはtrue
		include ('inc/head.php'); // head.php の読み込み

	// データベースに接続
		include('source/dbconnect.php');
		
	//データ受け取る
		$id=$_SESSION['id'];
    
    // var_dump($_SESSION);
     //var_dump($id);
    
	try {
			$db = new PDO($dsn, $user, $password);
			$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			// プリペアードステートメントを作成
			$stmt = $db->prepare("
				SELECT * FROM shineva.pf WHERE user_id=:id
			");
			
			$datesql = $db->prepare("
				SELECT sign_in FROM shineva.user_kihon WHERE user_id=:id
			");
			
			// パラメータを割り当て
			$stmt->bindParam(':id',$id , PDO::PARAM_STR);
			$datesql->bindParam(':id',$id , PDO::PARAM_STR);

			
			// クエリの実行
			$stmt->execute();
			$datesql->execute();

			$row = $stmt->fetch();
			$signdate = $datesql->fetch();
			
		} catch(PDOException $e){
			die('エラー：' . $e->getMessage());
		}
		}
      //var_dump($row);
	 //var_dump($signdate);
	?>
	<wrapper>
<!-- プロファイル設定 -->

		<div class="profile">

			<div class="details">
				<img class="icon" src="profile.png"></img>
				<div class="id">
					<div class ="introduce"> 
						<p>id:<?= ($_SESSION['id']) ?></p>
						<p>name:<?= ($_SESSION['name']) ?></p>
						<p>sign in:<?= ($signdate[0]) ?></p>
						<p><?= ($row['selfintro']) ?></p>
					</div>
				</div>
			</div> 


			<div class="log">
			<!--log機能12月-->
			</div>
			
			
			<div class="setting">
				<div class="followsec">
					<a href="userlist.php" class="btn btn--green btn--radius">フォロー・ブロック</a>
				</div>
				<div class="logout">
					<a href="source/logout.php" class="btn btn--green btn--radius">ログアウト</a>
				</div>
			</div>
		</div>
</wrapper>
<?php include 'inc/footer.php'; ?> <!-- footer.php の読み込み -->
