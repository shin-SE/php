<?php
	if (!isset($_SESSION['name'])) {
		echo '<div class="red">' . "\n". "\t" . "\t" . '<p>コメントする前にログインしてください。</p>' . "\n" . "\t" . '</div>' ."\n";
	} else {
		if (isset($_POST["body"])) {
			$body = htmlspecialchars($_POST["body"], ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401, "UTF-8", true);
			
			// データベースに接続
			include('dbconnect.php');
			//日本東京タイムゾーン指定
			date_default_timezone_set("Asia/Tokyo"); 

			// パラメータを割り当て
			$user_name=$_SESSION['name'];
			$anonymous;
			if (filter_input(INPUT_POST, 'anonymous') == "true") {
				$anonymous="t";
			} else {
				$anonymous="f";
			}
			$time=date('Y-m-d H:i:s');
			mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
			$mysqli = mysqli_connect($host,$user,$password,$name);
			if (!$mysqli) {
				echo "データベース接続失敗: " . mysqli_connect_error();
				die();
			}
			
			try {
				$sql="INSERT INTO ".$tablename." (user_name, content, posttime, anonymous) VALUES (?, ?, ?, ?);";
				$stmt = mysqli_prepare($mysqli, $sql);
				mysqli_stmt_bind_param($stmt, "ssss", $user_name, $body, $time, $anonymous);
				$res_comment_update = mysqli_stmt_execute($stmt);
			} catch (mysqli_sql_exception $e) {
				echo $e->getMessage();
			}
			// 実行
			// $res_comment_update = $stmt->execute();

			if ( $res_comment_update!=false ) {
				//変数型変更 文字列newname --->INT newname_int
				$newname_int=  (int)$newname;
				//Trdテーブルの最新更新日を更新
				$sql_Trd_update="UPDATE Trd SET last_post_time = ? WHERE thread_id = ?;";
				$stmt2 = mysqli_prepare($mysqli, $sql_Trd_update);
				mysqli_stmt_bind_param($stmt2, "si", $time, $newname_int);
				// 実行
				$res_Trd_update = mysqli_stmt_execute($stmt2);
				mysqli_close($mysqli);
				if ($res_Trd_update) {
					header('Location: '.$newname.'.php');
					exit();
				} else {
					echo 'Trdテーブル更新失敗しました。';
					// printf("Error message:%s\n",$mysqli->error);
				}
			} else {
				echo 'threadnoテーブル更新失敗しました。';
			}
		}
	}
?>