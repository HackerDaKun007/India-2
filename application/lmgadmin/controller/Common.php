<?php
// +----------------------------------------------------------------------
// | ThinkPHP 5.1 [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: dakun007 <dakun007@hotmail.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | admin后台公共操作控制器
// +----------------------------------------------------------------------

namespace app\lmgadmin\controller;
use think\Controller;
use app\commonConfig\App;
use think\Request;
use think\Config;
use think\facade\Cookie;
use think\facade\Cache;
class Common extends Controller {
    use App;
    protected  $cache;
    protected  $request; //定义系统内置方法为静态变量
    protected  $path;
    protected  $gethttp;
    protected $cookie;

    protected  $Authority = '';//权限列表目录1维数组
    protected  $PowerShow = ''; //权限列表目录区分等级展示

    protected  $AdminId = ''; //用户ID
    protected  $AdminArray = '';//用户资料

    //默认的model配置
    protected $Role;
    protected $Power;
    /**
     * common constructor. 构造方法
     */
    public function __construct(Request $request,Config $config,Cookie $cookie,Cache $cache) {
        parent::__construct();

        $this->request = $request;
        $this->cache = $cache;
        $this->path = $config->get('path.');
        $this->cookie = $cookie;
        // print_r(self::$reques); param全部，get,post
        // exit;
        $controller = $this->request->controller() .'/'. $this->request->action(); //获取控制名称, 方法名称

        //访问admin模块,全部必须要ajax访问，除了index/index
        $this->gethttp = $this->request->server();
        if( $controller != 'Index/index' && !$this->request->isPost() && !$this->request->isAjax() && empty($this->gethttp['HTTP_ADDDATE'])) {
            echo $this->dataJson(0, '访问的连接不存在', [],'');
            exit;
        }


//        Model('Flowdate')->add('/lmgadmin//index/index.html');

        //判断cookie信息,以及是否登陆
        $this->yzCookie();
        /**
         * 获取权限目录 ,判断权限
         */

        $this->Role = new \app\common\model\Role();
        $RoleSelect = $this->Role->modelRoleSelect($this->AdminArray['role_id']);

        if($RoleSelect['admin'] != 1){ //不是超级管理员则需要验证权限路径
            $arrayHead = ['Index/index', 'Index/logout', 'Index/personal', 'Index/pass'];
            if(!in_array($controller,$arrayHead)) {
                //判断权限
                if(!in_array($controller, $RoleSelect)) {
                    echo $this->dataJson(404, '当前权限不足, 无法进行操作！', '','');
                    exit;
                }
            }
            if($this->Authority === '') {
                $this->Authority = $this->cache::get($this->path['modelRoleShow'] .'_'. $this->AdminArray['role_id']);//返回目录
            }
        }else { //超级管理员不需要验证
            if($this->Authority === '') {
                $this->Power = new \app\common\model\Power();
                $this->Authority = $this->Power->yzCache('modelPowerShow'); //返回目录
            }
        }

        //基本信息
        self::assign([
            'personal' => json_encode([
             'mail' => $this->AdminArray['mail'],
             'name' => $this->AdminArray['name'],
             'tei' => $this->AdminArray['tei'],
             'sex' => $this->AdminArray['sex'],
            ]),
        ]);

    }

    /**
     * 验证提交展示数据
     * @return bool
     */
    protected  function yzPostAdd() {
        if($this->request->isPost() && !empty($this->gethttp['HTTP_ADDDATE']) && $this->gethttp['HTTP_ADDDATE'] == 2) {
            return true;
        }else {
            return false;
        }
    }

    /**
     * @param array $input 传入数组
     * @param int $num  200添加修改数据\201上传图片
     * @return bool
     */
    protected  function yzGetShow($input, $num=200, $get='get') {
        if($get == 'get') {
            if($this->request->isAjax() && $this->request->isGet() && !empty($input['request']) && $input['request'] == $num) {
                return true;
            }else {
                return false;
            }
        }else if($get == 'post') {
            if($this->request->isAjax() && $this->request->isPost() && !empty($input['request']) && $input['request'] == $num) {
                return true;
            }else {
                return false;
            }
        }

    }


    /**
     * 验证cookie是否正常，以及是否登陆
     */
    protected  function yzCookie() {
        $browser = new \app\commonConfig\Browser(); //游览器等信息
        $ip = new \app\commonConfig\Ip(); //游览器等信息
        $passowrd = new \app\commonConfig\Password(); //游览器等信息
        $br = strtolower($_SERVER['HTTP_USER_AGENT']);
        $cokieUser = $this->cookie::get($this->path['cokieUser']);
        $cokieId = $this->cookie::get($this->path['cokieId']);
        $cokieIp = $this->cookie::get($this->path['cokieIp']);
        $cokieBr = $this->cookie::get($this->path['cokieBr']);
        $cokieOs =$this->cookie::get($this->path['cokieOs']);
        $cokieTime = $this->cookie::get($this->path['cokieTime']);
        $boolCoolie = false;
        if(!empty($cokieUser) && !empty($cokieId) && !empty($cokieIp) && !empty($cokieBr) && !empty($cokieOs) && !empty($cokieTime)) {
            //解密
//            $cokieUser = repassJie(cookie(self::$path['cokieUser']));
            $cokieId = $passowrd->repassJie($cokieId);
            $cokieIp = $passowrd->repassJie($cokieIp);
            $cokieBr = $passowrd->repassJie($cokieBr);
            $cokieOs = $passowrd->repassJie($cokieOs);
            $cokieTime = $passowrd->repassJie($cokieTime);
            //判断数据是否正常
            $time = time();
            if(is_numeric($cokieId) && is_numeric($cokieTime) && is_numeric($cokieIp) && $cokieBr == $browser->GetBrowser(true,$br) && $cokieOs == $browser->GetOs(true,$br) && $cokieTime > $time) {
                //判断IP
                $ip = sprintf('%u',ip2long($ip->getIp()));
                $this->AdminArray = cache($this->path['adminInfo_'] . $cokieId); //获取用户信息
                if($cokieIp == $ip && !empty($this->AdminArray) && $this->AdminArray['disable'] == 1) {
                    $this->AdminId = $cokieId;
                    $boolCoolie = true;
                }
            }
        }

        if($boolCoolie == false) {
            $this->cookie::set($this->path['cokieUser'], null);
            $this->cookie::set($this->path['cokieId'], null);
            $this->cookie::set($this->path['cokieIp'], null);
            $this->cookie::set($this->path['cokieBr'], null);
            $this->cookie::set($this->path['cokieOs'], null);
            $this->cookie::set($this->path['cokieTime'], null);
            $url = url('Login/index');
            $this->AdminId = '';
            $prompt = '请重新的登陆';
            if($this->request->isAjax()) {
                echo $this->dataJson(500, $prompt, '',$url);
            }else {
                echo "<script>alert('$prompt');window.location.href='$url'</script>";
            }
            exit;
        }
    }

}
?>