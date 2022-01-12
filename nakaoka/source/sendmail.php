<?php
ini_set("auto_detect_line_endings",true);
//usleep(60000000);  60s
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './src/Exception.php';
require './src/PHPMailer.php';
require './src/SMTP.php';

                             // Passing `true` enables exceptions
function sendmail($mail,$cryp){
    $mail = new PHPMailer(true); 
    try {
        $name ="仮登録";
        //config
        $mail->CharSet ="UTF-8";                     //encode
        $mail->SMTPDebug = 0;                        
        $mail->isSMTP();                             // SMTPS使用
        $mail->Host = '10.15.135.60';                // SMTPサーバー
        $mail->SMTPAuth = true;                      // SMTP認証
        $mail->Username = 'Shin-SE';                // 自分の名前
        $mail->Password = 'member';             // 自分のパスワード
        $mail->SMTPSecure = 'ssl';                    //  TLS またはssl使用
        $mail->Port = 465;                            // ポート 25 または　465 

        $mail->setFrom('shinSE.com', 'マフティー');  //自分
        $mail->addAddress($mail, $name);  // 宛先
        $mail->addReplyTo('shinSE.com', 'マフティー'); //返事する時、「自分」と同じの方がいい
        //$mail->addCC('cc@example.com');                    //cc       
        //$mail->addBCC('bcc@example.com');                    //bcc

        // $mail->addAttachment('../xy.zip');         // 貼り付け
        // $mail->addAttachment('../thumb-1.jpg', 'new.jpg');    // 貼り付け＆rename

        //Content
        $mail->isHTML(false);                                  // HTMLの形式で送る
        $mail->Subject = 'Shin-SE';
        $mail->Body    = 'ご利用ありがとうございます。承認コードは'.$cryp.'です。5分以内に入力してください。';

        $mail->send();
        echo 'メール発送成功しました';
    } catch (Exception $e) {
        echo 'メール発送失敗しました', $mail->ErrorInfo;
    }
    usleep(58000000);
}