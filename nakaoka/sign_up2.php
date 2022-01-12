<?php
	// エラーを出力する
	ini_set('display_errors', "On");
ini_set("auto_detect_line_endings",true);
	// 読み込む
	include ('source/dbconnect.php') ;
	include 'source/inputcheck.php';

        //データの受け取る
	$email=$_SESSION['email'];
	$name=$_POST['name'];
	$gender=$_POST['gender'];
	$job=$_POST['job'];

    //日本東京タイムゾーン指定
	date_default_timezone_set("Asia/Tokyo"); 
	try {
		
		$db = new PDO($dsn, $user, $password);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		
		//hash
		$beforehash=$_SESSION['email'].$_POST['password'];
		$afterhash=hash('sha256', $beforehash);

		// プリペアドステートメントを作成
		$stmt = $db->prepare("
		INSERT INTO user_kihon VALUES ( 0,:e_mail,:time,:user_name,:passwprd)
		");

		$stmt2 = $db->prepare("
		INSERT INTO pf (gender,job) VALUES (:gender,:job)
		");

		
		// パラメータを割り当て
		$stmt->bindParam(':e_mail',$email , PDO::PARAM_STR);
		$stmt->bindParam(':password', $afterhash,PDO::PARAM_STR);
		$stmt->bindParam(':user_name', $name,PDO::PARAM_STR);
		$stmt->bindParam(':time', date('Y-m-d H:i:s'),PDO::PARAM_STR);//SQL datetimeデフォルト YYYY-MM-DD HH:MM:SS
		$stmt2->bindParam(':gender', $gender,PDO::PARAM_STR);
		$stmt2->bindParam(':job', $job,PDO::PARAM_STR);

		//クエリの実行
		$stmt->execute();
		if ($row = $stmt->fetch()){
			// アップデート成功、stmt2実行
			$stmt2->execute();
			if ($row2 = $stmt2->fetch()&& $is_pass=true&& $is_comp=true && $is_name=true){
				$_SESSION['id'] = $row['user_id'];
				$_SESSION['name'] = $row['user_name'];
				//sign_up.phpで設定済み:$_SESSION['email'] = $_POST['e_mail'];
				//90日間一回ログイン
				//setcookie('email', $row['e_mail'], 60*60*24*90, '/');
				//端末を識別するために,一年間有効
				setcookie('terminal', 'true', 60*60*24*365, '/');
				header('Location: index.php');
				exit();
			} else {
				// 失敗、もう一度アップデートフォームを表示
				header('Location: sign_up2.php');
				exit();
			}
		} else {
		// 失敗、もう一度アップデートフォームを表示
		header('Location: sign_up2.php');
		exit();
		}
		} catch(PDOException $e){
		die('エラー:' . $e->getMessage());
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

	<section>

		<form action="" method="post">
			<!--ニックネーム入力-->
			<label>ニックネームを入力してください。20文字以内。</label><?php  echo namelegal($_POST['name']);?><br>
            <input type="text" name="name" value="" placeholder="password input"><br><br>
			<!--性別-->
			<label > 性別を選択してください。</label>
			<select name="gender">
				<option value="none" selected>不明</option>
				<option value="male">男</option>
				<option value="female">女</option>
				<option value="other">その他</option>
			</select>
			<!-- パスワード一回目の入力 -->
            <label>パスワードを入力してください。数字、英文字含めて8~20文字</label><?php  echo passwordlegal($_POST['password']);?><br>
            <input type="text" name="password" value="" placeholder="password input"><br><br>
            <!-- パスワード二回目の入力 -->
            <label>確認のためもう一度入力してください。</label><?php  echo comp_pass($_POST['password'],$_POST['passwordsec']);?><br>
            <input type="text" name="passwordsec" value="" placeholder="password input"><br><br>
			
        </form>
		
	</section>
	<?php include 'inc/footer.php'; ?> <!-- footer.php の読み込み -->