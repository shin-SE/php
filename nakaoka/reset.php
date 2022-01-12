<?php
// エラーを出力する
ini_set('display_errors', "On");ini_set("auto_detect_line_endings",true);
$email=$_POST['email'];
if (isset($_POST['email'] )) {
	// データベースに接続
	include('source/dbconnect.php');
	
    try {
		$db = new PDO($dsn, $user, $password);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		// プリペアードステートメントを作成
		$stmt = $db->prepare(
		  "SELECT * FROM user_kihon WHERE e_mail = :e_mail"
		);

		// パラメータを割り当て
		$stmt->bindParam(':e_mail', $email, PDO::PARAM_STR);	//$_POST['email']で入力されたメールアドレスを取得する。
		
		// クエリの実行
		$stmt->execute();
	} catch(PDOException $e){
		die('エラー:' . $e->getMessage());
	}
}
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
		
	<form action="" method="post">
			<label>メールアドレスを入力してください.</label>
			<?php
				if(!$row = $stmt->fetch()){  //stmt失敗したら
					echo '<span color="#FF0000">このメールアドレスは存在してません。ログインやパスワード変更に進んでください。</span>';
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
						header("location: reset2.php");
					}
				?>
			<br>
			<input type="text" name="crypsecond" value="" placeholder="code"><br><br>
			<input type="submit"><br><br>
			<button type="submit">認証コードを確認</button>
        </form>
	</section>

	<?php include 'inc/footer.php'; ?> <!-- footer.php の読み込み -->