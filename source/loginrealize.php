<?php
// エラーを出力する
ini_set('display_errors', "On");
ini_set("auto_detect_line_endings",true);
if(!isset($_SESSION['id'])){
     session_start();
  }

if (isset($_POST['email']) && isset($_POST['password'])) {

    // テ゛ータベースに接続
    include('dbconnect.php');
    try {
        $db = new PDO("mysql:host=" . $host. "; dbname=".$name, $user, $password );
        $db ->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        //データを受け取る
        $email=$_POST['email'] ;
        //hash
        $beforehash=$_POST['email'].$_POST['password'];
        $afterhash=hash('sha256', $beforehash);

        // フ゜リヘ゜アト゛ステートメントを作成
        $stmt = $db ->prepare("
        SELECT * FROM user_kihon WHERE e_mail=:e_mail AND password=:password
        ");


        // ハ゜ラメータを割り当て
        $stmt->bindParam(':e_mail',$email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $afterhash,PDO::PARAM_STR);
        $flagforsql=true;

        //クエリの実行
        $stmt->execute();
    } catch(PDOException $e){
        die('エラー:' . $e->getMessage());
    }

    if ($row = $stmt->fetch()){
        
             
        if(!isset($_COOKIE['terminal'])){      //端末cookie存在しないので、メール認証
            $_SESSION['email_temp'] = $_POST['email'];
            $_SESSION['id_temp'] = $row['user_id'];
            $_SESSION['name_temp'] = $row['user_name'];
            header('Location: ../terminalrecognize.php');
        }else{                              //端末cookie存在した、ログイン成功
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['id'] = $row['user_id'];
            $_SESSION['name'] = $row['user_name'];
            
            //90日間一回ログイン
            //setcookie('name', $row['user_name'], 60*60*24*90, '/');
            //端末を識別するために,5日間有効
            setcookie('terminal', 'true', 60*60*24*5, '/');
            header('Location: ../index.php');
            exit();
        }
      }else{
          // 1レコードも取得できなかったとき
          // ユーザ名・パスワードが間違っている可能性あり
          // もう一度ログインフォームを表示

          unset($_POST['email']);
          unset($_POST['password']);
          header('Location: ../login.php');
    }
}


?>