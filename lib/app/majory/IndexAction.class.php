<?php
require_once APP . '/common/CommonAction.class.php';
require_once THINKPHP . '/app/common/CommonNamespace.class.php';
require_once THINKPHP . '/lib/db/DBXapian.class.php';
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
        if (self::$CATEGORY['id'] == 400) {
            $this->showImage();
        }
        
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
        $page = HttpNamespace::getGET('p', 1);
       
        list($page, $list) = CommonNamespace::showPage(self::$CATEGORY, self::$MAJORY);
        $result['article'][] = array(
           'ad' => null,
           'image' => null,
           'majory_id' => self::$MAJORY['id'],
           'majory_name'=> self::$MAJORY['name'],
           'article' =>$list,
        );
       
        $this->assign('title', self::$MAJORY['name']);
        $this->assign('page', $page);
        $this->assign('result', $result);
        $this->display();
    }
    
    /*
     * @brief 图片类别
     */
    public function showImage() {
        $result['image'] = true;
        $result['topic'] = IndexPageConfig::$TOPIC;
        $name_id = HttpNamespace::getGET('name');
        if ($name_id) {
            $image = DetailNamespace::getNameById($name_id);
            if (!$image) {
                HttpNamespace::redirect(UrlNamespace::categoryUrl(self::$CATEGORY['id']));
            }
        }else {
            $category = self::$CATEGORY;
            $category['table'] = 'image';
            list($page, $list) = CommonNamespace::showPage($category, self::$MAJORY, 'id', 10);
            foreach($list  as $key => $value) {
                $list[$key]['list'] = $this->getHotImage(self::$MAJORY['id'],$value['id'], 4);
            }
            $this->assign('title', self::$MAJORY['name']);
            $this->assign('list', $list);
            $this->assign('image', true);
            $this->assign('page', $page);
            $this->display('majory/list.php');
        }
        $page = HttpNamespace::getGET('p');
        list($list, $result['count']) = DBXapian::searchImageByName($name_id, $page, 16);
        //组合list
        $result['list'] = array(
            array(
                'id'        => $image['id'],
                'majory_id' => self::$MAJORY['id'],
                'name'      => $image['name'],
                'list'      => $list,
            )
        );
        $result['title'] = self::$MAJORY['name'] . '-' . $image['name'];
        $result['type_id'] = $this->typeId;
        $result['page']    = $this->_showPage($result['count']);
        $this->assign($result);
        $this->display('majory/list.php');
    }
    
    public function getHotImage($majoryId, $nameId, $limit) {
        return CommonNamespace::getHotImage($majoryId, $nameId, $limit);
    }
     
    private function _showPage($count) {
        $page = new Page($count, self::$PAGE_SIZE);
        return $page->show();
    }
}