<?php
// +----------------------------------------------------------------------
// | ThinkPHP 5.1 [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: dakun007 <dakun007@hotmail.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 网站设置
// +----------------------------------------------------------------------
namespace app\lmgadmin\controller;
use app\common\model\Web as modelWeb;
class Web extends Common {

    //展示
    public function index() {
        $model = new modelWeb(); //readCache
        $input = $this->request->param();;
        //上传图片
        if(self::yzGetShow($input, 201, 'post')) {
            $Images = new \app\commonConfig\Img();
            $img = $Images->leafletImg($size=102400, $ext='jpg,png,gif,jpeg', $upload=$this->path['runtime']);
            echo self::dataJson($img['code'], $img['msg'],$img['data']);
            exit;
        }
        return $this->fetch('',[
            'data' => $model->readCache($this->cache),
        ]);
    }

    //修改
    public function edit() {
        $code = 0;
        $msg = 'error';
        if(self::yzPostAdd()) {
            $validate = new \app\common\validate\Web();
            $input = $this->request->post();
            if(!$validate->check($input)) {
                $msg = $validate->getError();
            }else {
                $model = new modelWeb();
                $data = $model->edit($input, $this->cache);
                $msg = $data['msg'];
                $code = $data['code'];
            }
        }
        echo self::dataJson($code,$msg);
    }

}

?>