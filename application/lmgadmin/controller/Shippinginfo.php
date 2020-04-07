<?php
// +----------------------------------------------------------------------
// | ThinkPHP 5.1 [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liuzhenjia <605130343@qq.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 货运信息
// +----------------------------------------------------------------------
namespace app\lmgadmin\controller;
use app\common\model\Shippinginfo as model;

class Shippinginfo extends Common {
    //展示
    public function index() {
        $model = new model();
        return $this->fetch('', [
            'data' => $model->readCache($this->cache),
        ]);
    }
    //修改
    public function edit() {
        $code = 0;
        $msg = "erro";
        if(self::yzPostAdd()) {
            $input = $this->request->post();
            if(!empty($input['content'])) {
                $input['content'] = $_POST['content'];
            }
            $validate = new \app\common\validate\Shippinginfo();
            if(!$validate->check($input)) {
                $msg = $validate->getError();
            } else {
                $model = new model();
                $data = $model->edit($input, $this->cache);
                $msg = $data['msg'];
                $code = $data['code'];
            }
        }
        //echo $this->dataJson();
        echo self::dataJson($code, $msg);
    }
}
