<?php
class DBConfig {
     
    public static $MYSQL_MASTER_SERVER = array(
        'host'     => 'localhost',
        'username' => 'root',
        'database' => 'diary',
        'password' => 'root',
        'port'     => 3306,
    );
    public static $MYSQL_SLAVER_SERVER = array(
        'host'     => '127.0.0.1',
        'username' => 'root',
        'database' => 'diary',
        'password' => 'root',
        'port'     => 3306,
    );
    
    public static $REDIS = array(
        'host' => '127.0.0.1',
        'port' => 6379,
    );
    
    public static $XAPIAN = array(
        'database' => '/home/wwwroot/default/diary/xapian/diary',
    );
    
    public static $SCWS = array(
        'rule' => '/home/wwwroot/default/diary/xapian/dict/rules_cht.utf8.ini',
        'default_dict' => '/home/wwwroot/default/diary/xapian/dict/dict.utf8.xdb',
        'my_dict' => '/home/wwwroot/default/diary/xapian/dict/zzq.txt',
    );
}
