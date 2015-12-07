<?php
class UrlNamespace{
    
    /**
     * @brief详情页面
     * @param $majory
     * @param $puid
     */
    public static function detailUrl($puid) {
        return __APP__ . '/detail/?puid=' . $puid;
    }
    
    /**
     * @brief 小类
     */
    
    public static function majoryUrl($majory) {
        return __APP__ . '/majory/?majory=' . $majory;
    }
    
    public static function hotArticleUrl($majory = '') {
        $url = __APP__ . '/hot/';
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
}