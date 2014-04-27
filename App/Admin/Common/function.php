<?php
/**
 * 后台公共文件
 * 主要定义后台公共函数库
 */

/**
 * 检测验证码
 * @param $code
 * @param int $id
 * @return bool
 */
function check_verify($code, $id = 1)
{
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}

/**
 * 邮箱验证
 * @param $email
 * @return int
 */
function checkEmail($email)
{
    $pregEmail = "/\\w+([-+.]\\w+)*@\\w+([-.]\\w+)*\\.\\w+([-.]\\w+)*/";
    return preg_match($pregEmail, $email);
}
