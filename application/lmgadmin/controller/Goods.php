<?php
// +----------------------------------------------------------------------
// | ThinkPHP 5.1 [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: dakun007 <dakun007@hotmail.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 产品
// +----------------------------------------------------------------------
namespace app\lmgadmin\controller;
use app\commonConfig\Img;
use app\common\model\Goods as model;
use app\common\validate\Goods as validate;
class Goods extends COmmon {

    //展示
    public function index() {
        $model = new model();
        $input = $this->request->param();
        //上传图片
        if(self::yzGetShow($input, 201, 'post')) {
            $Images = new Img();
            $img = $Images->leafletImg($size=102400, $ext='jpg,png,gif,jpeg', $upload=$this->path['runtime']);
            echo self::dataJson($img['code'], $img['msg'],$img['data']);
            exit;
        }
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
                }if(!empty($input['tei'])) {
                    $where[] = ['tei', 'eq', $input['tei']];
                }
                $data = $model->show($input,$where);
                $array = $data['data']['data'];
                $count = $data['data']['count'];
            }
            echo self::layuiJson($array, $count, '', $success);
            exit;
        }
        return $this->fetch('',[
            'classify' => Model('Classify')->readCache($this->cache),
        ]);
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
                $model = $str->add($data);
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
            $validate = new validate();
            if(!empty($data['home_img'])) {
                $yz = $validate->scene('edit')->check($data);
            }else {
                $yz = $validate->scene('editImg')->check($data);
                unset($data['home_img']);
            }
            if(!$yz) {
                $msg = $validate->getError();
            }else {
                $str = new model();
                $model = $str->edit($data);
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
            $data = $this->request->post();
            $validate = new validate();
            if(!$validate->scene('del')->check($data)) {
                $msg = $validate->getError();
            }else {
                $str = new model();
                $model = $str->del($data['goods_id']);
                $code = $model['code'];
                $msg = $model['msg'];
            };
        }
        echo self::dataJson($code, $msg);
    }

}

?>