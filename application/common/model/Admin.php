<?php
namespace app\common\model;

use think\Exception;
use app\commonConfig\File;
use think\facade\Cookie;
class Admin extends Common {
    use File;
    protected $timeUpdate = true;
    protected $allwo = ['username','img','role_id','password','encrypt','disable','mail','tei','sex','name'];

    //添加
    public function add($data) {
        $data['disable'] = 1;
        $code = 0;
        $msg = '添加失败';
        $find = self::where('username','=', $data['username'])->count();
        if($find) {
            $msg = '名称已存在';
        }else {
            self::startTrans();
            try {
                if(self::allowField($this->allwo)->isUpdate(false)->save($data)) {
                    /**
                     * 移动文件操作
                     */
                    $file = $this->path['upload'] . date('Ymd'); //新的目录地址
                    //目录为空则创建目录
                    $this->createFile($file);
                    $longFile = $this->path['runtime'].$data['img'];
                    //移动文件
                    if($this->fileCopy($longFile, $this->path['upload'].$data['img'])) {
                        $msg = '添加成功';
                        $code = 1;
                        $this->cacheAdmin($data, $this->id, $data['img']);
                        //删除文件
                        unlink($longFile);
                        self::commit();
                    }else {
                        self::rollback();
                        $msg = '文件移动失败';
                    }
                }
            }catch (Exception $e) {
                self::rollback();
                $msg = '当前服务器异常';
            }
        }
        return self::dataJson($code, $msg, '', '', true);
    }

    //修改
    public function edit($data) {
        $code = 0;
        $msg = '修改失败';
        $where[] = ['username','eq', $data['username']];
        $where[] = ['admin_id','neq', $data['admin_id']];
        if(self::where($where)->count()) {
            $msg = '名称已存在';
        }else {
            $find = self::field('img')->where('admin_id', '=', $data['admin_id'])->find();
            self::startTrans();
            try {
                if(self::allowField($this->allwo)->isUpdate(true)->save($data, ['admin_id'=>$data['admin_id']])) {
                    if(!empty($data['img'])) {
                        /**
                         * 移动文件操作
                         */
                        $file = $this->path['upload']. date('Ymd'); //新的目录地址
                        //目录为空则创建目录
                        $this->createFile($file);
                        $longFile = $this->path['runtime'].$data['img'];
                        //移动文件
                        if($this->fileCopy($this->path['runtime'].$data['img'], $this->path['upload'].$data['img'])) {
                            $msg = '修改成功';
                            //删除文件
                            @unlink($longFile);
                            if(!empty($find['img'])) {
                                @unlink($this->path['upload'].$find['img']);
                            }
                            $this->cacheAdmin($data, $data['admin_id'], $data['img']);
                            self::commit();
                            $code = 1;
                        }else {
                            self::rollback();
                            $msg = '文件移动失败';
                        }
                    }else {
                        $msg = '修改成功';
                        $this->cacheAdmin($data, $data['admin_id'], $find['img']);
                        self::commit();
                        $code = 1;
                    }
                }
            }catch(Exception $e) {
                self::rollback();
                $msg = '当前服务器异常';
                $code = 0;
            }
        }
        return self::dataJson($code, $msg, '', '', true);
    }

    //写入前后操作
    protected static function init() {
        //前
        self::event('before_write', function($user) {

            if(!empty($user['password'])) {
                if(empty($user['pass'])) { //防止重复new Password
                    $passowrd = new \app\commonConfig\Password();
                }else {
                    $passowrd = $user['pass'];
                }
                $random = $passowrd->random();
                $user['encrypt'] = $random;
                $user['password'] = $passowrd->encrypt($user['password'], $random);
            }
        });
    }

    //更新缓存
    protected function cacheAdmin($user, $id, $img) {
        $dataUser = [
            'admin_id' => $id,
            'username' => $user['username'],
            'disable' => $user['disable'],
            'role_id' => $user['role_id'],
            'img' => $img,
            'mail' => empty($user['mail'])? '' : $user['mail'],
            'name' => empty($user['name'])? '' : $user['name'],
            'tei' => empty($user['tei'])? '' : $user['tei'],
            'sex' => empty($user['sex'])? '' : $user['sex'],
        ];
        $this->cache::set($this->path['adminInfo_'] . $id, $dataUser);
    }

//                            self::cache(self::$path['adminInfo_'] . $data['admin_id'], $data);
    //删除
    public function del($id) {
        $code = 0;
        $msg = '删除失败';
        $where[] = ['admin_id', '=', $id];
        $find = self::field('img')->where($where)->find();
        if(!empty($find['img'])) {
            self::startTrans();
            try {
                if(self::where($where)->delete()) {
                    self::commit();
                    unlink($this->path['upload'] . $find['img']);
                    $msg = '删除成功';
                    $this->cache::rm($this->path['adminInfo_'] . $id);
                    $code = 1;
                }
            }catch (Exception $e) {
                self::rollback();
                $msg = '服务器异常';
            }

        }
        return self::dataJson($code, $msg, '', '', true);
    }

