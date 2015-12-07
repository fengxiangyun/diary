<?php
require_once CONFIG . '/DiaryTypeConfig.class.php';
require_once THINKPHP . '/lib/CategoryNamespace.class.php';
require_once CONFIG . '/IndexPageConfig.class.php';
require_once APP . '/common/UrlNamespace.class.php';

class BaseAction extends Action{
    public static $REQUEST  = NULL;

    
    public function getGet() {
        foreach ($_REQUEST as $key => $value) {
            $_REQUEST[$key] = HttpNamespace::getREQUEST($key);
        }
        return $_REQUEST;
    }
    
    public static function mergeResult($array1, $array2) {
        if (!empty($array1)) {
            foreach ($array1 as $value) {
                if (!empty($array2)) {
                    foreach ($array2 as $k => $v) {
                        if ($value['puid'] == $v['puid']) {
                            
                            unset($array2[$k]);
                        }
                    }
                } else {
                    return $array1;
                }
            }
        }
        return array_merge((array)$array1, (array)$array2);
    }
}