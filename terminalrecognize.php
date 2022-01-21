<?php
      ini_set('display_errors', "On");
	ini_set("auto_detect_line_endings",true);
	if (!isset($_SESSION['email_temp'])) {
           session_start();
      }
      if(isset($_SESSION['email_temp'])){
            //メール認証
            
            //四文字コード生成
            $cryp=random_int(1000,9999);
            //５分制限
            $_SESSION['random']=$cryp;
            //メール発送
            $SUBJECT = "端末認証";
            $email=$_SESSION['email_temp'];
            unset($_SESSION['email_temp']);
            include('source/sendmail.php');
            

      }else{
            header("location: index.php");
      }
      if(isset($_POST['crypsecond'])){
           
            $_SESSION['email_temp']=$email;
             $cryp_int=(int)$_POST['crypsecond'];
             if($_SESSION['random']==$cryp_int){
                  //認証できた
                  $_SESSION['email'] = $email;
                  $_SESSION['id'] = $_SESSION['id_temp'];
                  $_SESSION['name'] = $_SESSION['name_temp'];
                  unset($_SESSION['email_temp']);
                  unset($_SESSION['id_temp']);
                  unset($_SESSION['name_temp']);
                  
                  header("location: index.php");
            }
      }
            
?>
<!DOCTYPE html>
<html>
<?php
	$title = 'Bullentin board | Sin・System Engineers';
	$description = 'メール認証';
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
			<li class="crumb"><a href="login.php">login</a></li>
		</ol>
	</nav>
      <?php if($is_success){?>
            <p>メールアドレスに認証コードを送りました。</p><br>メールが届いてません。<a href="login.php">ログイン画面</a>に戻る<br><br>
		<form action="" method="post">
			<input type="text" name="crypsecond" value=""><br>
			<input type="submit"><br><br>
            </form>
      <?php
      }else{ ?>
            <p>メール送信エラーです。<a href="login.php">ログイン画面</a>に戻るか、もしくは管理者に戻連絡してください。</p>
      <?php
      }
      ?>
<?php include 'inc/footer.php'; ?> <!-- footer.php の読み込み -->