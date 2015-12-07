<?php
require_once CONFIG . '/DBConfig.class.php';
require_once ROOT . "/xapian/xapian.php";
require_once THINKPHP . '/lib/word/WordCorrection.class.php';
require_once THINKPHP . '/lib/db/DBScws.class.php';

class DBXapian{
    
    private static $_INSTANCE = NULL;//xapian链接实例
    private static $_MAX      = 3000;
    
    private static function _connect($db) {
        if (!self::$_INSTANCE) {
            if ($db){
                self::$_INSTANCE = new XapianDatabase($db);
            }else{
                self::$_INSTANCE = new XapianDatabase(DBConfig::$XAPIAN['database']);
            }
            if (self::$_INSTANCE){
                return true;
            } else {
                return false;
            }
        }
        return true;
    }
    
    
    /**
     * @brief 搜索用户帖子
     * @param userid $Uid
     */
    public static function searchByUid($Uid, $page = 1, $pagesize = 30, $max = 0) {
        $max = ($max > 0) ? $max : self::$_MAX;
        $page = empty($page) ? 1 : $page; 
        
        if (!self::_connect() || empty($Uid)) return false;
        $queryparser = new XapianQueryParser();
        $queryparser->add_prefix('userId', "UID");
        $queryparser->set_database(self::$_INSTANCE);
        $query = $queryparser->parse_query("userId:{$Uid}");
        $enquire = new XapianEnquire(self::$_INSTANCE);
        $enquire->set_sort_by_value(0);//排序时间
        $enquire->set_query($query);
 
        $matches = $enquire->get_mset(0, $max);//最多显示300条
        $start = $matches->begin();
        $end = $matches->end();
        $count = $matches->size();
        $index = 0;
        $re = array();
        while (!($start->equals($end))){
            $data = array();
            if ($index < $page*$pagesize && $index >= ($page-1)*$pagesize) {
                $doc = $start->get_document();
                $result = json_decode($doc->get_data(),true);
                $data['puid'] = $result['puid'];
                $data['author'] = $result['author'];
                $data['title'] = $result['title'];
                $data['majory'] = $result['majory'];
                $data['majory_id'] = $result['majory_id'];
                $data['time_step'] = $result['time_step'];
                if (isset($result['diary_book'])) {
                    $data['diary_book'] = $result['diary_book'];
                }
                $re[] = $data;
            } elseif($index >= $page*$pagesize){
                break;
            }
            $start->next();
            $index++;
        }
        return array($re, $count);
    }
    
