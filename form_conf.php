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
            <li class="crumb">確認画面</li>
		</ol>
	</nav>
    <form action="form_conf.php" method="post" id="formpost_conf">
        <div class="form_01">
            <h2>管理者へメール 内容確認</h2>
            <div class="form_02">
                    <label>氏名</label>
                    <p><?php echo $_POST['form_name']; ?></p>
            </div>
            <div class="form_03">
                    <label>フリガナ</label>
                    <p><?php echo $_POST['form_furigana']; ?></p>
            </div>
            <div class="form_04">
                    <label>メールアドレス</label>
                    <p><?php echo $_POST['form_email']; ?></p>
            </div>
            <div class="form_05">
                    <label>電話番号</label>
                    <p><?php echo $_POST['form_tel']; ?></p>
            </div>
            <div class="form_06">
                    <label>お問い合わせ項目</label>
                    <p><?php echo $_POST['form_item']; ?></p>
            </div>
            <div class="form_07">
                    <label>お問い合わせ内容</label>
                    <p><?php echo $_POST['form_content']; ?></p>
            </div>
            <div class="btn_form">
                <a class="btn btn-green btnform" href="form.php">内容を変更する</a>|
                <button class="btn btn--green btnform" type="submit" formaction="form_thanks.php" name="submit" form="formpost_conf">送信</button>
            </div>
        </div>
    </form>
    <?php include 'inc/footer.php'; ?> <!-- footer.php の読み込み -->