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
        <p>A 答え   はじめにメール認証での登録をしていただき、完了後にプロファイルを作成していただきます。
                    最後に利用規約に同意を頂きましたら完了になります。
        </p><br>
        <p>Q 質問  パスワードに使用できる文字はなんですか？</p>
        <p>A 答え   パスワードに使用できる文字は英数字の組み合わせで、8～16文字の長さで登録をお願いしております。</p><br>
        <p>Q 質問   プロファイルには何を登録できますか？</p>
        <p>A 答え   要録できるのはユーザ名と自己紹介文の2つになります。それぞれに登録できる文字数制限がありますのでご注意下さい。</p><br>
        <p>Q 質問  プロファイルで登録できるユーザ名と自己紹介文の最大文字数はどのくらいですか？</p>
        <p>A 答え ユーザ名では20文字以下、自己紹介文は500文字以下でそれぞれ登録をお願いします。</p><br>
        <p>Q 質問 パスワードを忘れてしまいました。</p>
        <p>A 答え   セキュリティ対策でパスワードのリセットをお願い致しております。<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;<a href="reset.php" class="this_com">パスワードリセットはこちら</a></p><br>
        <p>Q 質問  コメントを入力ができません。</p>
        <p>A 答え   入力にはログインしていただいた上で、コメントをお願いしております。<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;<a href="login.php" class="this_com">ログインはこちら</a></p><br>
        <p>Q 質問 管理者にメールを送るにはどうしたらよいですか？</p>
        <p>A 答え ページの下部のある管理者へメールと表記されていますところをクリックしますと、管理者へメールが
            送信できるページに遷移します。そこから要件を記載したメールを送信されますと管理者へメールが届きます。
        </p>
    </section>
    <?php include 'inc/footer.php'; ?> <!-- footer.php の読み込み -->
