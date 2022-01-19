<?php
if (!isset($_SESSION['id'])) {
	echo '<div id="red">' . "\n". "\t" . "\t" . '<p>コメントする前にログインしてください。</p>' . "\n" . "\t" . '</div>' ."\n";
} else {
	// 書き込むボタンが押されたかの確認
	if (isset($_POST["body"])) {
		// 空文字の確認
		if ($_POST["body"] === "") {
			echo '<div id="red">' . "\n". "\t" . "\t" . '<p>未入力では投稿出来ません</p>' . "\n" . "\t" . '</div>' ."\n";
		}
	}
}
?>