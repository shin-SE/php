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


/**
 * ���[���F�؂Ȃ��̎������Fif($_COOKIE['terminal']==true)
 * �ʏ�Fif($_COOKIE['terminal']!=true)
 */

    if ($row = $stmt->fetch()){
        $_SESSION['email'] = $_POST['email'];
             
        if(isset($_COOKIE['terminal'])){      //�[��cookie���݂��Ȃ��̂ŁA���[���F��
            header('Location: ../terminalrecognize.php');
        }else{                              //�[��cookie���݂����A���O�C������
            $_SESSION['id'] = $row['user_id'];
            $_SESSION['name'] = $row['user_name'];
            
            //90���Ԉ�񃍃O�C��
            //setcookie('name', $row['user_name'], 60*60*24*90, '/');
            //�[�������ʂ��邽�߂�,��N�ԗL��
            setcookie('terminal', 'true', 60*60*24*365, '/');
            header('Location: ../index.php');
            exit();
        }
      }else{
          // 1���R�[�h���擾�ł��Ȃ������Ƃ�
          // ���[�U���E�p�X���[�h���Ԉ���Ă���\������
          // ������x���O�C���t�H�[����\��

          unset($_POST['email']);
          unset($_POST['password']);
          $acount_alert = "<script type='text/javascript'>alert('�A�J�E���g��񂪊Ԉ���Ă��܂�.');</script>";
          echo $acount_alert;
          header('Location: ../login.php');
    }
}


?>