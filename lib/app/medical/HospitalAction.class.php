<?php
require_once APP . '/common/CommonAction.class.php';
require_once THINKPHP . '/app/common/CommonNamespace.class.php';
require_once THINKPHP . '/lib/db/DBXapian.class.php';
require_once dirname(__FILE__) . '/include/Pages.class.php';
require_once dirname(__FILE__) . '/include/MedicalVar.class.php';

class HospitalAction extends CommonAction{
    public static $PAGE_SIZE = 20;
  
    
    public function init() {
      
    }
    public function defaultAction() {
        $provinceCacheFile = dirname(__FILE__) . '/include/cityCache.php';
        $provinceCache     = trim(file_get_contents($provinceCacheFile));
        //加载缓存
        if ($provinceCache != '') {
            $provinces = json_decode($provinceCache, true);
            
        } else {
            //组合
            $provinces = $this->_getAllProvince();
            foreach($provinces as &$value) {
                $citys = $this->_getAllCity($value['province_id']);
                if (count($citys) > 1) {
                    array_unshift($citys, array('city_id' => '', 'short_name' => '全部'));
                }
                $value['city'] = $citys;
            }
            $cityCache = json_encode($provinces);
            if (!file_put_contents($provinceCacheFile, $cityCache)) {
                echo '文件: '. $provinceCacheFile .' 不可写';exit;
            }
        }
        //变量声明
        $level = '';
        $disease = '';
        $keyword = '';
        $district = '';
        $province = '';
        //省
        if ($_GET['province']) {
            $province = $this->_getProvinceById((int)$_GET['province']);
        }
        //地区,市
        if ($_GET['city']) {
            $city = $this->_getCityById((int)$_GET['city']);
            $districts = $this->_getAllDistrict((int)$_GET['city']);
            //区域
            if ($_GET['district']) {
                $district = $this->_getDistrictById((int)$_GET['district']);
            }
            //街道
            $street = '';
        }
        
        //一样级别
        if ($_GET['level']) {
            $level = (int)$_GET['level'];
        }
        //疾病id
        if ($_GET['disease']) {
            $disease = (int)$_GET['disease'];
        }
        //关键词
        if ($_GET['keyword']) {
            $keyword = htmlspecialchars($_GET['keyword']);
        }
        
        //页数
        if ($_GET['p']) {
            $p = htmlspecialchars($_GET['p']);
        }
        $result = DBXapian::searchHospital($disease,$province['province_id'], $city['city_id'], $district['district_id'], $street,$level, $keyword, $p, self::$PAGE_SIZE);
        $hospital = $result[0];
        $count    = $result[1];
        $pa = new Pages($count, self::$PAGE_SIZE);
        $page   = $pa->show();
        $this->assign('provinces', $provinces);
        $this->assign('province', $province);
        $this->assign('city', $city);
        $this->assign('districts', $districts);
        $this->assign('district', $district);
        $this->assign('level', $level);
        $this->assign('disease', $disease);
        $this->assign('keyword', $keyword);
        $this->assign('hospital', $hospital);
        $this->assign('page', $page);
        $this->display();
    }
    
    private function _getAllProvince() {
        $sql = "SELECT province_id,short_name,pinyin FROM province";
        return DBMysqli::getInstance()->getAll($sql);
    }
    
    private function _getAllCity($provinceId) {
        $sql = "SELECT city_id,short_name,pinyin FROM city WHERE `province_id` = ". $provinceId;
        return DBMysqli::getInstance()->getAll($sql);
    }
    
    private function _getProvinceById($provinceId) {
        $sql = "SELECT * FROM province WHERE `province_id` = ". $provinceId;
        return DBMysqli::getInstance()->getRow($sql);
    }

    private function _getCityById($cityId) {
        $sql = "SELECT * FROM city WHERE `city_id` = ". $cityId;
        return DBMysqli::getInstance()->getRow($sql);
    }
    
    private function _getAllDistrict($cityId) {
        $sql = "SELECT * FROM district WHERE `city_id` = ". $cityId;
        return DBMysqli::getInstance()->getAll($sql);
    }
    
    private function _getDistrictById($districtId) {
        $sql = "SELECT * FROM district WHERE `district_id` = ". $districtId;
        return DBMysqli::getInstance()->getRow($sql);
    }
}