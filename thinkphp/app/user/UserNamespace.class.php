<?php
include_once THINKPHP . '/lib/db/DBMysqli.class.php';


class UserNamespace{
    
    public static function getUserByUsername() {
        
    }
    
    public static function getUserInfo($username) {
        $sql = "SELECT * FROM `user` WHERE `user_name` = '" . $username . "'";
        return DBMysqli::getInstance()->getRow($sql);
    }
    
    public static function saveUser($username, $password) {
        $sql = "INSERT INTO `user`(`user_name`, `nick_name`, `last_login_time`, `last_login_ip`, 
            `password`, `register_time`)VALUES('". $username ."','".$username."','".time()."',
            '".HttpNamespace::getIp()."','".md5($password)."','".time()."')";
        return DBMysqli::getInstance()->execute($sql);
    }
    
    public static function login($username, $password) {
        if ($result = self::getUserInfo($username)) {
            if ($result['password'] == md5($password)) {
                unset($result['password']);
                $_SESSION['login'] = true;
                $_SESSION['user']  = $result;
                return true;
            }
        }
        return false;
    }
    
    public static function getUserById($uid) {
        $uid = (int)$uid;
        if ($uid <= 0) {
            return '';
        }
        $sql = "SELECT * FROM `user` WHERE `id` = '" . $uid . "'";
        return DBMysqli::getInstance()->getRow($sql);
    }
}