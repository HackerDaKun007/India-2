<?php
// +----------------------------------------------------------------------
// | ThinkPHP 5.1 [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: dakun007 <dakun007@hotmail.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 流量日期
// +----------------------------------------------------------------------
namespace app\lmgadmin\controller;
use app\common\model\Flowdate as modelFlowdate;
use app\common\validate\Page;

class Flowdate extends Common {

    //展示 日期流量
    public function index() {
        $input = $this->request->get();
        if(self::yzGetShow($input)) {
            $validate = new Page();
            $array = [];
            $count = 0;
            $success = '';
            if(!$validate->check($input)) {
                $success = $validate->getError();
            }else {
                $where = [];
                if(!empty($input['date'])) {
                    $input['date'] = strtotime($input['date']);
                    $where[] = ['date', 'eq', $input['date']];
                }
                $model = new modelFlowdate();
                $data = $model->show($input,$where);
                $array = $data['data']['data'];
                $count = $data['data']['count'];
            }
            echo self::layuiJson($array, $count, '', $success);
            exit;
        }
        //获取角色信息
        return view();
    }


    //展示 日期流量
    public function uvindex() {
        $input = $this->request->get();
        if($this->yzGetShow($input)) {
            $validate = new Page();
            $array = [];
            $count = 0;
            $success = '';
            if(!$validate->check($input)) {
                $success = $validate->getError();
            }else {
                $where = [];
                if(!empty($input['date'])) {
                    $input['date'] = strtotime($input['date']);
                    $where[] = ['date', 'eq', $input['date']];
                }
                $model = new modelFlowdate();
                $data = $model->show($input,$where);
                $array = $data['data']['data'];
                $count = $data['data']['count'];
            }
            echo self::layuiJson($array, $count, '', $success);
            exit;
        }
        //获取角色信息
        return view();
    }

    public function pv() {
        $array = [];
        $count = 0;
        $success = '';
        if(self::yzPostAdd()) {
            $input = $this->request->post();
            $validate = new Page();
            if(!$validate->check($input)) {
                $success = $validate->getError();
            }else {
                $where = [];
                if(!empty($input['flowdate_id'])) {
                    $where[] = ['flowdate_id', 'eq', $input['flowdate_id']];
                }if(!empty($input['ip'])) {
                    $input['ip'] = sprintf('%u',ip2long($input['ip']));
                    $where[] = ['ip', 'eq', $input['ip']];
                }if(!empty($input['ipadder'])) {
                    $where[] = ['ipadder', 'like', "%$input[ipadder]%"];
                }
                $model = Model('Pv');
                $data = $model->show($input,$where);
                $array = $data['data']['data'];
                $count = $data['data']['count'];
            }
        }
        echo self::layuiJson($array, $count, '', $success);

    }


    public function uv() {
        $array = [];
        $count = 0;
        $success = '';
        if(self::yzPostAdd()) {
            $input = $this->request->post();
            $validate = new Page();
            if(!$validate->check($input)) {
                $success = $validate->getError();
            }else {
                $where = [];
                if(!empty($input['flowdate_id'])) {
                    $where[] = ['flowdate_id', 'eq', $input['flowdate_id']];
                }if(!empty($input['ip'])) {
                    $input['ip'] = sprintf('%u',ip2long($input['ip']));
                    $where[] = ['ip', 'eq', $input['ip']];
                }if(!empty($input['ipadder'])) {
                    $where[] = ['ipadder', 'like', "%$input[ipadder]%"];
                }
                $model = Model('Uv');
                $data = $model->show($input,$where);
                $array = $data['data']['data'];
                $count = $data['data']['count'];
            }
        }
        echo self::layuiJson($array, $count, '', $success);

    }

}

?>