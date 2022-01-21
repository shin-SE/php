<?php
mb_language("Japanese"); 
mb_internal_encoding("UTF-8");
$MAILTO = $email;  //宛先メールアドレス
$content = "認証コードは".$cryp."です。\n";
 
$headers = "From: info@shinse.zombie.jp\nReply-To: info@shinse.zombie.jp\n";
$is_success = mb_send_mail($MAILTO, $SUBJECT, $content, $headers);

if(!$is_success) {
  die('メール送信失敗');
}
 
?>
 