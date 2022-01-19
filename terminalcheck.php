  if(isset($flagforsql)){  //上記のsql分が実行したかを判定する
          if ($row = $stmt->fetch()){
            // ユーザが存在していたので、端末認証行う
            if($_COOKIE['terminal']==true){
              //メール認証
                
              //四文字コード生成
              $cryp=random_int(1000,9999);
              //５分制限
              setcookie('cryp', $cryp, 60*5, '/');
              //メール発送
              include('source/sendmail.php');
              sendmail($_SESSION['email'] ,$cryp);
              
            ?>
      <label>認証コードを入力してください。</label>
      <?php
					if($_COOKIE["cryp"]!=$_POST['crypsecond']){
						echo'<span color="#FF0000">認証失敗しました。もう一度メールを確認してください。\Nメールが届いてない時は再発送ボタンを押してください。</span>';
					}else{
						//認証できた
						header("location: reset2.php");
					}
				?>
			<br>
      <input type="text" name="crypsecond" value="" placeholder="code"><br><br>
			<input type="submit"><br><br>
			<button type="submit">認証コードを確認</button>
			
			
