<?php
// +----------------------------------------------------------------------
// | ThinkPHP 5.1 [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: dakun007 <dakun007@hotmail.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 展示登陆记录
// +----------------------------------------------------------------------

namespace app\lmgadmin\controller;
use app\common\model\Adminrecord as modelAdminrecord;
use app\common\validate\Adminrecord as validateAdminrecord;
class Adminrecord extends Common {

    public function index() {
        $input = $this->request->get();
        if(self::yzGetShow($input)) {
            $validate = Validate('Page');
            $array = [];
            $count = 0;
            $success = '';
            if(!$validate->check($input)) {
                $success = $validate->getError();
            }else {
                $model = new modelAdminrecord();
                $data = $model->show($input);
                $array = $data['data']['data'];
                $count = $data['data']['count'];
            }
            echo self::layuiJson($array, $count, '', $success);
            exit;
        }
        return view();
    }

    //删除
    public function del() {
        $code = 0;
        $msg = 'error';
        if(self::yzPostAdd()) {
            $input = $this->request->post();
            $validate = new validateAdminrecord();
            if(!$validate->scene('del')->check($input)) {
                $msg = $validate->getError();
            }else {
                $model = new modelAdminrecord();
                $data = $model->del($input['adminrecord_id']);
                $code = $data['code'];
                $msg = $data['msg'];
            }
        }
        echo self::dataJson($code, $msg);
    }

}
?>