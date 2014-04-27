<?php
namespace Admin\Controller;

use Think\Controller;

class EmailController extends Controller
{
    /*邮件列表*/
    public function index()
    {
        if (!isset($_SESSION['u_id'])) {
            $this->redirect('Public/login');
        } else {
            $User = M('sendemail'); // 实例化User对象
            $where = null;
            if (isset($_GET['status'])) {
                $where = "status=" . $_GET['status'];
            }
            $count = $User->where($where)->count(); // 查询满足要求的总记录数
            $Page = new \Think\Page($count, 20); // 实例化分页类 传入总记录数和每页显示的记录数
            $Page->lastSuffix = false; //不显示最后一条
            $Page->setConfig('prev', '上一页');
            $Page->setConfig('next', '下一页');
            $Page->setConfig('first', '<<');
            $Page->setConfig('last', '>>');
            $Page->setConfig('theme', '<li><a class="javascript:void(0)">%HEADER%</a></li><li>%FIRST%</li><li>%UP_PAGE%</li><li> %LINK_PAGE% </li><li>%DOWN_PAGE%</li><li class="page_last">%END%</li>');
            $list = $User->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
            $show = $Page->show(); // 分页显示输出
            if ($Page->totalRows <= 20) {
                $show = null;
            }
            $this->assign('list', $list); // 赋值分页输出
            $this->assign('page', $show); // 赋值分页输出
            $this->assign('title', "邮件列表"); // 赋值分页输出
            $this->display(); // 输出模板
            //$emailList = D('Sendemail')->getField('id,status,title,email');
        }
    }

    /*一条邮件记录*/
    public function emailOne()
    {
        $id = $_POST['id'];
        $User = M('sendemail'); // 实例化User对象
        $one = $User->where("id=" . $id)->find();
        if ($one) {
            echo json_encode($one);
            exit;
        }
    }

    /*添加邮件*/
    public function addEmail()
    {
        if (!empty($_POST)) {
            $User = M('sendemail');
            if (empty($_POST['title']) or empty($_POST['content'])) {
                $this->error("表单不能为空请重新填写");
            }
            $array['title'] = $_POST['title'];
            $array['content'] = $_POST['content'];
            if ($_POST['timing']) {
                $array['timing'] = strtotime($_POST['timing']);
            }
            if (!empty($_FILES['batch']['tmp_name'])) {
                set_time_limit(0);
                $tempFile = $_FILES['batch']['tmp_name'];
                $fileTypes = array('xls', 'xlsx'); // 文件扩展
                $fileParts = pathinfo($_FILES['batch']['name']);
                if (!in_array($fileParts['extension'], $fileTypes)) {
                    $this->error("请导入2003或2007格式excel");
                }
                import("Org.Util.PHPExcel");
                if ($fileParts['extension'] == "xlsx") {
                    import("Org.Util.PHPExcel.Reader.Excel2007");
                    $objReader = new \PHPExcel_Reader_Excel2007();
                } else {
                    import("Org.Util.PHPExcel.Reader.Excel5");
                    $objReader = new \PHPExcel_Reader_Excel5();
                }
                $objPHPExcel = $objReader->load($tempFile); //$filename可以是上传的文件，或者是指定的文件
                $sheet = $objPHPExcel->getSheet(0);
                $highestRow = $sheet->getHighestRow(); // 取得总行数
                //$highestColumn = $sheet->getHighestColumn(); // 取得总列数
                for ($i = 1; $i <= $highestRow; $i++) {
                    $array['email'] = $objPHPExcel->getActiveSheet()->getCell("A" . $i)->getValue(); //获取A列的值
                    if (checkEmail($array['email'])) {
                        $array['add_time'] = time();
                        $array['add_ip'] =  get_client_ip();
                        $User->add($array);
                    }
                }
                $this->success('添加成功！', U('Email/index'));
            } else {
                if (empty($_POST['email'])) {
                    $this->error("邮箱为空");
                }
                $email = $_POST['email'];
                $emailArr = explode(',', $email);
                if (count($emailArr) > 1) {
                    foreach ($emailArr as $v) {
                        $array['email'] = $v;
                        if (checkEmail($array['email'])) {
                            $array['add_time'] = time();
                            $array['add_ip'] =  get_client_ip();
                            $User->add($array);;
                        }
                    }
                } else if (count($emailArr) == 1) {
                    $array['email'] = $_POST['email'];
                    if (!checkEmail($array['email'])) {
                        $this->error("邮箱格式错误");
                    }
                    $array['add_time'] = time();
                    $array['add_ip'] =  get_client_ip();
                    $User->add($array);
                }
                $this->success('添加成功！', U('Email/index'));
            }
        } else {
            $list = M('email_template')->getField('id,title,content');
            $this->assign('list', $list);
            $this->assign('title', "添加邮件");
            $this->display();
        }
    }

    /*邮件模板列表*/
    public function emailTemplate()
    {
        if (!isset($_SESSION['u_id'])) {
            $this->redirect('Public/login');
        } else {
            $list = D('email_template')->order('id desc')->getField('id,title,content');
            $this->assign('list', $list);
            $this->assign('title', "邮件模板列表");
            $this->display(); // 输出模板
        }
    }

    /*一条邮件模板记录*/
    public function templateOne()
    {
        $id = $_POST['id'];
        $User = M('email_template'); // 实例化User对象
        $one = $User->where("id=" . $id)->find();
        if ($one) {
            echo json_encode($one);
            exit;
        }
    }

    /*添加邮件模板*/
    public function addTemplate()
    {
        if (!empty($_POST)) {
            $User = M('email_template');
            if (empty($_POST['title']) or empty($_POST['content'])) {
                $this->error("表单不能为空请重新填写");
            }
            $array['title'] = $_POST['title'];
            $array['content'] = $_POST['content'];
            $status = $User->add($array);
            if ($status) {
                $this->success('添加成功！', U('Email/emailTemplate'));
            } else {
                $this->error("添加失败");
            }
        } else {
            $this->assign('title', "添加邮件模板");
            $this->display();
        }
    }

    /*邮件模板编辑*/
    public function templateEdit()
    {
        if (!empty($_POST)) {
            $id = $_GET['id'];
            $data['title'] = $_POST['title'];
            $data['content'] = $_POST['content'];
            $User = M('email_template');
            $status = $User->where("id=" . $id)->save($data);
            if ($status) {
                $this->success('更新成功！', U('Email/emailTemplate'));
            } else {
                $this->error("更新失败");
            }
        } else {
            $id = $_GET['id'];
            $User = M('email_template'); // 实例化User对象
            $one = $User->where("id=" . $id)->find();
            if ($one) {
                $this->assign('title', "邮件模板编辑");
                $this->assign('read', $one);
                $this->display(); // 输出模板
            }
        }
    }

    /*删除邮件模板*/
    public function templateDel()
    {
        $id = $_GET['id'];
        $User = M('email_template');
        $status = $User->where("id=" . $id)->delete();
        if ($status) {
            $this->success('删除成功！', U('Email/emailTemplate'));
        } else {
            $this->error("删除失败");
        }
    }
}