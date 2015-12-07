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
        $result['article']['xiaoshuo'] = $this->_getByCatogory(300, 2);
        $result['article']['weixiaoshuo'] = $this->_getByCatogory(200);
        $result['article']['riji'] = $this->_getByCatogory(20);
        $result['article']['rizhi'] = $this->_getByCatogory(10);
        $result['article']['sanwen'] = $this->_getByCatogory(21);
        $result['article']['juzi'] = $this->_getByCatogory(25);
        $result['article']['shige'] = $this->_getByCatogory(22);
        
        $this->assign('result', $result);
  //  print_r($result);
  
        $this->display();
    }
    
    private function _getTopList() {
        return ;
    }
    private function _getByCatogory($categoryId, $limit = 5) {
        $category = CategoryNamespace::getCategoryById($categoryId);
        return array(
            'ad' => null,//最多三条
            'image' => null,//两张图片
            'category_id'   => $categoryId,
            'category_name' => $category['name'], 
            'article' => self::mergeResult(
                CommonNamespace::getNewArticle($categoryId, NULL, $limit),
                CommonNamespace::getHotArticle($categoryId, NULL, $limit)
                
            )
        );
    }
    
}