    /**
     * 
     * @brief xapian query搜索
     * @param array $params = array('query'=>'搜索词','type'=>10，大类ID)
     * @param int $page
     * @param int $pagesize
     */
    public static function searchByQuery($params, $page = 1, $pagesize = 30) {
        $page = empty($page) ? 1 : $page; 
        if (!self::_connect()) return false;
        $flag = false;
        //切词 如果是日记本 作者不需要去除停用词
        if (isset($params['author']) || isset($params['bookname'])) {
            $flag = true;
        }
        $word = $realQuery = DBScws::cutWord($params['query'], $flag);
        if (isset($params['category']) && $params['category'] != "") {
            $realQuery[] = 'TID' . $params['category']['id'];
        }
        if (isset($params['majory']) && $params['majory'] != "") {
            $realQuery[] = 'MID' . $params['majory']['id'];
        }
        //按照作者搜索
        if (isset($params['author']) && $params['author']) {
            foreach($realQuery as $k=>$v) {
                $realQuery[$k] = 'UNAME' . $v;
            }
        }
        //按照uid
        if (isset($params['uid']) && $params['uid']) {
            $realQuery = array('UID' . $params['query']);
        }
        //按照日记本id搜索
        if (isset($params['bookid']) && $params['bookid']) {
            $realQuery = array('BOOKID' . $params['query']);
        }
        //按照日记本名字
        if (isset($params['bookname']) && $params['bookname']) {
            foreach($realQuery as $k=>$v) {
                $realQuery[$k] = 'BOOKNAME' . $v;
            }
        }
        
        $queryparser = new XapianQueryParser();
        $queryparser->set_database(self::$_INSTANCE);
        $enquire = new XapianEnquire(self::$_INSTANCE);
        $enquire->set_sort_by_value(0);//排序
        $query = new XapianQuery(XapianQuery::OP_AND, $realQuery);
        $enquire->set_query($query);
        $matches = $enquire->get_mset(0, self::$_MAX);//最多显示300条
        $start = $matches->begin();
        $end = $matches->end();
        $count = $matches->size();
        $index = 0;
        $re = array();
        while (!($start->equals($end))){
            $data = array();
            if ($index < $page*$pagesize && $index >= ($page-1)*$pagesize) {
                $doc = $start->get_document();
                $result = json_decode($doc->get_data(),true);
                $data['puid'] = $result['puid'];
                $data['author'] = $result['author'];
                $data['title'] = $result['title'];
                $data['type_id'] = $result['type_id'];
                $data['majory'] = $result['majory'];
                $data['content'] = $result['content'];
                $data['majory_id'] = $result['majory_id'];
                $data['time_step'] = $result['time_step'];
                if (isset($result['diary_book'])) {
                    $data['diary_book'] = $result['diary_book'];
                }
                //
                $termStart = $doc->termlist_begin();
                $termEnd   = $doc->termlist_end();
//                $data['term']='';
//                while (!($termStart->equals($termEnd))) {
//                    $data['term'].= '|'.$termStart->get_term();
//                    $termStart->next();
//                }
//                var_dump($data);
                //
                $re[] = $data;
                
            } elseif($index >= $page*$pagesize){
                break;
            }
            $start->next();
            $index++;
        }
        return array($re, $count, $word);
    }
    
    
    /**
     * 
     * @brief xapian query搜索 图片
     * @param array $params
     * @param int $page
     * @param int $pagesize
     */
    public static function searchImageByMajory($majory, $page = 1, $pagesize = 30) {
        $page = empty($page) ? 1 : $page; 
        if (!self::_connect()) return false;
        $flag = false;
        //切词 如果是日记本 作者不需要去除停用词
        
        $realQuery = array('MID' . $majory);
//        var_dump($realQuery);exit;
        $queryparser = new XapianQueryParser();
        $queryparser->set_database(self::$_INSTANCE);
        $enquire = new XapianEnquire(self::$_INSTANCE);
        $enquire->set_sort_by_value(0);//排序
        $query = new XapianQuery(XapianQuery::OP_AND, $realQuery);
        $enquire->set_query($query);
        $matches = $enquire->get_mset(0, 10000);//最多显示300条
        $start = $matches->begin();
        $end = $matches->end();
        $count = $matches->size();
        $index = 0;
        $re = array();
        while (!($start->equals($end))){
            $data = array();
            if ($index < $page*$pagesize && $index >= ($page-1)*$pagesize) {
                $doc = $start->get_document();
                $result = json_decode($doc->get_data(),true);
                $data['puid'] = $result['puid'];
                $data['author'] = $result['author'];
                $data['title'] = $result['title'];
                $data['majory'] = $result['majory'];
                $data['majory_id'] = $result['majory_id'];
                $data['time_step'] = $result['time_step'];
                $data['content'] = $result['content'];
                
                $re[] = $data;
            } elseif($index >= $page*$pagesize){
                break;
            }
            $start->next();
            $index++;
        }
        return array($re, $count);
    }
    
