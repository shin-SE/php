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
	
		<form action="source/loginrealize.php" method="post">
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

            <a href="reset.php">パスワードを忘れました</a><br><br>
            
            
		<br><br><br><br>
		
	</div>	
	</section>
	<?php include 'inc/footer.php'; ?> <!-- footer.php の読み込み -->
