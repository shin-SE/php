<html>
<?php
// エラーを出力する
	ini_set('display_errors', "On");

	$title = 'Bullentin board | Sin・System Engineers';
	$description = 'スレッド';
	$is_home = false; //トップページの判定用の変数
	$is_snyc = false;//会員登録、ログイン、パスワード変更などの場合だけはtrue
	
	//１ページに表示する件数
	$no_of_records_per_page = 15;
	
    //１ページに表示する件数は当ページで指定
    if (isset($_GET['pageno'])) {
        $pageno = $_GET['pageno'];
    } else {
        $pageno = 1;
    }

    $offset = ($pageno-1) * $no_of_records_per_page;
    // データベース接続
    include '../source/dbconnect.php';
    $conn=mysqli_connect($host,$user,$password,$name);
    $filename= __FILE__;
	$newname=substr($filename,-11,7);
	$tablename="threadno".$newname;
	$sql = "SELECT * FROM $tablename ORDER BY posttime asc  LIMIT $offset, $no_of_records_per_page;";
    include '../source/pagging.php'; 
    
	include '../inc/thread_head.php'; // head.php の読み込み
?>
		<style>
			.red p {
				color: #FF0000;
			}
		</style>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<!-- 特定のページでのみ読み込むスタイルシートなどがあればここに追加 -->
</head>

<body>
<!-- header.php の読み込み -->
<?php include '../inc/thread_header.php'; ?> 
<!--    ページの計算  pagging.php  の読み込み-->
<?php 
	
    //sql2
    $newname_int=  (int)$newname;
    $sql2 = "SELECT * FROM trd WHERE thread_id = $newname_int;";
    //スレッド名をget ためのSQL実行
    $res_data2 = mysqli_query($conn,$sql2);
    if (!empty($res_data2)){
       $row2 = mysqli_fetch_array($res_data2);
    }else{
       echo "スレッド存在しない。";
    }
?>
<!-- スレッド表示 -->

	<h2><?=($row2['thread_name'])?></h2>
	<div class="float_box-wrap">
	<div class="indexbody">
	<article>
	<table class="threadview_table">
	<!--　スレッド一覧タイトル　-->
	    <tr><th>ユーザー</th><th>内容</th><th></tr>
		<!-- スレッド一覧内容 -->
		<?php include '../source/like.php';
		      include '../source/mute.php';
		      include '../source/showcontents.php';
		      ?>
			
	</table>
	<!--　スレッド表示end -->
	
	<!--　コメント投稿　-->	
	
	<div class="postbox">
	<p>コメント投稿欄</p>
	<form action="" method="post">
		<p>ユーザー名：<input <?php if(isset($_SESSION['name'])){echo $_SESSION['name'];} ?> disabled></p>
		<p>内容:</p>
		<textarea name="body"></textarea>
		<p>匿名で投稿する:<input type="checkbox" name="anonymous" value="true"></p>
		<p><button type="submit" class="<?php if(!isset($_SESSION['name'])){ echo 'disabled'; } ?> btn btn--green btn--radius">書き込む</button></p>
	</form>
	<?php include '../source/commenting.php'?>
	<!--　スレッド投稿end　-->
	</div>
	</article>

	<?php include '../inc/aside.php'?>
	</div>
	
	<!--ページングボタン     pagechange.php の読み込み  -->
	<?php include '../source/pagechange.php'?>

	<!-- フッター設定 -->
	<?php include '../inc/footer.php'; ?>
	<!-- footer.php の読み込み -->