 /**
     * 
     * @brief xapian query搜索 图片
     * @param array $params
     * @param int $page
     * @param int $pagesize
     */
    public static function searchImageByName($name, $page = 1, $pagesize = 30) {
        $page = empty($page) ? 1 : $page; 
        if (!self::_connect()) return false;
        $flag = false;
        //切词 如果是日记本 作者不需要去除停用词
        
        $realQuery = array('NAME_ID' . $name);
//        var_dump($realQuery);exit;
        $queryparser = new XapianQueryParser();
        $queryparser->set_database(self::$_INSTANCE);
        $enquire = new XapianEnquire(self::$_INSTANCE);
        $enquire->set_sort_by_value(0);//排序
        $query = new XapianQuery(XapianQuery::OP_AND, $realQuery);
        $enquire->set_query($query);
        $matches = $enquire->get_mset(0, 10000);//最多显示300条
        $start = $matches->begin();
        $end = $matches->end();
        $count = $matches->size();
        $index = 0;
        $re = array();
        while (!($start->equals($end))){
            $data = array();
            if ($index < $page*$pagesize && $index >= ($page-1)*$pagesize) {
                $doc = $start->get_document();
                $result = json_decode($doc->get_data(),true);
                $data['puid'] = $result['puid'];
                $data['author'] = $result['author'];
                $data['title'] = $result['title'];
                $data['majory'] = $result['majory'];
                $data['majory_id'] = $result['majory_id'];
                $data['time_step'] = $result['time_step'];
                $data['content'] = $result['content'];
                
                $re[] = $data;
            } elseif($index >= $page*$pagesize){
                break;
            }
            $start->next();
            $index++;
        }
        return array($re, $count);
    }
    
    
/**
     * 
     * @brief xapian query
     * @param array $params
     * @param int $page
     * @param int $pagesize
     */
    public static function searchHospital($disease='',$province ='', $city='', $district='', $street='',$level=0, $keyword='', $page = '',$pagesize=20,$id='') {
        $page = empty($page) ? 1 : $page; 
        if (!self::_connect('/var/www/html/diary/xapian/hospital')) return false;
        
        //
        if ($keyword){
            $realQuery = DBScws::cutWord($keyword, true);
        }
        //
        if ($disease) {
            $realQuery[] = 'DISEASE' . $disease;
        }
        //
        if ($province) {
            $realQuery[] = 'PROVINCE' . $province;
        }
        //
        if ($city) {
            $realQuery[] = 'CITY' . $city;
        }
        //
        if ($district) {
            $realQuery[] = 'DISTRICT' . $district;
        }
        //
        if ($street) {
            $realQuery[] = 'STREET' . $street;
        }
        //
        if ($level) {
            $realQuery[] = 'LEVEL' . $level;
        }
        //id
        if ($id) {
            $realQuery[] = 'ID' . $id;
        }
        if (empty($realQuery)) {
            $realQuery[] = 'HOSPITAL'.'default';
        }
        
        $queryparser = new XapianQueryParser();
        $queryparser->set_database(self::$_INSTANCE);
        $enquire = new XapianEnquire(self::$_INSTANCE);
        $enquire->set_sort_by_value(0);//
        $query = new XapianQuery(XapianQuery::OP_AND, $realQuery);
        $enquire->set_query($query);
        $matches = $enquire->get_mset(0, 4000);//
        $start = $matches->begin();
        $end = $matches->end();
        $count = $matches->size();
        $index = 0;
        $re = array();
        while (!($start->equals($end))){
            $data = array();
            if ($index < $page*$pagesize && $index >= ($page-1)*$pagesize) {
                $doc = $start->get_document();
                $result = json_decode($doc->get_data(),true);
                $result['phone'] = $result['contact'];
                $r = explode("||", $result['title']);
                $result['title'] = $r[0];
                $r = explode(",", $result['contact']);
                $result['contact'] = $r[0];
                unset($result['puid'],$result['thumb_img'],$result['score'],$result['website'],
                      $result['post_at'],$result['refresh_at'],$result['grab_url'],$result['ad_status'],
                      $result['ad_types'],$result['user_id'],$result['username'],$result['listing_status'],
                      $result['base_tag'],$result['image_count']);
                $re[] = $result;
				
				/*
				$termStart = $doc->termlist_begin();
                $termEnd   = $doc->termlist_end();
                $d['term']='';
                while (!($termStart->equals($termEnd))) {
                    $d['term'].= '|'.$termStart->get_term();
                    $termStart->next();
                }
                var_dump($d);
				*/
				
            } elseif($index >= $page*$pagesize){
                break;
            }
            $start->next();
            $index++;
        }
        return array($re, $count);
    }
}
