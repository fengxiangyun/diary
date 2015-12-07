<?php
require_once APP . '/common/CommonAction.class.php';

class MoreAction extends CommonAction {
    public function init() {
        echo '345345';
        parent::init();
    }
    public function defaultAction() {
        header('Content-Type:text/html; charset=utf-8');
        //$categoryId = $_GET['id'];
//        var_dump(CategoryNamespace::getAllChildByCateogryId($categoryId));exit();
        $this->display();
    }
}