<?php
// +----------------------------------------------------------------------
// | ThinkPHP 5.1 [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liuzhenjia <605130343@qq.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 页面分类
// +----------------------------------------------------------------------
namespace app\lmgadmin\controller;
use app\common\validate\Sectionsort as validate;
use app\common\model\Sectionsort as model;

class Sectionsort extends Common {

    private $folderUrl = '../application/home/view/ht/';

    //页面分类列表
    public function index($dir = '') {
        $model = new model();
        $input = $this->request->get();
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

    //添加
    public function add() {
        $code = 0;
        $msg = 'error';
        if(self::yzPostAdd()) {
            $data = $this->request->post();
            $validate = new validate();
            if(!$validate->scene('add')->check($data)) {
                $msg = $validate->getError();
            } else {
                $model = new model();
                $modelRes = $model->add($data, $this->cache);
                $foleRes = $model->folderAdd($this->folderUrl . $data['username']);
                if (!$foleRes) {
                    $msg = '分类目录已存在';
                } else {
                    $code = $modelRes['code'];
                    $msg = $modelRes['msg'];
                }
            }
        }
        echo self::dataJson($code, $msg);
    }

    //修改
    public function edit() {
        $code = 0;
        $msg = 'error';
        if(self::yzPostAdd()) {
            $data = $this->request->post();
            $validate = new validate();
            if(!$validate->scene('edit')->check($data)) {
               $msg = $validate->getError();
            } else {
                $model = new model();
                $res = $model->edit($data, $this->cache);
                $model->folderEdit($this->folderUrl . $data['oldname'], $this->folderUrl . $data['username']);
                $code = $res['code'];
                $msg = $res['msg'];
            }
        }
        echo self::dataJson($code, $msg);
    }

    //删除
    public function del() {
        $code = 0;
        $msg = 'error';
        if(self::yzPostAdd()) {
            $data = $this->request->post();
            $validate = new validate();
            if(!$validate->scene('del')->check($data)) {
                $msg = $validate->getError();
            } else {
                $model = new model();
                $res = $model->del($data['sectionsort_id'], $this->cache);
                $model->folderDel($this->folderUrl . $data['username']);
                $code = $res['code'];
                $msg = $res['msg'];
            }
        }
        echo self::dataJson($code, $msg);
    }
}