    //展示数据
    public function show($get,$where=[]) {
        $select = self::where($where)->order('admin_id desc')->paginate($get['limit'], true, ['page'=>$get['page']])->each(function($str) {
            $str['img'] = $this->path['uploadEnd'] . $str['img'];
            return $str;
        })->toArray();
        $count = self::where($where)->count();
        return self::dataJson(1, 'success', ['data'=>$select['data'], 'count'=>$count], '', true);
    }

    //登陆验证
    public function login($data) {

        $code = 0;
        $msg = '账号密码错误';
        $where[] = [];
        $find = self::where('username', '=', $data['username'])->find();
        if(!empty($find)) {
            if($find['disable'] == 2) {
                $msg = '当前账号已禁用';
            }else {
                $passowrd = new \app\commonConfig\Password();
                //验证密码
                if($find['password'] == $passowrd->encrypt($data['password'], $find['encrypt'])) {
                    $code = 1;
                    $msg = '登陆成功';
                    $time = 3600*24;
                    if(!empty($data['land']) && $data['land'] == 1) {
                        $time = $time*7;
                    }
                    if(!$this->cache::get($this->path['adminInfo_'] . $find['admin_id'])) { //缓存不存在就更新缓存
                        $this->cacheAdmin($find, $find['admin_id'], $find['img']);
                    };
                    $currentTime = time();
                    $Ip = new \app\commonConfig\Ip();
                    $Browser = new \app\commonConfig\Browser();
                    $Cookie = new Cookie();
                    $br = strtolower($_SERVER['HTTP_USER_AGENT']);
                    $Cookie::set($this->path['cokieUser'], $passowrd->respass($data['username']), $time);
                    $Cookie::set($this->path['cokieId'], $passowrd->respass($find['admin_id']), $time);
                    $Cookie::set($this->path['cokieIp'], $passowrd->respass($Ip->passIp()), $time);
                    $Cookie::set($this->path['cokieBr'], $passowrd->respass($Browser->GetBrowser(true,$br)), $time);
                    $Cookie::set($this->path['cokieOs'], $passowrd->respass($Browser->GetOs(true,$br)), $time);
                    $Cookie::set($this->path['cokieTime'], $passowrd->respass($currentTime+$time), $time);
                    //添加登陆记录
                    Model('Adminrecord')->add($find['admin_id'], $currentTime,$Ip, $Browser->GetBrowser(false,$br),$Browser->GetOs(false,$br));
                }else {
                    $msg = '账号密码错误';
                }
            }
        }
        return self::dataJson($code, $msg, '', '', true);
    }

    //修改个人中心
    public function personal($data, $id) {
        $allow = ['mail','tei','sex','name'];
        $code = 0;
        $msg = '修改失败';
        $user = $this->cache::get($this->path['adminInfo_'] . $id);
        if($user) {
            if(self::allowField($allow)->isUpdate(true)->save($data,['admin_id'=>$id])) {
                $this->cacheAdmin($data+$user, $id, $user['img']);
                $code = 1;
                $msg = '修改成功,请刷新页面！';
            }
        };
        return self::dataJson($code, $msg, '', '', true);
    }

    //修改密码
    public function personalPass($data, $id) {
        $allow = ['password','encrypt'];
        $code = 0;
        $msg = '修改失败';
        $user = $this->cache::get($this->path['adminInfo_'] . $id);
        if($user) {
            $find = self::field('password,encrypt')->where('admin_id','=',$id)->find();
            $passowrd = new \app\commonConfig\Password();
            $data['pass'] = $passowrd;
            //判断旧密码是否正确
            if($passowrd->encrypt($data['oldpass'], $find['encrypt']) == $find['password']){
                if(self::allowField($allow)->isUpdate(true)->save($data,['admin_id'=>$id])) {
                    $code = 1;
                    $msg = '修改成功';
                }
            }else {
                $msg = '旧密码错误！';
            };

        };
        return self::dataJson($code, $msg, '', '', true);
    }

}