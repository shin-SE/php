<?php
// �G���[���o�͂���
ini_set('display_errors', "On");
ini_set("auto_detect_line_endings",true);
    if(!isset($_SESSION['id'])){
		session_start();
	}
//���O�C�����Ă���΃g�b�v�y�[�W�Ɉړ�

if (isset($_SESSION['name'])) {
  header('Location: index.php');       //���O�C�����Ă��Ȃ��ꍇ
}
?>


<!DOCTYPE html>
<html>
<?php

	$title = 'Bullentin board | Sin�ESystem Engineers';
	$description = '���[���A�h���X�F��';
	$is_home = false; //�g�b�v�y�[�W�̔���p�̕ϐ�
	$is_snyc = true;//����o�^�A���O�C���A�p�X���[�h�ύX�Ȃǂ̏ꍇ������true
	include 'inc/head.php'; // head.php �̓ǂݍ���


?>	
	<!-- ����̃y�[�W�ł̂ݓǂݍ��ރX�^�C���V�[�g�Ȃǂ�����΂����ɒǉ� -->
</head>
<body>
<?php include 'inc/header.php'; ?> <!-- header.php �̓ǂݍ��� -->
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


<?php include 'inc/footer.php'; ?> <!-- footer.php �̓ǂݍ��� -->
