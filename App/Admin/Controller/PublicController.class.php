<?php
namespace Admin\Controller;

use Think\Controller;

class PublicController extends \Think\Controller
{
    public function login($username = null, $password = null, $verify = null)
    {
        if (isset($_SESSION['u_id'])) {
            $this->redirect('Index/index');
        } else {
            if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['code'])) {
                /* 检测验证码 TODO: */
                if (!check_verify($_POST['code'])) {
                    $this->error('验证码输入错误！');
                }
                $User = M("Admin"); // 实例化User对象
                $username = $_POST['username'];
                $password = md5($_POST['password']);
                $data = $User->where("username='" . $username . "'")->find();
                if (empty($data)) {
                    $this->error("不存在用户");
                } else {
                    if ($data['password'] == $password) {
                        $_SESSION['u_id'] = $data['user_id'];
                        $update['lastTime'] = time();
                        $update['lastIp'] = get_client_ip();
                        $s = $User->where("user_id=" . $data['user_id'])->save($update);
                        $this->success('登录成功！', U('Index/index'));
                    } else {
                        $this->error("密码错误");
                    }
                }
            } else {
                $this->display();
            }
        }
    }

    /* 退出登录 */
    public function logout()
    {
        if (isset($_SESSION['u_id'])) {
            unset($_SESSION['u_id']);
        }
        $this->success('退出成功！', U('Public/login'));
    }

    /*验证码*/
    public function verify()
    {
        $config = array(
            'fontSize' => 16, // 验证码字体大小
            'imageW' => 112,//,验证码宽度
            'imageH' => 34, // 验证码高度
            'length' => 4, // 验证码位数
            'codeSet' => '0123456789', //设置验证码字符为纯数字
            'fontttf' => '5.ttf', //指定验证码字体 默认为随机获取
            'useCurve' => false, // 是否使用混淆曲线 默认为true
            //'useImgBg' => true, // 是否使用背景图片 默认为false
            'bg' =>  array(243, 251, 254), // 是否使用背景图片 默认为false
            'useNoise' => false, // 关闭验证码杂点
        );
        $verify = new \Think\Verify($config);
        $verify->entry(1);
    }
}
