<?php
// �G���[���o�͂���
ini_set('display_errors', "On");
ini_set("auto_detect_line_endings",true);
if(!isset($_SESSION['id'])){
     session_start();
  }

if (isset($_POST['email']) && isset($_POST['password'])) {

    // �e�J�[�^�x�[�X�ɐڑ�
    include('dbconnect.php');
    try {
        $db = new PDO("mysql:host=" . $host. "; dbname=".$name, $user, $password );
        $db ->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        //�f�[�^���󂯎��
        $email=$_POST['email'] ;
        //hash
        $beforehash=$_POST['email'].$_POST['password'];
        $afterhash=hash('sha256', $beforehash);

        // �t�K���w�K�A�g�J�X�e�[�g�����g���쐬
        $stmt = $db ->prepare("
        SELECT * FROM user_kihon WHERE e_mail=:e_mail AND password=:password
        ");


        // �n�K�����[�^�����蓖��
        $stmt->bindParam(':e_mail',$email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $afterhash,PDO::PARAM_STR);
        $flagforsql=true;

        //�N�G���̎��s
        $stmt->execute();
    } catch(PDOException $e){
        die('�G���[:' . $e->getMessage());
    }

    if ($row = $stmt->fetch()){
        
             
        if(!isset($_COOKIE['terminal'])){      //�[��cookie���݂��Ȃ��̂ŁA���[���F��
            $_SESSION['email_temp'] = $_POST['email'];
            $_SESSION['id_temp'] = $row['user_id'];
            $_SESSION['name_temp'] = $row['user_name'];
            header('Location: ../terminalrecognize.php');
        }else{                              //�[��cookie���݂����A���O�C������
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['id'] = $row['user_id'];
            $_SESSION['name'] = $row['user_name'];
            
            //90���Ԉ�񃍃O�C��
            //setcookie('name', $row['user_name'], 60*60*24*90, '/');
            //�[�������ʂ��邽�߂�,5���ԗL��
            setcookie('terminal', 'true', 60*60*24*5, '/');
            header('Location: ../index.php');
            exit();
        }
      }else{
          // 1���R�[�h���擾�ł��Ȃ������Ƃ�
          // ���[�U���E�p�X���[�h���Ԉ���Ă���\������
          // ������x���O�C���t�H�[����\��

          unset($_POST['email']);
          unset($_POST['password']);
          header('Location: ../login.php');
    }
}


?>