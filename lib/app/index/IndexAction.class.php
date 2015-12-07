<?php
require_once APP . '/common/include/BaseAction.class.php';
require_once THINKPHP . '/app/common/CommonNamespace.class.php';

class IndexAction extends BaseAction{
    public function init() {
        $this->assign('css', array(
            'index/common.css',
            'header-1.css',
            'footer.css',
        ));
    }
    
    public function defaultAction() {
        
        $result['top_image'] = IndexPageConfig::$IMAGE_TOP;//顶部图片
        $result['top_article']   = IndexPageConfig::$TOP_ARTICLE;//头条
        $result['mid_image'] = IndexPageConfig::$IMAGE_MID;
        $result['topic'] = IndexPageConfig::$TOPIC;

        
        $this->assign('result', $result);
  //  print_r($result);
  
        $this->display();
    }
    


    
}
