<?php
// +----------------------------------------------------------------------
// | ThinkPHP 5.1 [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: dakun007 <dakun007@hotmail.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 权限表列表控制器controller
// +----------------------------------------------------------------------

namespace app\lmgadmin\controller;
use app\common\validate\Power as validatePower;
class Power extends Common {

    /**
     * 展示权限列表
     */
    public function index() {
        return view('', [
            'controller' => $this->controller(false),
            'PowerW1' => json_encode($this->Power->yzCache('modelPowerW1')),
            'PowerW2' => json_encode($this->Power->yzCache('modelPowerW2')),
            'PowerW3' => json_encode($this->Power->yzCache('modelPowerW3')),
            'cacheShow' => $this->Authority,
        ]);
    }

    /**
     * 添加权限列表
     */
    public function add() {
        $msg = 'error';
        $code = 0;
        if(self::yzPostAdd()) {
            $data = $this->request->post();
            $validate = new validatePower();
            if(!$validate->scene('add')->check($data)) {
                $msg = $validate->getError();
            }else {
                $model = $this->Power->add($data);
                $code = $model['code'];
                $msg = $model['msg'];
            };
        }
        echo $this->dataJson($code, $msg);
    }

    /**
     * 修改权限列表
     */
    public function edit() {
        $msg = 'error';
        $code = 0;
        if(self::yzPostAdd()) {
            $data = $this->request->post();
            $validate = new validatePower();
            if(!$validate->scene('edit')->check($data)) {
                $msg = $validate->getError();
            }else {
                $model = $this->Power->edit($data);
                $code = $model['code'];
                $msg = $model['msg'];
            };
        }
        echo self::dataJson($code, $msg);
    }

    /**
     * 删除权限
     */
    public function del() {
        $msg = 'error';
        $code = 0;
        if(self::yzPostAdd()) {
            $data = $this->request->post();
            $validate = new validatePower();
            if(!$validate->scene('del')->check($data)) {
                $msg = $validate->getError();
            }else {
                $model = $this->Power->del($data['power_id']);
                $code = $model['code'];
                $msg = $model['msg'];
            };
        }
        echo self::dataJson($code, $msg);
    }

    /**
     * 更新缓存
     */
    public function renew() {
        $msg = 'error';
        $code = 0;
        if(self::yzPostAdd()) {
            $this->Power->cache(false);
            $this->controller(true);
            $msg = '更新成功，请刷新页面';
            $code = 1;
        }
        echo self::dataJson($code, $msg);
    }


    /**
     * 获取方法名称
     */
    protected  function controller($str=false) {

        $controller = $this->cache::get($this->path['contr']);
        if($controller == '' || $str == true) {
            $dir =  dirname(__FILE__); //获取当前文件目录
            $file = scandir($dir); //扫描当前目录所有的文件名称
            $data = [];
            $remove = ['initialize', 'controller', 'yzPostAdd', 'yzGetShow', 'yzCookie'];
            foreach ($file as $k => $v) {
                if ($v != '.' && $v != '..' && $v != 'Common.php' && $v != '.DS_Store' && $v != 'Login.php') {
                    $arr = str_replace('/','','\app\/'.request()->module().'\controller\/'.substr($v,0,-4));
                    $action  = get_class_methods($arr);     //读取文件所有方法名称
                    if(!empty($action)){
                        $array = [];
                        foreach ($action as $ka => $va) {
                            if($va == '__construct'){
                                break;
                            }else if(!in_array($va, $remove)){
                                $array[] = $va;
                            }
                        }
                        $data[] = [
                            'controller' =>   substr($v,0,-4),  //获取文件名称
                            'action' => $array
                        ];
                    }
                }
            }
            $data = json_encode($data);
            $this->cache::set($this->path['contr'], $data);
        }else {
            $data = $controller;
        }
        return $data;
    }

}
?>