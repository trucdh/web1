<?php
namespace Admin\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['u_id'])) {
            $this->redirect('Public/login');
        } else {
            $user = M('admin')->where("user_id=" . $_SESSION['u_id'])->find();
            $this->assign('user', $user);
            $this->title = '邮件后台首页';
            $this->display();
        }
    }
}