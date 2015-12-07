<?php
require_once APP . '/common/CommonAction.class.php';
require_once THINKPHP . '/app/common/CommonNamespace.class.php';
require_once dirname(__FILE__) . '/include/MedicalVar.class.php';

class HosdetailAction extends CommonAction{
    public function init() {
      
    }
    public function defaultAction() {
        $id = (int)$_GET['id'];
        $hospital = $this->_getHospitalById($id);
        $r = explode("||", $hospital['title']);
        $hospital['title'] = $r[0];
        $this->assign('hospital', $hospital);
        $this->display();
    }
    
    
    private function _getHospitalById($id) {
        $sql = "SELECT * FROM hospital_post WHERE `id` = ". $id;
        return DBMysqli::getInstance()->getRow($sql);
    }
}