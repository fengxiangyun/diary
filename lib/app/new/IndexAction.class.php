<?php
require_once APP . '/common/CommonAction.class.php';
require_once THINKPHP . '/app/common/CommonNamespace.class.php';

require_once THINKPHP . '/app/detail/DetailNamespace.class.php';

class IndexAction extends CommonAction{
    public static $PAGE_SIZE = 30;
    public function init() {
        $this->assign('css', array(
            'category/common.css',
            'footer.css',
        ));
        parent::init();
    }
    public function defaultAction() {

        
        $result['topic'] = IndexPageConfig::$TOPIC;
        $result['top_image'] = IndexPageConfig::$IMAGE_TOP;
        //$result['mid_image'] = IndexPageConfig::$IMAGE_MID;
        $result['down_image'] = IndexPageConfig::$IMAGE_DOWN;
        $result['top_article'][] = array(
            'ad' => null,
            'image' => null,
            'article' =>self::mergeResult($this->getNewArticle(self::$MAJORY['id'], 2),
                 $this->getHotArticle(self::$MAJORY['id'], 2)),
        );

       
        list($page, $list) = CommonNamespace::showPage(self::$MAJORY);
        $result['article'][] = array(
           'ad' => null,
           'image' => null,
           'article' =>$list,
        );
       
        $this->assign('title', '最新发布');
        $this->assign('page', $page);
        $this->assign('result', $result);
        $this->display();
    }

}