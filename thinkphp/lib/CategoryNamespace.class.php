<?php
require_once CONFIG . '/DiaryTypeConfig.class.php';
class CategoryNamespace {
    
    /**
     * 
     * @brief 是否显示全部默认不显示
     * @param boolen $show
     */
    public static function getAllMajory() {
        return DiaryTypeConfig::$TYPE['majory'];
        
    }
    
    public static function getMajoryById($id) {
        foreach (DiaryTypeConfig::$TYPE as $value) {
            foreach ($value['majory'] as $v) {
                if ($v['id'] == $id) {
                    unset($value['majory']);
                    $v['parent'] = $value;
                    return $v;
                }
            }
        }
    }

}