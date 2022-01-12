<html>
	
	<!-- ����̃y�[�W�ł̂ݓǂݍ��ރX�^�C���V�[�g�Ȃǂ�����΂����ɒǉ� -->
</head>
<body>
	<?php include 'inc/header.php'; ?> <!-- header.php �̓ǂݍ��� -->
	<?php
	// �G���[���o�͂���
    ini_set('display_errors', "On");
	if (!isset($_SESSION['name'])) {
	header('Location: index.php');
    }else{
		$title = 'Bullentin board | Sin�ESystem Engineers';
	    $description = '�A�N�Z�X���O';
		$is_home = false; //�g�b�v�y�[�W�̔���p�̕ϐ�
		$is_snyc = false;//����o�^�A���O�C���A�p�X���[�h�ύX�Ȃǂ̏ꍇ������true
		include ('inc/head.php'); // head.php �̓ǂݍ���
    }
    
?>
<wrapper>
<!-- �A�N�Z�X���O�\�� -->
  $address=get_client_ip();
//�R�}���h����

   $cmd=' cat /var/log/httpd/access_log |grep '.$address.'|awk "/\/shinse\/threads\/[0-9]{7}\.php/{ print substr($7,13,20),substr($4,2,20);}" |sort -nr|head 10';
//�R�}���h���s
   $result=shell_exec($cmd);
 //�e�[�u��-td�^�O�ŏo��
   echo "<td>$result</th>";

</wrapper>
<?php include 'inc/footer.php'; ?> <!-- footer.php �̓ǂݍ��� -->