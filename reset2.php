<?php
	// エラーを出力する
	ini_set('display_errors', "On");ini_set("auto_detect_line_endings",true);

	// 読み込む
	include ('source/dbconnect.php') ;
	include 'source/inputcheck.php';

        //データ受け取る
　　　　$email=$_SESSION['email'];

	//日本東京タイムゾーン指定
	date_default_timezone_set("Asia/Kolkata"); 
	try {
		$db = new PDO($dsn, $user, $password);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		// プリペアドステートメントを作成
			
		//hash
		$beforehash=$_SESSION['email'].$_POST['password'];
		$afterhash=hash('sha256', $beforehash);
		$stmt = $db->prepare("
		UPDATE user_kihon　SET password=:password WHERE e_mail=:e_mail
		");

		// パラメータを割り当て
       　　　　 $stmt->bindParam(':e_mail',$email, PDO::PARAM_STR);
		$stmt->bindParam(':password', $afterhash),PDO::PARAM_STR);
		
		$password = $_POST['password'];
		if ($row = $stmt->fetch()&& $is_pass=true&& $is_comp=true ){
				$_SESSION['id'] = $row['user_id'];
				//sign_up.phpで設定済み:$_SESSION['email'] = $_POST['e_mail'];
				
				header('Location: index.php');
				exit();
		} else {
		// 失敗、もう一度アップデートフォームを表示
		header('Location: sign_up2.php');
		exit();
		}
    } catch(PDOException $e){
		die('エラー：' . $e->getMessage());
			}
?>
<!DOCTYPE html>
<html>
<?php
	$title = 'Bullentin board | Sin・System Engineers';
	$description = 'パスワードリセット';
	$is_home = false; //トップページの判定用の変数
	$is_snyc = true;//会員登録、ログイン、パスワード変更などの場合だけはtrue
	include 'inc/head.php'; // head.php の読み込み
?>	
	<!-- 特定のページでのみ読み込むスタイルシートなどがあればここに追加 -->
</head>
<body>
<?php include 'inc/header.php'; ?> <!-- header.php の読み込み -->

	<section>

	<form action="" method="post">
			
			<!-- パスワード一回目の入力 -->
            <label>新しいパスワードを入力してください。数字、英文字含めて8~20文字</label><?php  echo passwordlegal($_POST['password']);?><br>
            <input type="text" name="password" value="" placeholder="password input"><br><br>
            <!-- パスワード二回目の入力 -->
            <label>確認のためもう一度入力してください。</label><?php  echo comp_pass($_POST['password'],$_POST['passwordsec']);?><br>
            <input type="text" name="passwordsec" value="" placeholder="password input"><br><br>
			
    </form>
	</section>
<?php include 'inc/footer.php'; ?> <!-- footer.php の読み込み -->

