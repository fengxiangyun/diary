<?php
require_once CONFIG . '/DiaryTypeConfig.class.php';
class CategoryNamespace {
    
    /**
     * 
     * @brief 是否显示全部默认不显示
     * @param boolen $show
     */
    public static function getAllCategory($show = false, $categoryId = 0) {
        $cate = array();
        foreach(DiaryTypeConfig::$TYPE as $value) {
            if (!$show) {
                if ($value['show'] || $categoryId == $value['id']) {
                    $cate[] = $value;
                }
            } else {
                $cate[] = $value;
            }
            
        }
        return $cate;
        
    }
    
    public static function getCategoryById($id) {
        foreach(DiaryTypeConfig::$TYPE as $value) {
            if($value['id'] == $id) {
                unset($value['type']);
                return $value;
            }
        }
    }
    
    public static function getAllChildByCateogryId($id) {
        foreach(DiaryTypeConfig::$TYPE as $value) {
            if($value['id'] == $id) {
                return $value['majory'];
            }
        }
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
    
    public static function getById($id) {
        foreach (DiaryTypeConfig::$TYPE as $value) {
            if ($value['id'] == $id) {
                $value['type'] = 'category';
                return $value;
            }
            foreach ($value['majory'] as $v) {
                if ($v['id'] == $id) {
                    unset($value['majory']);
                    $v['parent'] = $value;
                    $v['type'] = 'majory';
                    return $v;
                }
            }
        }
        return null;
    }
}