<?php
require_once THINKPHP . '/lib/word/WordCorrection.class.php';

class DBScws {
    private static $_SCWS      = NULL;//切词服务
    
    private static function _init() {
        if (!self::$_SCWS) {
            self::$_SCWS = scws_new();
            if (!self::$_SCWS) {
                return false;
            }
            self::$_SCWS->set_charset('utf8');
            self::$_SCWS->set_rule(DBConfig::$SCWS['rule']);//设置配置文件utf8
            self::$_SCWS->set_ignore(true);//忽略标点
            //字典 默认 自定义 txt类型
            self::$_SCWS->set_dict(DBConfig::$SCWS['default_dict']);
            self::$_SCWS->add_dict(DBConfig::$SCWS['my_dict'], SCWS_XDICT_TXT);
        }
        return true;
    }
    /**
     * @brief 切词
     * @param string $word
     * @param boolen $stopWord 是否舍去停用词 默认舍去 false
     */
    public static function cutWord($word, $stopWord = false) {
        if (!self::_init()) return false;
        
        $cutQuery = array();
        self::$_SCWS->send_text($word);//
        while ($tmp = self::$_SCWS->get_result()) {
            foreach ($tmp as $v) {
                if (!$stopWord) {
                    if (self::_isUseful($v['word'])) {
                        if (!in_array($v['word'], $cutQuery)) {
                            $cutQuery[] = strtolower($v['word']);
                        }
                    }
                } else {
                    if (!in_array($v['word'], $cutQuery)) {
                        $cutQuery[] = strtolower($v['word']);
                    }
                }
            }
        }
        return $cutQuery;
    }
    
    /**
     * @brief 是否是停用词
     * @param string $word
     */
    private static function  _isUseful($word) {
        if(WordCorrection::isStopWord($word)) {
            return false;
        }
        return true;
    }
}