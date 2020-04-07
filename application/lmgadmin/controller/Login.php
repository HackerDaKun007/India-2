<?php
// +----------------------------------------------------------------------
// | ThinkPHP 5.1 [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: dakun007 <dakun007@hotmail.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 登陆页面操作控制器 Login
// +----------------------------------------------------------------------
 namespace app\lmgadmin\controller;
 use think\Controller;
 use think\captcha\Captcha;
 use app\commonConfig\App;
 use think\Config;
 use think\Request;
 use think\facade\Cookie;
 use app\common\validate\Login as validateLgin;
 use app\common\model\Admin;

 class Login extends Controller {
    use App;

    protected $request;
    protected $path;
    protected $cache;
    protected $cookie;

    public function __construct(Config $config,Request $request,Cookie $cookie)
    {
        parent::__construct();
        $this->request = $request;
        $this->path = $config->get('path.');
        $this->cookie = $cookie;
    }

     /**
     * 登陆首页 Config $config
     */
    public function index()
    {

        if($this->cookie::get($this->path['cokieUser']) && $this->cookie::get($this->path['cokieId'])) {
            header('Location:/lmgadmin/index/index.html#/Index/home.html');
            exit;
        }
        return view();
    }

     /**
      * 提交登陆验证
      */
     public function yzAdd()
     {

         $code = 0;
         $msg = 'error';
         if($this->request->isPost() && $this->request->isAjax()) {

             $validate = new validateLgin();
             $input = $this->request->post();
            if(!$validate->check($input)) {
                $msg = $validate->getError();
            }else {
                $model = new Admin();
                $data = $model->login($input);
                $code = $data['code'];
                $msg = $data['msg'];
            }
         }
         echo $this->dataJson($code,$msg);
     }


    /**
     * 生成验证码
     */
    public function yzm()
    {
        $config =    [
            // 验证码字体大小
            'fontSize'    =>    30,
            // 验证码位数
            'length'      =>    4,
            'fontttf'     =>   '5.ttf',
            // 关闭验证码杂点
            //'useNoise'    =>    false,
            //'codeSet'     =>    '0123456789'
        ];
        $captcha = new Captcha($config);
        return $captcha->entry();
    }

 }

?>