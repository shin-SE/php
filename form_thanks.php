<!DOCTYPE html>
<html>
<?php
    
    // エラーを出力する
    ini_set('display_errors', "On");
    
	$title = 'Bullentin board | Sin・System Engineers';
	$description = '管理者へメール';
	$is_home = false; //トップページの判定用の変数
	$is_snyc = false;//会員登録、ログイン、パスワード変更などの場合だけはtrue
	include 'inc/head.php'; // head.php の読み込み
?>	
    <script type="text/javascript" src="js/check.js"></script>
	<!-- 特定のページでのみ読み込むスタイルシートなどがあればここに追加 -->
</head>	
<body>
<?php include 'inc/header.php'; ?> <!-- header.php の読み込み -->
    <nav class="crumbs">
		<ol>
			<li class="crumb"><a href="index.php">Top</a></li>
            <li class="crumb"><a href="form.php">管理者へメール</a></li>
            <li class="crumb"><a href="form_conf.php">確認画面</a></li>
            <li class="crumb">送信完了</li>
		</ol>
	</nav>
    
    <div class="form_01">
        <div class="form_xx">
            <h2>管理者へメールの送信完了</h2>
            <h4>メールの送信が完了しました。<br>ご回答ありがとございました。</h4>
            <a href="index.php" class="btn btn--green">トップページに戻る</a>
        </div>
    </div>

    <?php include 'inc/footer.php'; ?> <!-- footer.php の読み込み -->