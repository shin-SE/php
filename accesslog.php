<?php
$_SERVER['REMOTE_ADDR'];

//�R�}���h����

   $cmd=' cat /var/log/container |grep '.$address.'|awk "/\/shinse\/threads\/[0-9]{7}\.php/{ print substr($7,13,20),substr($4,2,20);}" |sort -nr|head 10';
//�R�}���h���s
   $result=shell_exec($cmd);
 //�e�[�u��-td�^�O�ŏo��
   echo "<td>$result</td>";

?>