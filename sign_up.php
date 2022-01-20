<?php
   // エラーを出力する
	ini_set('display_errors', "On");
	ini_set("auto_detect_line_endings",true);
    echo 'test111';
	if (!isset($_SESSION['sync'])) {
           session_start();
           $_SESSION['sync']=true;
    }
  //ログインしていればトップページに移動
	if (isset($_SESSION['name'])) {
           header('Location: index.php');

  //ログインしていない場合
	}
	echo 'test2222';
	if (isset($_POST['email'] )) {
           //データ受け取る
           echo 'test333';
	       $_SESSION['email'] = $_POST['email'];
           $email=$_SESSION['email'];
      	    // データベースに接続
      		include('source/dbconnect.php');

            try {
                    $db = new PDO("mysql:host=" . $host. "; dbname=".$name, $user, $password );
                    $db ->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

                    //データを受け取る
                    $email=$_POST['email'] ;
                    // フ゜リヘ゜アト゛ステートメントを作成
                    $stmt = $db->prepare("SELECT * FROM user_kihon WHERE e_mail=:e_mail");

                    // ハ゜ラメータを割り当て
                    $stmt->bindParam(':e_mail',$email, PDO::PARAM_STR);
                    $flagforsql=true;

                    //クエリの実行
                    $stmt->execute();
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    if($result==null){
                          $flag_nodata=true;
                       }else if($result!=null){
                          $flag_nodata=false;
                       }
	        }catch(PDOException $e){
			        die('エラー:' . $e->getMessage());
		    }
	}
			
?>
<!DOCTYPE html>
<html>
<?php
	$title = 'Bullentin board | Sin・System Engineers';
	$description = '会員登録';
	$is_home = false; //トップページの判定用の変数
	$is_snyc = true;//会員登録、ログイン、パスワード変更などの場合だけはtrue
	include 'inc/head.php'; // head.php の読み込み
?>	
	<!-- 特定のページでのみ読み込むスタイルシートなどがあればここに追加 -->
</head>	
<body>
<?php include 'inc/header.php'; ?> <!-- header.php の読み込み -->
	<nav class="crumbs">	<!-- ページのナビゲーション -->
		<ol>
			<li class="crumb"><a href="index.php">Top</a></li>
			<li class="crumb">Thread_Top</li>
		</ol>
	</nav>
	<!-- 認証コード入力設定 -->
	<section>
			<?php if(isset($_POST['email'])) echo $_POST['email'] ;?>
			
    		<form action="" method="post" >
    			メールアドレスを入力してください.<br>
    			<input type="email" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'] ;?>"><br><br>
    			<input type="submit" value="認証コードを送信" />
            </form>
 


       
            <label>認証コードを入力してください。</label>
				<?php 
				     if(isset($_POST['email'])){
			               if(isset($flag_nodata)&& $flag_nodata==true){
                 					//四文字コード生成
                 					$cryp=random_int(1000,9999);
                 					echo $cryp;
                 					//５分制限
                 					setcookie('cryp', $cryp, 60*5, '/');
                 					//メール発送
                 					include('source/sendmail.php');
         					}else if(isset($flag_nodata)&& $flag_nodata==false){
         					        echo 'このメールアドレスは既に登録していました。';
         					        unset($_POST['email']);
				        }
            				if(isset($_POST['crypsecond'])){
            					if($_COOKIE["cryp"]!=$_POST['crypsecond']){
            						  echo'<span color="#FF0000">認証失敗しました。もう一度メールを確認してください。\Nメールが届いてない時は再発送ボタンを押してください。</span>';
            					}else if($_COOKIE["cryp"]==$_POST['crypsecond']){
            						  //認証できた
            						  header("location: riyoukiyaku.php");
            					}
            				}
            		}
				?>
			<br>
		<form action="" method="post">
			<input type="text" name="crypsecond" value=""><br><br>
			<input type="submit"><br><br>
        </form>
	</section>
<?php include 'inc/footer.php'; ?> <!-- footer.php の読み込み -->