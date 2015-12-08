<?php
include_once THINKPHP . '/app/BaseNamespace.class.php';

class CommonNamespace extends BaseNamespace{
    
    private static $_FIELDS = array(
        'puid',
        'majory',
        'majory_id',
        'title',
        'author',
        'comment_times',
        'weight',
    );
    
    private static $_TIME  = 1000;
    private static $_TABLE = NULL;
    private static $_SQL   = NULL;
    private static $_LIMIT = 10;
    
    /**
     * @brief 最热的文章，默认存放50条
     * @param int $majory
     * @param int $limit 
     */
    public static function getHotArticle($majoryId, $limit = 10) {
        $limit = ($limit < 51) ? $limit : 60;
        $key = 'hot_' . $majoryId;
        //list时间默认10分钟;
        $t = getMicrosecond();
        $result = DBRedis::lRange($key, 0, $limit - 1, self::$_TIME);
        if ($result){
            
            return array_map('unserialize', $result);
        } else {
           $sql = self::_buildSql($majoryId, 'hot');
          
           $result = DBMysqli::getInstance()->getAll($sql);
            
            foreach ($result as $value) {
                DBRedis::rPush($key, serialize($value));
                
            }
           //echo $sql.' -> '.((getMicrosecond()-$t)/1000).'<br>';
            return array_slice($result, 0, $limit);
        }
        
    }


    /**
     * 
     * @brief 最新发布的文章,默认存放50条
     * @param int $type
     * @param int $majory
     * @param int $limit
     */
    public static function getNewArticle($majoryId, $limit = 10, $offset = 0) {
        if (empty($categoryId)) {
            HttpNamespace::redirect(__APP__);
        }
        $limit = ($limit < 51) ? $limit : 50;
        $key = 'new_' . $majoryId;
        //list时间默认5分钟;
        $t = getMicrosecond();
        $result = DBRedis::lRange($key, $offset, $limit + $offset - 1, self::$_TIME);
        if ($result){
            return array_map('unserialize', $result);
        } else {
            //echo 'new mysql/';
            $sql = self::_buildSql($majoryId, 'new');
            $result = DBMysqli::getInstance()->getAll($sql);
            foreach ($result as $value) {
                DBRedis::rPush($key, serialize($value));
                
            }
//            echo $sql.' -> '.((getMicrosecond()-$t)/1000).'<br>';
            return array_slice($result, 0, $limit);
        }
    }
    /**
     * 
     * @brief 分页
     * @param unknown_type $model
     * @param unknown_type $pageSize
     * @param unknown_type $map
     * @param unknown_type $order
     * @param unknown_type $join
     * @param unknown_type $field
     */
    public static function showPage($majory, $order = 'puid', $limit = 30) {
        
        $field = self::_getFields();
        $where = "`majory_id` = {$majory['id']}";
        $sqlCount = "SELECT count(*) as count FROM " . self::$TABLE_DIARY . " WHERE {$where}";
        
        $page = HttpNamespace::getGET('p', 1);
        $offset = ($page-1) * $limit;
        $sql = "SELECT " . implode(',', $field) . " FROM " . self::$TABLE_DIARY . " WHERE {$where} ORDER BY `".$order."` desc LIMIT {$offset},{$limit}";
        $num = DBMysqli::getInstance()->getRow($sqlCount);
        $page = new Page($num['count'], $limit);
        $result[]   = $page->show();
        $result[]   = DBMysqli::getInstance()->getAll($sql);
        return $result;
        
    }
    
    private static function _getFields() {
        $field = self::$_FIELDS;
        
        return $field; 
         
    }
    private static function _buildSql($majoryId, $type) {

        $table = self::$TABLE_DIARY;
        //日记类型 增加日记本  小说
        $field = self::_getFields();
        
      
        $sql = "SELECT " . implode(',', $field) . " FROM
               " . $table;
        if ($majoryId) {
            $sql .= " WHERE `majory_id` = {$majoryId}";
        }
        if ($type == 'new') {
            $sql .= " ORDER BY `puid` desc LIMIT " . self::$_LIMIT;
        } else if ($type == 'hot') {
            $sql .= " ORDER BY `weight` DESC LIMIT " . self::$_LIMIT;
        } else {
            $sql .= " LIMIT " . self::$_LIMIT;
        }
        return $sql;
    }
}
