<?php
   // エラーを出力する
	ini_set('display_errors', "On");
	ini_set("auto_detect_line_endings",true);
      
	if (!isset($_SESSION['sync'])) {
           session_start();
           $_SESSION['sync']=true;
    }

  //ログインしていればトップページに移動
	if (isset($_SESSION['name'])) {
           header('Location: index.php');

  //ログインしていない場合
	}
	if (isset($_POST['email'] )) {
           //データ受け取る
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
      if(isset($_POST['email'])){
            if(isset($flag_nodata)&& $flag_nodata==true){
                        //四文字コード生成
                        $cryp=random_int(1000,9999);
                        $_SESSION['random']=$cryp;
                        //５分制限
                        //setcookie('cryp', $cryp, 60*5, '/');
                        //メール発送
                        $SUBJECT = "shinseへようこそ!";
                        include('source/sendmail.php');
                        
            }else if(isset($flag_nodata)&& $flag_nodata==false){
                        ?>このメールアドレスは既に登録していました。 <a href="reset.php">パスワードを忘れた</a><?php
                        unset($_POST['email']);
                        
            }
            
	}
      
}
if(isset($_POST['crypsecond'])){
      $cryp_int=(int)$_POST['crypsecond'];
      if($_SESSION['random']==$cryp_int){
            //認証できた
            header("Location: riyoukiyaku.php");
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
			
    		<form action="" method="post" >
    			メールアドレスを入力してください.<br>
    			<input type="email" name="email" value=""><br><br>
    			<input type="submit" value="認証コードを送信" />
            </form>
 
       
            <label>認証コードを入力してください。</label><br>
		<form action="" method="post">
			<input type="text" name="crypsecond" value=""><br><br>
			<input type="submit"><br><br>
            </form>
	</section>
<?php include 'inc/footer.php'; ?> <!-- footer.php の読み込み -->