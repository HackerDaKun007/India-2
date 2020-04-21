<?php
// +----------------------------------------------------------------------
// | ThinkPHP 5.1 [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liuzhenjia <605130343@qq.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 单品页面
// +----------------------------------------------------------------------
namespace app\home\controller;
use app\common\validate\Ht as validate; //ht验证器 - 过滤get传参id、q
use app\home\model\Ht as model;

class Ht extends Common {

    public function index() {
        $msg = 'error';
        //echo dirname(getcwd());
        $url = '../thinkphp/tpl/404.html';
        $arr = [];
        if ($get = $this->request->get()) {
            $validate = new validate();
            if ($validate->check($get)) {
                $model = new model();
                $res = $model->show($get['id']);
                if ($res) {
                    $arr = [
                        'sort' => $res['sort'],
                        'title' => $res['username'],
                    ];
                }
            }
        }
        if (!empty($arr)) {
            $url = "ht/$arr[sort]/$arr[title]";
        }
        return $this->fetch($url);
    }


}

?>