<?php
$_SERVER['REMOTE_ADDR'];

//コマンド準備

   $cmd=' cat /var/log/container |grep '.$address.'|awk "/\/shinse\/threads\/[0-9]{7}\.php/{ print substr($7,13,20),substr($4,2,20);}" |sort -nr|head 10';
//コマンド実行
   $result=shell_exec($cmd);
 //テーブル-tdタグで出力
   echo "<td>$result</td>";

?>