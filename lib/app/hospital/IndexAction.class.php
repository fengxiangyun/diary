<?php
require_once APP . '/common/CommonAction.class.php';
require_once THINKPHP . '/app/common/CommonNamespace.class.php';
require_once THINKPHP . '/lib/db/DBXapian.class.php';

class HospitalAction extends CommonAction{
    public static $PAGE_SIZE = 20;
  
    
    public function init() {
      
    }
    public function defaultAction() {
        
        $disease = HttpNamespace::getGET('disease');
        $province = HttpNamespace::getGET('province');
        $city = HttpNamespace::getGET('city');
        $district = HttpNamespace::getGET('district');
        $level   = HttpNamespace::getGET('level');
        $page = HttpNamespace::getGET('page');
        $keyword = HttpNamespace::getGET('keyword');
        $result = DBXapian::searchHospital($disease,$province, $city, $district, '',$level, $keyword, $page ,self::$PAGE_SIZE);
        echo json_encode($result);exit;
    }
    
 
}