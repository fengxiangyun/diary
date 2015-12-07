<?php
include_once THINKPHP . '/app/BaseNamespace.class.php';

class DetailNamespace extends BaseNamespace {
    
    /**
     * @param string $table
     * @param int $puid
     */
    public static function getArticle($puid) {
        $sql = "SELECT * FROM " . self::$TABLE_DIARY . " WHERE `puid`={$puid}";
        return DBMysqli::getInstance()->getRow($sql);
    }
    

    public static function increaseReadTimes($puid) {
        $sql = "UPDATE " . self::$TABLE_DIARY . " SET `read_times` = `read_times` + 1,`weight`=`weight`+1 WHERE `puid` = {$puid}";
        return DBMysqli::getInstance()->execute($sql);
    }
    
    public static function increaseShareTimes($puid) {
        $sql = "UPDATE " . self::$TABLE_DIARY . " SET `share_times` = `share_times` + 1,`weight`=`weight`+1 WHERE `puid` = {$puid}";
        return DBMysqli::getInstance()->execute($sql);
    }

    public static function getNearArticle($puid) {
        $sql1 = "SELECT * FROM  " . self::$TABLE_DIARY . " WHERE puid < {$puid} ORDER BY puid DESC LIMIT 1";
        $sql2 = "SELECT * FROM  " . self::$TABLE_DIARY . " WHERE puid > {$puid} ORDER BY puid ASC LIMIT 1";
        return array(
            0 => DBMysqli::getInstance()->getRow($sql1),
            1 => DBMysqli::getInstance()->getRow($sql2)
        );
    }
    

    
    public static function getRelateArticle($article , $limit = 6) {


        $half = (int)$limit/2;
        $left = $limit - $half;

        $sql = "SELECT * FROM  " . self::$TABLE_DIARY . " WHERE user_id = {$article['user_id']} AND puid < {$article['puid']} ORDER BY puid DESC LIMIT {$half}";
        $re[0] = DBMysqli::getInstance()->getAll($sql);
        $sql = "SELECT * FROM  " . self::$TABLE_DIARY . " WHERE user_id = {$article['user_id']} AND puid > {$article['puid']} ORDER BY puid ASC LIMIT {$left}";
        $re[1] = DBMysqli::getInstance()->getAll($sql);
        $result = array_merge((array)$re[0], (array)$re[1]);
        return $result;
    }
    
    public static function getComment($category, $puid, $limit = 6) {
        $table = $category['table'] . '_comment';
        $sql = "SELECT * FROM {$table} WHERE puid = {$puid} ORDER BY id desc LIMIT {$limit}";
        return DBMysqli::getInstance()->getAll($sql);
    }

    public static function getNameById($id) {
        $sql = "SELECT * FROM `image` WHERE `id`={$id}";
        return DBMysqli::getInstance()->getRow($sql);
    }
}