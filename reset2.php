<?php
session_start();
// エラーを出力する
ini_set('display_errors', "On");
ini_set("auto_detect_line_endings", true);

// 読み込む
include('source/dbconnect.php');
include('source/inputcheck.php');

//データ受け取る
$email = $_SESSION['email'];

//日本東京タイムゾーン指定
date_default_timezone_set("Asia/Tokyo");
// データベースに接続
include('source/dbconnect.php');
try {
	$db = new PDO("mysql:host=" . $host . "; dbname=" . $name, $user, $password);
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

	// プリペアドステートメントを作成
	$stmt = $db->prepare("
		UPDATE shineva.user_kihon SET password=:password WHERE e_mail=:e_mail
		");

	$stmt2 = $db->prepare("
		SELECT user_id FROM shineva.user_kihon WHERE e_mail=:e_mail
		");


	// パラメータを割り当て
	$stmt->bindParam(':e_mail', $email, PDO::PARAM_STR);
	$stmt->bindParam(':password', $afterhash, PDO::PARAM_STR);
	$stmt2->bindParam(':e_mail', $email, PDO::PARAM_STR);

	//クエリの実行
	$stmt2->execute();

	$row['user_id'] = $stmt2->fetch();

	if (isset($_POST['password'])) {
		//hash
		$beforehash = $email . $_POST['password'];
		$afterhash = hash('sha256', $beforehash);

		//パスワードチェック
		$is_pass = passwordlegal($_POST['password']);
		$is_comp = comp_pass($_POST['password'], $_POST['passwordsec']);

		//エラーアラート
		if (isset($is_pass[1])) {
			echo ($is_pass[1]);
		} else if (isset($is_comp[1])) {
			echo ($is_comp[1]);
		}

		$password = $_POST['password'];

		if ($is_pass[0] && $is_comp[0]) {
			//クエリの実行
			$stmt->execute();
			$_SESSION['id'] = $row['user_id'];
			//reset.phpで設定済み:$_SESSION['email'] = $_POST['e_mail'];


			//インデックスへ
			header('Location: index.php');
			exit();
		}
	} else if (__FILE__ == 'reset2.php') {
		// 失敗、もう一度アップデートフォームを表示
		header('Location: reset2.php');
		exit();
	}
} catch (PDOException $e) {
	die('エラー：' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html>
<?php
$title = 'Bullentin board | Sin・System Engineers';
$description = 'パスワードリセット';
$is_home = false; //トップページの判定用の変数
$is_snyc = true; //会員登録、ログイン、パスワード変更などの場合だけはtrue
include 'inc/head.php'; // head.php の読み込み
?>
<!-- 特定のページでのみ読み込むスタイルシートなどがあればここに追加 -->
</head>

<body>
	<?php include 'inc/header.php'; ?>
	<!-- header.php の読み込み -->

	<section>

		<form action="" method="post">

			<!-- パスワード一回目の入力 -->
			<label>新しいパスワードを入力してください。数字、英文字含めて8~20文字</label><br>
			<input type="password" name="password" value="" placeholder="password input"><br><br>

			<!-- パスワード二回目の入力 -->
			<label>確認のためもう一度入力してください。</label><br>
			<input type="password" name="passwordsec" value="" placeholder="password input"><br><br>

			<input type="submit" value="登録" />
		</form>
	</section>
	<?php include 'inc/footer.php'; ?>
	<!-- footer.php の読み込み -->