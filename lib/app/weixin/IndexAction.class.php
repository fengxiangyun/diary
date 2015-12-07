<?php
require_once APP . '/common/CommonAction.class.php';
require_once THINKPHP . '/app/common/CommonNamespace.class.php';
require_once APP . '/weixin/include/Weixin.class.php';

class IndexAction extends CommonAction{
    public static $PAGE_SIZE = 30;
    public $msg = null;
    public function init() {
//        echo $_GET['echostr'];exit;
//        //
        header("Content-type:text/html;charset=utf-8");
       new Weinin();
    }
    public function defaultAction() {
      exit();
        $result['top_image'] = IndexPageConfig::$IMAGE_TOP;
        $this->assign($result);
        $this->display();
    }
    
    private function checkSignature()
    {
            $signature = $_GET["signature"];
            $timestamp = $_GET["timestamp"];
            $nonce = $_GET["nonce"];	
            		
        $token = 'zhaoxiaozhi123';
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );
        
        if( $tmpStr == $signature ){
            return true;
    	}else{
    		return false;
    	}
    }
}
