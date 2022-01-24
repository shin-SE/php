<?php
function comp_pass($pwd1, $pwd2)
{

    if ($pwd1 != $pwd2) {
        $is_comp = false;
        $is_comp_error = "<script type='text/javascript'>alert('パスワード一致しない、もう一度確認お願いします。');</script>";
        return array($is_comp, $is_comp_error);
    } else {
        $is_comp = true;
        return array($is_comp);
        //return '&nbsp;';
    }
}
