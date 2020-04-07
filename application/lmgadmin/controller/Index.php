<?php
namespace app\lmgadmin\controller;
use app\common\validate\Personal;
class Index extends Common
{
    public function index()
    {
        return view('', [
            'column' => $this->Authority,
            'AdminArray' =>  $this->AdminArray,
        ]);
    }

    public function home() {
        echo 1;
    }

    public function Logout() {
        $msg = '注销失败';
        $code = 0;
        $url = '';
        if($this->yzPostAdd()) {
            $this->cookie::set($this->path['cokieUser'], null);
            $this->cookie::set($this->path['cokieId'], null);
            $this->cookie::set($this->path['cokieIp'], null);
            $this->cookie::set($this->path['cokieBr'], null);
            $this->cookie::set($this->path['cokieOs'], null);
            $this->cookie::set($this->path['cokieTime'], null);
            $msg = '注销成功';
            $code = 1;
            $url = url('Login/index');
        }
        echo self::dataJson($code, $msg, '', $url);
    }

    //修改个人资料
    public function personal() {
        $msg = 'error';
        $code = 0;
        if(self::yzPostAdd()) {
            $data = $this->request->post();
            $data['admin_id'] = $this->AdminId;
            $validate = new Personal();
            if(!$validate->scene('personal')->check($data)) {
                $msg = $validate->getError();
            }else {
                $admin = new \app\common\model\Admin($this->path,$this->cache);
                $model = $admin->personal($data, $this->AdminId);
                $code = $model['code'];
                $msg = $model['msg'];
            };
        }
        echo self::dataJson($code, $msg);
    }

    //修改个人登陆密码
    public function pass() {
        $msg = 'error';
        $code = 0;
        if(self::yzPostAdd()) {
            $data = $this->request->post();
            $validate = new Personal();
            $data['admin_id'] = $this->AdminId;
            if(!$validate->scene('pass')->check($data)) {
                $msg = $validate->getError();
            }else {
                $admin = new \app\common\model\Admin($this->path,$this->cache);
                $model = $admin->personalPass($data, $this->AdminId);
                $code = $model['code'];
                $msg = $model['msg'];
            };
        }
        echo self::dataJson($code, $msg);
    }
}
