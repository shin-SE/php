<?php
    ini_set("auto_detect_line_endings",true);
	$title = 'Bullentin board | Sin・System Engineers';
	$description = '検索結果';
	$is_home = false; //トップページの判定用の変数
	$is_snyc = false;//会員登録、ログイン、パスワード変更などの場合だけはtrue
	include 'inc/head.php'; // head.php の読み込み

	// エラーを出力する
	/* ini_set('display_errors', "On");
	error_reporting(E_ALL); */

	// データベースに接続
	include('source/dbconnect.php');

	/* ページを開いた時$_GET["q"]は、Undefined indexだがNULLが定義されている
	空値で検索すると$_GET["q"]は、string(0) ""が定義されている
	NULLで検索すると$_GET["q"]は、string(4) "NULL"が定義されている */;
	if (!empty($_GET["q"])) {
		$q = htmlspecialchars($_GET["q"], ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401, "UTF-8", true);
		$q_value = $q;
	}else {
		$q = '""';
		$q_value = '""';
	}
	
	$choice_value;
	if (filter_input(INPUT_GET, 'choice') == "username") {
		$choice_value = "user_name"; 
	} else if (filter_input(INPUT_GET, 'choice') == "threadname") {
		$choice_value = "thread_name";
	} else if (filter_input(INPUT_GET, 'choice') == "content") {
		$choice_value = "content";
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<!-- 特定のページでのみ読み込むスタイルシートなどがあればここに追加 -->
	</head>
	<body>
		<?php include 'inc/header.php'; ?> <!-- header.php の読み込み -->
		<nav class="crumbs">
			<ol>
				<li class="crumb"><a href="index.php">Top</a></li>
				<li class="crumb">Search</li>
			</ol>
		</nav>
		<form action="" method="get">
			<p>スレッドの検索</p>
			<div>
				<input type="radio" id="choice1" name="choice" value="username" checked>
				<label for="choice1">作者</label>
				<input type="radio" id="choice2" name="choice" value="threadname">
				<label for="choice2">タイトル</label>
				<input type="radio" id="choice3" name="choice" value="content">
				<label for="choice3">内容</label><br>
			</div>
			<div>
				<label for="string">検索文字列:</label>
				<input type="text" id="string" name="q" value="<?php echo $q_value ?>"><br>
			</div>
			<div>
				<input type="submit" value="検索">
			</div>
		</form>
		<?php
		// データベースを起動する
		try {
			$conn = mysqli_connect($host,$user,$password,$name);
			if (mysqli_connect_errno()){
				echo "データベース接続失敗: " . mysqli_connect_error();
				die();
			}
			
			$sql_table="SELECT thread_id FROM trd ;";
			$res_table = mysqli_query($conn,$sql_table);
			
			if ($choice_value == "content" && $q != "") {
				while($row = mysqli_fetch_array($res_table)) {
					//$row=thread_id
					$sql = "SELECT * FROM threadno".$row." ORDER BY posttime DESC LIKE ".$q." ;";
					$res_data = mysqli_query($conn,$sql);
				}
			} else {
				$sql = "SELECT * FROM trd WHERE $choice_value LIKE '%$q%' ORDER BY last_post_time desc LIMIT 15;";
				$res_data = mysqli_query($conn,$sql);
			}
			
			if (!empty($res_data) && $res_data->num_rows > 0) {
				while($row = mysqli_fetch_array($res_data)) {
		?>
		<table>
			<tr>
				<!--タイトル-->
				<td class="threadnametd"><a href="threads/<?= ($row['thread_id']) ?>.php"><?= ($row['thread_name']) ?></a></td>
				<!--作成日-->
				<td><?= ($row['posttime']) ?></td>
				<!--作者-->
				<td><?= ($row['user_name']) ?></td>
				<!--最新更新日-->
				<td><?= ($row['last_post_time']) ?></td>
			</tr>
		</table>
		<p><?php
				}
			} else {
				echo "スレッド存在しない。";
			}
			mysqli_close($conn);
		} catch(PDOException $e) {
			echo "エラー:" . $e->getMessage();
		}
		?></p>
		
		<?php include 'inc/footer.php'; ?> <!-- footer.php の読み込み -->
