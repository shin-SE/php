<?php
function passwordlegal($pwd){
    $pattern= '/\A(?=.*?[a-z])(?=.*?[A-Z])(?=.*?\d)[a-zA-Z\d]{8,16}+\z/'; // 正規表現
    if(preg_match($pattern,$pwd)){
        $is_pass = true;
        return array($is_pass);
        //return '<span color="#008000">✓</span>';
    }else{
        $is_pass = false;
        $is_pass_error= "<script type='text/javascript'>alert('パスワードは8-16文字の長さの英文字及び数字の組合せ。記号使用できない。');</script>";
        return array($is_pass, $is_pass_error);
    }
}
/**
 * ^ 匹配一行的开头位置
 *(?![0-9]+$) 预测该位置后面不全是数字
 *(?![a-zA-Z]+$) 预测该位置后面不全是字母
 *[0-9A-Za-z] {8,16} 由 8-16 位数字或这字母组成
 *$ 匹配行结尾位置
 */
