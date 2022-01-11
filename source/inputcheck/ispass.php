<?php
function passwordlegal($pwd){
    $pattern= '^[0-9a-zA-Z]{8, 16}$'; // 正規表現
    if(preg_match($pattern,$pwd)){
        $is_pass=true;
        return '<span color="#008000">✓</span>';
    }else{
        return '<span color="#FF0000">パスワードは8-16文字の長さの英文字及び数字の組合せ。記号使用できない。</span>';
    }
}
/**
 * ^ 匹配一行的开头位置
 *(?![0-9]+$) 预测该位置后面不全是数字
 *(?![a-zA-Z]+$) 预测该位置后面不全是字母
 *[0-9A-Za-z] {8,16} 由 8-16 位数字或这字母组成
 *$ 匹配行结尾位置
 */
?>
