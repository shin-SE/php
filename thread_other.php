<?php
// エラーを出力する
	ini_set('display_errors', "On");
	ini_set("auto_detect_line_endings",true);
	if(!isset($_SESSION['id'])){
		session_start();
	}
	$title = 'Bullentin board | Sin・System Engineers';
	$description = 'スレッドother';
	$is_home = false; //トップページの判定用の変数
	$is_snyc = false;//会員登録、ログイン、パスワード変更などの場合だけはtrue
	$tablename="trd";
	//１ページに表示する件数
	$no_of_records_per_page = 12;
    //１ページに表示する件数は当ページで指定
    if (isset($_GET['pageno'])) {
        $pageno = $_GET['pageno'];
    } else {
        $pageno = 1;
    }
	
    $offset = ($pageno-1) * $no_of_records_per_page;
    // データベース接続
    include 'source/dbconnect.php';
    $sql = "SELECT* FROM trd WHERE category = 'other' ORDER BY last_post_time desc  LIMIT $offset, $no_of_records_per_page;";
    include 'source/pagging.php';
    include '../source/pagging.php'; 
?>
<!DOCTYPE html>
<html>
<?php
    include '../inc/thread_head.php'; // head.php の読み込み
?>
</head>

<body>
<!-- header.php の読み込み -->

<?php include 'inc/header.php'; ?> 
	<nav class="crumbs">	<!-- ページのナビゲーション -->
		<ol>
			<li class="crumb"><a href="./index.php">Top</a></li>
			<li class="crumb">Thread_other</li>
		</ol>
	</nav>
	
	<article>  
	<div class="zenny_aside">
	  <?php include './inc/aside.php'?>
	</div>
		<!--スレッド表示   showthreads.php  の読み込み--->
		<?php include 'source/showthreads.php'?>
		<a href="index.php#postjump" class="btn btn--green btn--radius">スレッド投稿</a>
	</article>
	<?php include './inc/aside.php'?>

    <!--ページングボタン     pagechange.php の読み込み  -->
	<?php include 'source/pagechange.php'?>
	
	<!-- フッター設定 -->
	<?php include 'inc/footer.php'; ?>
	<!-- footer.php の読み込み -->
