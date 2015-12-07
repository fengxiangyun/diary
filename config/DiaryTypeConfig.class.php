<?php
class DiaryTypeConfig{
    public static $TYPE = array(
        
           array(
            'table'    => '',
            'name'     => '医疗',
            'url'  => 'http://datougou.cn/diary/index.php/medical/hospital/',
            'id' => 10000,
            'show' => false,
        ),
        array(
            'table'    => 'image_featured',
            'name'     => '美图',
            'id' => 400,
            'show' => true,
            'majory' => array(
                array(
                    'name' => '青春',
                    'id'   => 4501,
                ),
                array(
                    'name' => '生活',
                    'id'   => 4502,
                ),
                array(
                    'name' => '旅行',
                    'id'   => 4503,
                ),
                array(
                    'name' => '美食',
                    'id'   => 4504,
                ),
                array(
                    'name' => '动漫',
                    'id'   => 4505,
                ),
                array(
                    'name' => '萌宠',
                    'id'   => 4506,
                ),
            ),
        ),
        array(
            'table'    => 'article_xiaoshuo',
            'name'     => '小说',
            'id' => 300,
            'show' => false,
            'majory' => array(
                array(
                    'name'   => '都市',
                    'id' => 3001,
                ),
                array(
                    'name'   => '历史',
                    'id' => 3002,
                ),
            ),
        ),
        array(
            'table'    => 'article_weixiaoshuo',
            'name'     => '微小说',
            'id' => 200,
            'show' => false,
            'majory' => array(
                array(
                    'name'   => '情感',
                    'id' => 2001,
                ),
            ),
        ),
        array(
            'table' => 'article_rizhi',
            'name' => '日志',
            'show' => true,
            'id'   => 10,
            'majory' => array(
                array(
                    'name' => '苦涩',
                    'id'   => 101,
                ),
                array(
                    'name' => '深情',
                    'id'   => 102,
                ),
                array(
                    'name' => '感伤',
                    'id'   => 103,
                ),
                array(
                    'name' => '闲逸',
                    'id'   => 104,
                ),
                array(
                    'name' => '柔情',
                    'id'   => 105,
                ),
                array(
                    'name' => '甜蜜',
                    'id'   => 106,
                ),
                array(
                    'name' => '无奈',
                    'id'   => 107,
                ),
                array(
                    'name' => '开心',
                    'id'   => 108,
                ),
                array(
                    'name' => '沧桑',
                    'id'   => 109,
                ),
                array(
                    'name' => '感悟',
                    'id'   => 110,
                ),
                array(
                    'name' => '激励',
                    'id'   => 111,
                ),
                array(
                    'name' => '分享',
                    'id'   => 112,
                ),
                array(
                    'name' => '随感',
                    'id'   => 113,
                ),
                array(
                    'name' => '其他',
                    'id'   => 114,
                ), 
            )
        ),
       
        array(
            'table'    => 'article_diarybook',
            'name'     => '日记',
            'id' => 20,
            'show'  => true,
            'majory' => array(
                array(
                    'name'   => '爱情',
                    'id' => 201,
                ), 
                array(
                    'name'   => '旅途',
                    'id' => 202,
                ), 
                array(
                    'name'   => '职场',
                    'id' => 203,
                ), 
                array(
                    'name'   => '校园',
                    'id' => 204,
                ), 
                array(
                    'name'   => '宝宝',
                    'id' => 205,
                ), 
                array(
                    'name'   => '围城',
                    'id' => 206,
                ), 
            ),
        ),
        
        //
        array(
            'name' => '散文',
            'id' => 21,
            'show'  => true,
            'table'    => 'article_sanwen',
            'majory' => array(
                array(
                    'name' => '随笔',
                    'id'   => 211,
                ),
                array(
                    'name' => '优美',
                    'id'   => 212,
                ),
                array(
                    'name' => '抒情',
                    'id'   => 213
                ),
                array(
                    'name' => '爱情',
                    'id'   => 214
                ),
                array(
                    'name' => '经典',
                    'id'   => 215
                ),
                array(
                    'name' => '伤感',
                    'id'   => 216
                ),
                array(
                    'name' => '情感',
                    'id'   => 217
                ),
                array(
                    'name' => '人生感悟',
                    'id'   => 218
                ),
            ),
        ),
        array(
            'name'  => '句子',
            'id' => 25,
            'show'  => true,
            'table' => 'article_juzi',
            'majory' => array(
                array(
                    'name' => '语录',
                    'id'   => 251,
                ),
                array(
                    'name' => '爱情',
                    'id'   => 252,
                ),
                array(
                    'name' => '伤感',
                    'id'   => 253
                ),
                array(
                    'name' => '优美',
                    'id'   => 254
                ),
                array(
                    'name' => '哲理',
                    'id'   => 255
                ),
                array(
                    'name' => '搞笑',
                    'id'   => 256
                ),
            ),
        ),
        array(
            'name'  => '诗歌',
            'id' => 22,
            'table' => 'article_shige',
            'show'  => true,
            'majory' => array(
                array(
                    'name' => '散文诗',
                    'id'   => 221,
                ),
                array(
                    'name' => '现代',
                    'id'   => 222,
                ),
                array(
                    'name' => '爱情',
                    'id'   => 223
                ),
                 array(
                    'name' => '爱国',
                    'id'   => 224
                ),
                 array(
                    'name' => '格律诗',
                    'id'   => 225
                ),
                 array(
                    'name' => '大全',
                    'id'   => 226
                ),
            ),
        ),
        array(
            'name'  => '开发',
            'id' => 100,
            'show'  => false,
            'table' => 'article_jishu',
            'majory' => array(
                array(
                    'name' => 'php',
                    'id'   => 1001,
                ),
                array(
                    'name' => 'xapian',
                    'id'   => 1002,
                ),
                array(
                    'name' => 'mysql',
                    'id'   => 1003
                ),
                array(
                    'name' => '其他',
                    'id'   => 1004
                ),
            ),
        ),
    );
}
