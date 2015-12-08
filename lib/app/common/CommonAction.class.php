<?php
require_once APP . '/common/include/BaseAction.class.php';

class CommonAction extends BaseAction {
    
    
    public static $CATEGORY = NULL;
    public static $MAJORY   = NULL;
    
    public function init() {
        self::$REQUEST = self::getGet();

        if (isset(self::$REQUEST['majory'])) {
            self::$MAJORY   = CategoryNamespace::getMajoryById(self::$REQUEST['majory']);
            $this->assign('majory', self::$MAJORY);
        }
        if (!isset(self::$REQUEST['kw'])) {
            $this->assign('kw', '死神');
        }
    }
    
    public function getNewArticle($majory, $limit, $offset = 0) {
        return CommonNamespace::getNewArticle($majory, $limit, $offset);
    }
    
    public function getHotArticle($majory, $limit) {
        return CommonNamespace::getHotArticle( $majory, $limit);
    }
    
    public static function getErrorCode() {
        return (int)HttpNamespace::getGET('error', 0);
    }
    
   
}