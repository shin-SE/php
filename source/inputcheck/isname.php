<?php
function namelegal($user_name){
    $pattern= '/^(\w|\s|[-\^\\@\[\];:,\.\/!"#$%&\'\(\)=~\|`{}+\*<>?]){1,20}$/'; // 半角英数記号のみ（空文字OK）
    if(preg_match($pattern,$user_name) && ctype_space($user_name) == false){
        $is_name = true;
        return array($is_name);
        // return '<span color="#008000">✓</span>';
    }else{
    	$is_name = false;
        $is_name_error = "<script type='text/javascript'>alert('ニックネームの長さは最大20文字');</script>";
        return array($is_name, $is_name_error);
        // return '<span color="#FF0000">ニックネームの長さは最大20文字</span>';
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
