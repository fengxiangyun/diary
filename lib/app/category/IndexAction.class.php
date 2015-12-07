<?php
require_once APP . '/common/CommonAction.class.php';
require_once THINKPHP . '/app/common/CommonNamespace.class.php';

class IndexAction extends CommonAction{
    
    public function init() {
        $this->assign('css', array(
            'category/common.css',
            'footer.css',
        ));
        parent::init();
    }
    public function defaultAction() {
        if (self::$CATEGORY['id'] == 400) {
            $this->showImage();
        }
        
        
        $result['top_article'][] = array(
            'ad' => null,
            'image' => null,
            'article' =>self::mergeResult($this->getNewArticle(null, 3),
                 $this->getHotArticle(null, 3)),
        );

        $result['topic'] = IndexPageConfig::$TOPIC;
        $result['top_image'] = IndexPageConfig::$IMAGE_TOP;
        $result['mid_image'] = IndexPageConfig::$IMAGE_MID;
        $result['down_image'] = IndexPageConfig::$IMAGE_DOWN;
      
        foreach (self::$CATEGORY['majory'] as $value) {
            $result['article'][] = array(
                'ad' => null,
                'image' => null,
                'majory_id' => $value['id'],
                'majory_name'=> $value['name'],
                'article' => self::mergeResult($this->getNewArticle($value['id'], 4),
                                 $this->getHotArticle($value['id'], 4)),
            );
        }
      
        $this->assign('title', self::$CATEGORY['name']);
        $this->assign('result', $result);
        $this->display();
    }
    
    public function showImage() {
        $result['image'] = true;
        $result['topic'] = IndexPageConfig::$TOPIC;
        
        foreach (self::$CATEGORY['majory'] as $value) {
            $result['list'][] = array(
                'ad' => null,
                'image' => null,
                'majory_id' => $value['id'],
                'name'=> $value['name'],
                'list' => $this->getHotImage($value['id'], 8)
            );
        }
      
        $this->assign('title', self::$CATEGORY['name']);
        $this->assign($result);
        $this->display('category/image.php');
    }
    
    public function getHotImage($majoryId, $limit) {
        return CommonNamespace::getHotImage($majoryId, '', $limit);
    }
}