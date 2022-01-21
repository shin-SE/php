<?php
	// エラーを出力する
	ini_set('display_errors', "On");
      ini_set("auto_detect_line_endings",true);
      session_start();
	// 読み込む
	include ('source/dbconnect.php') ;
	include ('source/inputcheck.php');
      if(isset($_POST['name'])&&isset($_POST['gender'])){
      //データの受け取る
            $email=$_SESSION['email'];
            $user_name=$_POST['user_name'];
            $gender=$_POST['gender'];
            $job=$_POST['job'];

      //日本東京タイムゾーン指定
            date_default_timezone_set("Asia/Tokyo"); 
            try {
                  
                  $db = new PDO("mysql:host=" . $host. "; dbname=".$name, $user, $password );
                  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                  
                  //hash
                  $beforehash=$_SESSION['email'].$_POST['password'];
                  $afterhash=hash('sha256', $beforehash);

                  // プリペアドステートメントを作成
                  $stmt = $db->prepare("INSERT INTO user_kihon VALUES ( 0,:e_mail,:time,:user_name,:passwprd)");

                  $stmt2 = $db->prepare("INSERT INTO pf (gender,job) VALUES (:gender,:job)");

                  
                  // パラメータを割り当て
                  $stmt->bindParam(':e_mail',$email , PDO::PARAM_STR);
                  $stmt->bindParam(':password', $afterhash,PDO::PARAM_STR);
                  $stmt->bindParam(':user_name', $user_name,PDO::PARAM_STR);
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
			<li class="crumb"><a href="sign_up.php">Sign Up</a></li>
			<li class="crumb">Sign Up2</li>
		</ol>
	</nav>

	<section>

		<form action="" method="post">
                        <!--ニックネーム入力-->
                        <label>ニックネームを入力してください。20文字以内。</label><br>
                  <input type="text" name="user_name" value="" placeholder="name"><br><br>
                        <!--性別-->
                        <label > 性別を選択してください。</label><br><br>
                  <select name="gender">
                        <option value="none" selected>不明</option>
                        <option value="male">男</option>
                        <option value="female">女</option>
                        <option value="other">その他</option>
                  </select>
                  <br><br>
                        <!-- パスワード一回目の入力 -->
                  <label>パスワードを入力してください。数字、英文字含めて8~20文字</label><br><br>
                  <input type="text" name="password" value="" placeholder="password"><br><br>
                  <!-- パスワード二回目の入力 -->
                  <label>確認のためもう一度入力してください。</label><br>
                  <input type="text" name="passwordsec" value="" placeholder="password"><br><br>
                  <!--  職業  -->
                  <select name="job">
                        <option value="other" selected>その他</option>
                        <option value="student">学生</option>
                        <option value="teacher">教師</option>
                        <option value="programer">プログラマー</option>
                  </select>
                  <button type=“submit” >進む</button>
            </form>
		
	</section>
	<?php include 'inc/footer.php'; ?> <!-- footer.php の読み込み -->