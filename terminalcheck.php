  if(isset($flagforsql)){  //��L��sql�������s�������𔻒肷��
          if ($row = $stmt->fetch()){
            // ���[�U�����݂��Ă����̂ŁA�[���F�؍s��
            if($_COOKIE['terminal']==true){
              //���[���F��
                
              //�l�����R�[�h����
              $cryp=random_int(1000,9999);
              //�T������
              setcookie('cryp', $cryp, 60*5, '/');
              //���[������
              include('source/sendmail.php');
              sendmail($_SESSION['email'] ,$cryp);
              
            ?>
      <label>�F�؃R�[�h����͂��Ă��������B</label>
      <?php
					if($_COOKIE["cryp"]!=$_POST['crypsecond']){
						echo'<span color="#FF0000">�F�؎��s���܂����B������x���[�����m�F���Ă��������B\N���[�����͂��ĂȂ����͍Ĕ����{�^���������Ă��������B</span>';
					}else{
						//�F�؂ł���
						header("location: reset2.php");
					}
				?>
			<br>
      <input type="text" name="crypsecond" value="" placeholder="code"><br><br>
			<input type="submit"><br><br>
			<button type="submit">�F�؃R�[�h���m�F</button>
			
			
