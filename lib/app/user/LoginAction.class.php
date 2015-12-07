<?php
require_once APP . '/common/include/BaseAction.class.php';
require_once THINKPHP . '/app/user/UserNamespace.class.php';

class LoginAction extends BaseAction{
    
    public $result = array(); 
    
    public function init() {
        $this->assign('css', array(
            'header-1.css',
            'footer.css',
            'user/common.css',
        ));
    }
    function defaultAction() {
        
        $this->result['top_image'] = IndexPageConfig::$IMAGE_TOP;
        if(HttpNamespace::isPost()) {
            $username = HttpNamespace::getPOST('username');
            $password = HttpNamespace::getPOST('password');
            if (empty($username) || empty($password)) {
                $this->result['error'] = '用户名和密码不能为空';
            } else {
                if (UserNamespace::login($username, $password)) {
                    if (self::$REQUEST['url']) {
                        HttpNamespace::redirect(self::$REQUEST['url']);
                    }
                    HttpNamespace::redirect(__APP__);
                }
                $this->result['error'] = '用户名或密码错误';
            }
        }
        $this->assign($this->result);
        $this->display();
    }
    
    private function _login($user) {
        $_SESSION['login'] = true;
        unset($user['password']);
        $_SESSION['user'] = $user;
    }
}