<?php
class UrlNamespace{
    
    /**
     * @brief详情页面
     * @param $majory
     * @param $puid
     */
    public static function detailUrl($majory, $puid) {
        return __APP__ . '/detail/?majory=' . $majory . '&puid=' . $puid; 
    }
    
    /**
     * @brief 大类
     */
    public static function categoryUrl($category) {
        return __APP__ . '/category/?category=' . $category;
    }
    
    /**
     * @brief 小类
     */
    
    public static function majoryUrl($majory) {
        return __APP__ . '/majory/?majory=' . $majory;
    }
    
    public static function hotArticleUrl($category, $majory) {
        $url = __APP__ . '/hot/?category=' . $category;
        if ($majory) {
            $url = __APP__ . '/hot/?majory=' . $majory;
        }
        return $url;
    }
    
    public static function shareUrl($majory, $puid) {
        return __APP__ . '/share/?majory=' . $majory . '&puid=' . $puid; 
    }
    
    public static function loginUrl() {
        return __APP__ . '/user/login';
    }
    
    public static function registerUrl() {
        return __APP__ . '/user/register';
    }
    
    public static function pubrUrl() {
        return __APP__ . '/pub/';
    }
    
    public static function pubTypeUrl($majory) {
        return __APP__ . '/pub/detail?majory=' . $majory;
    }
    
    public static function searchUrl($word, $type) {
        return __APP__ . '/search/?kw=' . $word .'&type='.$type;
    }
    
    public static function creatHospitalUrl($disease='',$province ='', $city='', $district='', $street='',$level=0, $keyword='', $page = '') {
        $url = __APP__ .  '/medical/hospital/?';
        if ($disease) {
            $url .= 'disease=' . $disease;
        }
        if ($province) {
            $url .= '&province=' . $province;
        }
        if ($city) {
            $url .= '&city=' . $city;
        }
        if ($district) {
            $url .= '&district=' . $district;
        }
        if ($street) {
            $url .= '&street=' . $street;
        }
        if ($level) {
            $url .= '&level=' . $level;
        }
        if ($keyword) {
            $url .= '&keyword=' . $keyword;
        }
        if($page) {
            $url .= '&p=' . $page;
        }
        return $url;
    }
    
    public static function hospitalDetail($id) {
        return  __APP__ . '/medical/hosdetail/?id=' . $id;;
    }
}