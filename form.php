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
	<!-- 特定のページでのみ読み込むスタイルシートなどがあればここに追加 -->
</head>	
<body>
<?php include 'inc/header.php'; ?> <!-- header.php の読み込み -->
    <nav class="crumbs">
		<ol>
			<li class="crumb"><a href="index.php">Top</a></li>
            <li class="crumb">管理者へメール</li>
		</ol>
	</nav>
    <form action="form_conf.php" method="POST" name="form" id="form_post">
    <div class="form_01">
        <h2>管理者へメール</h2>
        <div class="form_02">
            <label>氏名</label><span>必須</span><br>
            <input type="text" name="form_name" placeholder="氏名" size="30px" required>
        </div>
        <div class="form_03">
            <label>フリガナ</label><span>必須</span><br>
            <input type="text" name="form_furigana" placeholder="フリガナ" size="30px" required>
        </div>
        <div class="form_04">
            <label>メールアドレス</label><span>必須</span><br>
            <input type="email" name="form_email" placeholder="メールアドレス" size="32px" required>
        </div>
        <div class="form_05">
            <label>電話番号</label><span>必須</span><br>
            <input type="tel" pattern="[\d-]*" name="form_tel" placeholder="電話番号" size="32px" required>
        </div>
        <div class="form_06">
            <label>お問い合わせ項目</label><span>必須</span><br>
            <select name="form_item" required>
                <option value="">お問い合わせ内容を選択してください。</option>
                <option value="ご意見・ご感想">ご意見・ご感想</option>
                <option value="ご質問・お問い合わせ">ご質問・お問い合わせ</option>
            </select>
        </div>
        <div class="form_07">
            <label>お問い合わせ内容</label><span>必須</span>
            <textarea name="form_content" placeholder="お問い合わせ内容" resize="none" required></textarea>
        </div>
        <div class="btn_form">
            <button type="submit" class="btn btn--green btnform" formaction="form_conf.php" form="form_post">確認画面へ</button>|
            <a href="form.php" class="btn btn--green">リセット</a>
        </div>
    </div>
    </form>

    <?php include 'inc/footer.php'; ?> <!-- footer.php の読み込み -->