<!DOCTYPE html>
<html>
<?php
    
    // エラーを出力する
    ini_set('display_errors', "On");
    
	$title = 'Bullentin board | Sin・System Engineers';
	$description = 'よくある質問';
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
            <li class="crumb">よくある質問</li>
		</ol>
	</nav>
    <section class="question">
        <h1>よくある質問</h1>
        <p>Q 質問  新規登録の方法を教えてください。</p>
        <p>A 答え   ～～～</p><br>
        <p>Q 質問  パスワードに使用できる文字はなんですか？</p>
        <p>A 答え   ～～～</p><br>
        <p>Q 質問 パスワードを忘れてしまいました。</p>
        <p>A 答え   パスワードのリセットをお願いします。<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;<a href="reset.php" class="this_com">パスワードリセットはこちら</a></p><br>
        <p>Q 質問  コメントを入力ができません。</p>
        <p>A 答え   入力にはログインしていただいた上で、コメントをお願いしております。<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;<a href="login.php" class="this_com">ログインはこちら</a></p><br>
        <p>Q 質問 管理者にメールを送るにはどうしたらよいですか？</p>
        <p>A 答え ～～～</p>
    </section>
    <?php include 'inc/footer.php'; ?> <!-- footer.php の読み込み -->