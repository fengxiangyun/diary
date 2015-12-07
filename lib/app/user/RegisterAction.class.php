<?php
require_once APP . '/common/include/BaseAction.class.php';
include_once THINKPHP . '/app/user/UserNamespace.class.php';

class RegisterAction extends BaseAction{
    
    private $_username = null;
    private $_password = null;
    private $_password2 = null;
    public  $error     = null;
    
    public function init() {
        $this->assign('css', array(
            'header-1.css',
            'footer.css',
            'user/common.css',
        ));
    }
    public function defaultAction() {
       
        if (HttpNamespace::isPost()) {
            $this->_username = HttpNamespace::getPOST('username');
            $this->_password  = HttpNamespace::getPOST('password');
            $this->_password2  = HttpNamespace::getPOST('password2');
            
            if ($this->_validator()) {
                if (UserNamespace::saveUser($this->_username, $this->_password)) {
                    if (UserNamespace::login($this->_username, $this->_password)) {
                        if (self::$REQUEST['url']) {
                            HttpNamespace::redirect(self::$REQUEST['url']);
                        }
                        HttpNamespace::redirect(__APP__);
                    } else {
                        HttpNamespace::redirect(UrlNamespace::loginUrl());
                    }
                }
            }
        }
        
        $this->assign($this->error);
        $this->display();
    }
    
    private function _validator() {
        if ($this->_username == '') {
            $this->error['username'] = '请填写用户名';
            return false;
        }
        $len = mb_strlen($this->_username, 'utf8');
        $badCharactors = '`~!@#$%^&*()-=+[]{}\\|;:\'",.<>/?';// 除_之外的其它字符
        for($i=0, $n=strlen($badCharactors);$i<$n;++$i) {
            if( strpos($this->_username, $badCharactors[$i]) !== false ) {
                $this->error['username'] = '用户名只能由中英文，数字和下划线组成';
                return false;
            }
        }
        if ($len < 4 || $len > 20) {
            $this->error['username'] = '用户名长度4-20个字符';
            return false;
        }
        if(UserNamespace::getUserInfo($this->_username)) {
            $this->error['username'] =  '用户名已存在';
            return false;
        }
        $this->error['name'] = $this->_username;
        if ($this->_password == '') {
            $this->error['password'] = '密码不能为空';
            return false;
        }
        if ($this->_password != $this->_password2) {
            $this->error['password'] = '两次输入的密码不一致';
            return false;
        }
        if (strlen($this->_password) < 3 || strlen($this->_password) > 20) {
            $this->error['password'] = '密码长度3-20个字符串';
            return false;
        }
       
        return true;
    }
}
