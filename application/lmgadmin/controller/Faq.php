<?php
// +----------------------------------------------------------------------
// | ThinkPHP 5.1 [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liuzhenjia <605130343@qq.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 常问问题
// +----------------------------------------------------------------------
namespace app\lmgadmin\controller;
use app\common\model\Faq as model;

class Faq extends Common {
    //展示
    public function index() {
        $model = new model();
        return $this->fetch('', [
            'data'=>$model->readCache($this->cache),
        ]);
    }
    //修改
    public function edit() {
        $code = 0;
        $msg = 'error';
        if(self::yzPostAdd()) {
            $input = $this->request->post();
            if(!empty($input['content'])) {
                $input['content'] = $_POST['content'];
            }
            $validate = new \app\common\validate\Faq();
            if(!$validate->check($input)) {
                $msg = $validate->getError();
            }else {
                $model = new model();
                $data = $model->edit($input, $this->cache);
                $msg = $data['msg'];
                $code = $data['code'];
            }
        }
        echo self::dataJson($code, $msg);
    }
}