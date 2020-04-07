<?php
// +----------------------------------------------------------------------
// | ThinkPHP 5.1 [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: dakun007 <dakun007@hotmail.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 产品归类
// +----------------------------------------------------------------------
namespace app\lmgadmin\controller;
use app\common\validate\Classify as validate;
use app\common\model\Classify as model;
class Classify extends Common {

    //展示
    public function index() {
        $model = new model();
        $input = $this->request->get();
        //展示路径
        if(self::yzGetShow($input)) {
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
            echo self::layuiJson($array, $count, '', $success);
            exit;
        }
        return $this->fetch();
    }

    //修改
    public function edit() {
        $msg = 'error';
        $code = 0;
        if(self::yzPostAdd()) {
            $data = $this->request->post();
            $validate = new validate();
            if(!$validate->scene('edit')->check($data)) {
                $msg = $validate->getError();
            }else {
                $str = new model();
                $model = $str->edit($data,$this->cache);
                $code = $model['code'];
                $msg = $model['msg'];
            }
        }
        echo self::dataJson($code, $msg);
    }

    //添加
    public function add() {
        $msg = 'error';
        $code = 0;
        if(self::yzPostAdd()) {
            $data = $this->request->post();
            $validate = new validate();
            if(!$validate->scene('add')->check($data)) {
                $msg = $validate->getError();
            }else {
                $str = new model();
                $model = $str->add($data,$this->cache);
                $code = $model['code'];
                $msg = $model['msg'];
            }
        }
        echo self::dataJson($code, $msg);
    }

    //删除
    public function del() {
        $msg = 'error';
        $code = 0;
        if(self::yzPostAdd()) {
            $data = $this->request->post();
            $validate = new validate();
            if(!$validate->scene('del')->check($data)) {
                $msg = $validate->getError();
            }else {
                $str = new model();
                $model = $str->del($data['classify_id'],$this->cache);
                $code = $model['code'];
                $msg = $model['msg'];
            };
        }
        echo self::dataJson($code, $msg);
    }

}

?>