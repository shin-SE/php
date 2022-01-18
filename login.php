<?php
// エラーを出力する
ini_set('display_errors', "On");
ini_set("auto_detect_line_endings",true);
    if(!isset($_SESSION['id'])){
		session_start();
	}
//ログインしていればトップページに移動

if (isset($_SESSION['name'])) {
  header('Location: index.php');

//ログインしていない場合
}else if (isset($_POST['email']) && isset($_POST['password'])) {
     // echo "test get post";
    
     // データベースに接続
    include('source/dbconnect.php');
      // echo "db connect";
  try {
    $db = new PDO($dsn, $user, $password);
    $db ->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    //データを受け取る
    $email=$_POST['email'] ;
     //echo $email;
    //hash
		$beforehash=$_POST['email'].$_POST['password'];
		$afterhash=hash('sha256', $beforehash);

    // プリペアドステートメントを作成
    $stmt = $db ->prepare("
    SELECT * FROM LAA1387111-shineva.user_kihon  WHERE e_mail=:e_mail AND password=:password
    ");
    
    // print_r($db->errorInfo());

    // パラメータを割り当て
    $stmt->bindParam(':e_mail',$email, PDO::PARAM_STR);
    $stmt->bindParam(':password', $afterhash,PDO::PARAM_STR);
    $flagforsql=true;

    //クエリの実行
    $stmt->execute();
    // echo "db execute";
    } catch(PDOException $e){
        die('エラー:' . $e->getMessage());
      }
    }
// ログインしていない場合はログインフォームを表示する

?>


<!DOCTYPE html>
<html>
<?php

	$title = 'Bullentin board | Sin・System Engineers';
	$description = 'ログイン';
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
      <li class="crumb">Login</li>
		</ol>
	</nav>
	<section class="login_in">
	<div class="form-group">
	
		<form action="" method="post">
            <label>Eメールを入力してください。</label><br>
            <input type="text" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" placeholder="xxxx@example.com" required>
			<br><br>
			<label>パスワードを入力してください。</label><br>
            <input type="password" name="password" id="password" value="" required><br>
            <input type="button" id="buttonPassword" value="表示" onclick="pushHideButton();"></button><br><br>

            <!-- パスワード非表示 -->
          
          <script language="javascript">
            function pushHideButton() {
              var txtPass = document.getElementById("password");
              var btnPass = document.getElementById("buttonPassword");

            if (txtPass.type === "text") {
              txtPass.type = "password";
              btnPass.value = "表示";
              
            } else {
              txtPass.type = "text";
              btnPass.value = "非表示";
            }
            
            }
          </script>
            
          <button type="submit">ログイン</button><br>
          </form>
            
      <?php

          /**
          * メール認証なしの時だけ：if($_COOKIE['terminal']==true)
          * 通常：if($_COOKIE['terminal']!=true)
          */
        if(isset($flagforsql)){  //上記のsql分が実行したかを判定する
          if ($row = $stmt->fetch()){
            // ユーザが存在していたので、端末認証行う
            if($_COOKIE['terminal']==true){
              //メール認証
                
              //四文字コード生成
              $cryp=random_int(1000,9999);
              //５分制限
              setcookie('cryp', $cryp, 60*5, '/');
              //メール発送
              include('source/sendmail.php');
              sendmail($_SESSION['email'] ,$cryp);
              
            ?>
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
			
			

      <?php
              
            }else{  
              $_SESSION['id'] = $row['user_id'];
              $_SESSION['name'] = $row['user_name'];
              $_SESSION['email'] = $_POST['email'];
              //90日間一回ログイン
              //setcookie('name', $row['user_name'], 60*60*24*90, '/');
              //端末を識別するために,一年間有効
              setcookie('terminal', 'true', 60*60*24*365, '/');
              header('Location: index.php');
              exit();
            }
          }else{
            // 1レコードも取得できなかったとき
            // ユーザ名・パスワードが間違っている可能性あり
            // もう一度ログインフォームを表示
            $acount_alert = "<script type='text/javascript'>alert('アカウント情報が間違っています.');</script>";
            echo $acount_alert;
            unset($_POST['email']);
            unset($_POST['password']);
            header('Location:login.php');
            exit();
        
        }
        }
        
      ?>
            <a href="reset.php">パスワードを忘れました</a><br><br>
            
            
		<br><br><br><br>
		
	</div>	
	</section>
	<?php include 'inc/footer.php'; ?> <!-- footer.php の読み込み -->
