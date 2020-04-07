<?php
// +----------------------------------------------------------------------
// | ThinkPHP 5.1 [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: dakun007 <dakun007@hotmail.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 角色控制器操作
// +----------------------------------------------------------------------
namespace app\lmgadmin\controller;
use think\Model;
use app\common\validate\Role as validateRole;
class Role extends Common {

    //展示
    public function index() {

        $model = $this->Role;
        $input = $this->request->get();
        if($this->yzGetShow($input)) {

            $validate = Validate('Page');
            $array = [];
            $count = 0;
            $success = '';
            if(!$validate->check($input)) {
                $success = $validate->getError();
            }else {
                $where = [];
                if(!empty($input['username'])) {
                    $where[] = ['username', 'like', "%$input[username]%"];
                }
                $data = $model->show($input,$where);
                $array = $data['data']['data'];
                $count = $data['data']['count'];
            }
            echo $this->layuiJson($array, $count, '', $success);
            exit;
        }
//        print_r(self::$PowerShow);
//        exit;
        return view('', [
            'PowerShow' => json_encode($this->Authority),
        ]);
    }

    //添加
    public function add() {
        $msg = 'error';
        $code = 0;
        if(self::yzPostAdd()) {
            $data = $this->request->post();
            $validate = new validateRole();
            if(!$validate->scene('add')->check($data)) {
                $msg = $validate->getError();
            }else {
                $model = $this->Role->add($data, false);
                $code = $model['code'];
                $msg = $model['msg'];
            };
        }
        echo self::dataJson($code, $msg);
    }

    //修改
    public function edit() {
        $msg = 'error';
        $code = 0;
        if(self::yzPostAdd()) {
            $data = $this->request->post();
            $validate = new validateRole();
            if(!$validate->scene('edit')->check($data)) {
                $msg = $validate->getError();
            }else {
                $model = $this->Role->add($data, true);
                $code = $model['code'];
                $msg = $model['msg'];
            };
        }
        echo self::dataJson($code, $msg);
    }

    //删除
    public function del() {
        $msg = 'error';
        $code = 0;
        if(self::yzPostAdd()) {
            $data = input('post.');
            $validate = new validateRole();
            if(!$validate->scene('del')->check($data)) {
                $msg = $validate->getError();
            }else {
                $model = $this->Role->del($data['role_id']);
                $code = $model['code'];
                $msg = $model['msg'];
            };
        }
        echo self::dataJson($code, $msg);
    }

}
?>