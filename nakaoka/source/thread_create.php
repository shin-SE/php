<?php
  
    if(isset($_POST['title'])&&isset($_POST['body'])){
      


      $thread_name = $_POST['title'];
      $user_name = $_SESSION['name'];
      $thread_intro = $_POST['body'];
      $category = $_POST['category'];
      
      if(!isset($_SESSION['name'])){
         echo '<span color="#FF0000">スレッドをたてる前にログインしてください。';
      }else{
      // データベースに接続
      include('source/dbconnect.php');
      //日本東京タイムゾーン指定
      date_default_timezone_set("Asia/Tokyo"); 
      // パラメータを割り当て  
        $now= date('Y-m-d H:i:s');
        $conn=mysqli_connect($host,$user,$password,$name);
        
        // -----更新1 Trdテーブルに挿入
        $stmt = mysqli_prepare($conn," INSERT INTO shineva.Trd (thread_id,thread_name,user_name, posttime,last_post_time,thread_intro) VALUES (?,?,?,?,?,?);");
        
        // 実行
        $id=0;
        $stmt->bind_param("isssss",$id,$thread_name,$user_name,$now,$now,$thread_intro);
        $res_sql_Trd_insert = $stmt->execute();
      

        //get thread id
        $sql_select_tableid = mysqli_prepare($conn,"SELECT thread_id FROM Trd WHERE thread_name=? && posttime=?;");
        $sql_select_tableid ->bind_param("ss",$thread_name,$now);
        
        // 実行
        
         $sql_select_tableid->execute();
         $sql_select_tableid->bind_result($res_id);
         $sql_select_tableid->fetch();
         
            echo "id:";
            echo $res_id."<br>" ;
            
        // -----更新2 独自のテーブル作成
        
        
        if(!$res_sql_Trd_insert){
            echo '<p color="#FF0000">Trdテーブル更新できませんでした</p>';
            exit();
        }else{
          
          $tablename="threadno".$res_id;
          $conn->close();
        try {
          $dbh = new PDO("mysql:host=".$host."; dbname=".$name."; charset=utf8", $user,$password);
          // 実行
          $sql = "CREATE TABLE ".$tablename."( 
               colume_id INT PRIMARY KEY AUTO_INCREMENT,
               user_name CHAR(20), 
               content TEXT(1000), 
               posttime datetime, 
               like_cnt INT, 
               anonymous enum('t','f') 
             )default charset=utf8";
             $res_create_table = $dbh->query($sql);
          } catch(PDOException $e) {

            echo $e->getMessage();
            die();
           }

          // 接続を閉じる
          
           $dbh = null;
           $conn=mysqli_connect($host,$user,$password,$name);
           if( $conn->connect_errno ) {
             	echo $conn->connect_errno . ' : ' . $conn->connect_error;
            }
          if(!$res_create_table){
            echo '<span color="#FF0000">スレッドテーブル作成できませんでした</span>';
            exit();
          }else{
          
          
            // ------更新3 スレッドの＃１を更新     
            
                   
           $stmt = mysqli_prepare($conn,"INSERT INTO ".$tablename." (user_name, content, posttime, anonymous) VALUES (?, ?, ?, ?);");
           $anonymous="f";
				mysqli_stmt_bind_param($stmt, "ssss", $user_name, $thread_intro, $now, $anonymous);
				$res_comment_update = mysqli_stmt_execute($stmt);
      

            if($res_comment_update){
              //テンプレートをthreadsフォルダにコピー
                copy('source/template.php','threads/'.$res_id.'.php');
              
              // スレッド詳細へ
              header('Location:threads/'.$res_id.'.php');
              exit();
            }else{
                echo "threads insert failed<br>";
                }
          }
        }
    }
  }
?>