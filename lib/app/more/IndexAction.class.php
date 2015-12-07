<?php
require_once APP . '/common/CommonAction.class.php';
require_once THINKPHP . '/app/common/CommonNamespace.class.php';


class IndexAction extends CommonAction{

    public function init() {
        $this->assign('css', array(
            'index/common.css',
            'header-1.css',
            'footer.css',
        ));
        parent::init();
    }
    public function defaultAction() {
        $result['topic'] = IndexPageConfig::$TOPIC;
        
        $result['top_image'] = IndexPageConfig::$IMAGE_TOP;
        $this->assign($result);
        $this->display();
    }
}