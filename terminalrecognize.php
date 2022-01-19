<?php
// エラーを出力する
ini_set('display_errors', "On");
ini_set("auto_detect_line_endings",true);
    if(!isset($_SESSION['id'])){
		session_start();
	}
//ログインしていればトップページに移動

if (isset($_SESSION['name'])) {
  header('Location: index.php');       //ログインしていない場合
}
?>


<!DOCTYPE html>
<html>
<?php

	$title = 'Bullentin board | Sin・System Engineers';
	$description = 'メールアドレス認証';
	$is_home = false; //トップページの判定用の変数
	$is_snyc = true;//会員登録、ログイン、パスワード変更などの場合だけはtrue
	include 'inc/head.php'; // head.php の読み込み


?>	
	<!-- 特定のページでのみ読み込むスタイルシートなどがあればここに追加 -->
</head>
<body>
<?php include 'inc/header.php'; 
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


<?php include 'inc/footer.php'; ?> <!-- footer.php の読み込み -->
