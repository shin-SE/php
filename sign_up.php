<?php
   // エラーを出力する
	ini_set('display_errors', "On");
	ini_set("auto_detect_line_endings",true);
	if(!isset($_SESSION['id'])){
		session_start();
	}
   //データ受け取る
	$_SESSION['email'] = $_POST['e_mail'];
    $email=$_SESSION['email'];
  //ログインしていればトップページに移動
	if (isset($_SESSION['name'])) {
    header('Location: index.php');

  //ログインしていない場合
	}else if (isset($_POST['email'] )) {
        
	    // データベースに接続
		include('source/dbconnect.php');

		$db = new PDO($dsn, $user, $password);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		// プリペアドステートメントを作成
		$stmt = $db->prepare(
			"SELECT * FROM user_kihon WHERE e_mail = :e_mail"
		);
		// パラメータを割り当て

		$stmt->bindParam(':e_mail',$email, PDO::PARAM_STR);
		//クエリの実行
		try{
			$stmt->execute();
		//$result = $stmt->fetch(PDO::FETCH_ASSOC);
		} catch(PDOException $e){
			die('エラー:' . $e->getMessage());
		}
	}
			
?>
<!DOCTYPE html>
<html>
<?php
	$title = 'Bullentin board | Sin・System Engineers';
	$description = '会員登録';
	$is_home = false; //トップページの判定用の変数
	$is_snyc = true;//会員登録、ログイン、パスワード変更などの場合だけはtrue
	include 'inc/head.php'; // head.php の読み込み
?>	
	<!-- 特定のページでのみ読み込むスタイルシートなどがあればここに追加 -->
</head>	
<body>
<?php include 'inc/header.php'; ?> <!-- header.php の読み込み -->
	<nav class="crumbs">
		<ol>
			<li class="crumb"><a href="index.php">Top</a></li>
			<li class="crumb">Sign Up</li>
		</ol>
	</nav>
	
	<!-- 認証コード入力設定 -->
	<section>
		<form action="" method="post">
			<label>メールアドレスを入力してください.</label>
			<?php
				if($row = $stmt->fetch()){  //stmt成功したら
					echo '<span color="#FF0000">このメールアドレスは既に登録しています。ログインやパスワード変更に進んでください。</span>';
				}else{
					?>
			<script type="text/javascript">
				btn.disabled = false; //mailer button tap able
			</script>
			<?php
				}
			?>
			<br>
			<input type="email" name="email" value="" placeholder="xxxx@example.com"><br><br>
			<input type="submit"><br><br>
			<input type="button" onclick="sendCode(this)" value="認証コードを送信" />

			<script type="text/javascript">
				var clock = '';
				var nums = 60;
				var btn;
				function sendCode(thisBtn) {
					//php
					<?php 
					//四文字コード生成
					$cryp=random_int(1000,9999);
					//５分制限
					setcookie('cryp', $cryp, 60*5, '/');
					//メール発送
					include('source/sendmail.php');
					sendmail($_SESSION['email'] ,$cryp);
					?>

					
					btn = thisBtn;
					btn.disabled = true; //button tap disable
					btn.value = nums + '秒後再発行';
					clock = setInterval(doLoop, 1000); //カウンター

				}
				function doLoop() {
					nums--;
					if (nums > 0) {
						btn.value = '(あと'+nums + '秒)';
					} else {
						clearInterval(clock); //カウンタークリア
						btn.disabled = false;
						btn.value = '再発行';
						nums = 60; //タイムリセット
					}
				}
				</script>
            <label>認証コードを入力してください。</label>
				<?php
					if($_COOKIE["cryp"]!=$_POST['crypsecond']){
						echo'<span color="#FF0000">認証失敗しました。もう一度メールを確認してください。\Nメールが届いてない時は再発送ボタンを押してください。</span>';
					}else{
						//認証できた
						header("location: riyoukiyaku.php");
					}
				?>
			<br>
			<input type="text" name="crypsecond" value="" placeholder="code"><br><br>
			<input type="submit"><br><br>
			<button type="submit">認証コードを確認</button>
        </form>
	</section>
				</div>
<?php include 'inc/footer.php'; ?> <!-- footer.php の読み込み -->
