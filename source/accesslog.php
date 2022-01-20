<html>
		<!-- 特定のページでのみ読み込むスタイルシートなどがあればここに追加 -->
</head>
<body>
	<?php include 'inc/header.php'; ?> <!-- header.php の読み込み -->
	<?php
	// エラーを出力する
    ini_set('display_errors', "On");
	if (!isset($_SESSION['name'])) {
	header('Location: index.php');
    }else{
		$title = 'Bullentin board | Sin・System Engineers';
	    $description = 'アクセスログ';
		$is_home = false; //トップページの判定用の変数
		$is_snyc = false;//会員登録、ログイン、パスワード変更などの場合だけはtrue
		include ('inc/head.php'); // head.php の読み込み
    }
    
?>
<wrapper>
<!-- アクセスログ表示 -->
  $address=get_client_ip();
//コマンド準備

   $cmd=' cat /var/log/httpd/access_log |grep '.$address.'|awk "/\/shinse\/threads\/[0-9]{7}\.php/{ print substr($7,13,20),substr($4,2,20);}" |sort -nr|head 10';
//コマンド実行
   $result=shell_exec($cmd);
 //テーブル-tdタグで出力
   echo "<td>$result</th>";

</wrapper>
<?php include 'inc/footer.php'; ?> <!-- footer.php の読み込み -->
