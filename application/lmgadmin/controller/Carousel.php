<?php
// +----------------------------------------------------------------------
// | ThinkPHP 5.1 [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: dakun007 <dakun007@hotmail.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 产品轮播图
// +----------------------------------------------------------------------
namespace app\lmgadmin\controller;
use app\commonConfig\Img;
use app\common\model\Carousel as model;
use app\common\validate\Carousel as validate;
class Carousel extends Common {

    //展示
    public function index() {
        $model = Model(self::$UserNmae);
        $input = $this->request->param();
        //上传图片
        if($this->yzGetShow($input, 201, 'post')) {
            $img = new Img();
            $images = $img->leafletImg(204800, 'jpg,png,gif,jpeg', $this->path['runtime']);
            echo self::dataJson($images['code'], $images['msg'],$images['data']);
            exit;
        }
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
        return view();
    }

    //添加
    public function add() {
        $msg = 'error';
        $code = 0;
        $data = input('post.');
        if(self::yzPostAdd()) {
            $validate = new validate();
            if(!$validate->scene('add')->check($data)) {
                $msg = $validate->getError();
            }else {
                $model = new model();
                $data = $model->add($data);
                $code = $data['code'];
                $msg = $data['msg'];
            };
        }
        echo self::dataJson($code, $msg);
    }

    //修改
    public function edit() {
        $msg = 'error';
        $code = 0;
        $data = input('post.');
        if(self::yzPostAdd()) {
            $validate = new validate();
            if(!empty($data['img'])) {
                $yz = $validate->scene('edit')->check($data);
            }else {
                $yz = $validate->scene('editImg')->check($data);
                unset($data['img']);
            }
            if(!$yz) {
                $msg = $validate->getError();
            }else {
                $model = new model();
                $data = $model->edit($data);
                $code = $data['code'];
                $msg = $data['msg'];
            };
        }
        echo self::dataJson($code, $msg);
    }

    //删除
    public function del() {
        $msg = 'error';
        $code = 0;
        $data = input('post.');
        if(self::yzPostAdd()) {
            $validate = new validate();
            if(!$validate->scene('del')->check($data)) {
                $msg = $validate->getError();
            }else {
                $model = new model();
                $data = $model->del($data['carousel_id']);
                $code = $data['code'];
                $msg = $data['msg'];
            };
        }
        echo self::dataJson($code, $msg);
    }



}

?>