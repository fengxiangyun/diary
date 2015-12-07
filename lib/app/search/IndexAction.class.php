<?php
require_once APP . '/common/CommonAction.class.php';
require_once THINKPHP . '/app/common/CommonNamespace.class.php';
require_once THINKPHP . '/lib/db/DBXapian.class.php';
require_once THINKPHP . '/app/user/UserNamespace.class.php';
require_once THINKPHP . '/app/diary/DiaryBookNamespace.class.php';

class IndexAction extends CommonAction{
    public static $PAGE_SIZE = 45;
    public $typeId = null;
    public $type = null;
    public $cutWord = null;
    public $orgWord = null;
    public $params  = null;
    
    public function init() {
        $this->assign('css', array(
            'category/common.css',
            'footer.css'
        ));

        parent::init();
        if (isset(self::$REQUEST['type']) && self::$REQUEST['type'] >= 1) {
            self::$CATEGORY = CategoryNamespace::getCategoryById(self::$REQUEST['type']);
            $this->assign('category', self::$CATEGORY);
        }
    }
    public function defaultAction() {
        $result['image'] = true;
        $result['top_image'] = IndexPageConfig::$IMAGE_TOP;
        $this->orgWord = HttpNamespace::getGET('kw');
        $this->typeId    = HttpNamespace::getGET('type');
        $this->params['query'] = $this->orgWord;
        //搜索作者
        if ($this->typeId == 'author') {
            $this->params['author'] = true;
        //通过uid搜索作者
        } elseif (strtolower($this->typeId) == 'uid') {
            $user = UserNamespace::getUserById($this->orgWord);
            if ($user) {
                 $this->params['uid'] = true;
                 $this->params['username'] = $user['nick_name'];
                 $this->orgWord = $this->params['username'];
            }
        //搜索日记本通过id
        } elseif(strtolower($this->typeId) == 'bookid') {
            $this->params['bookid'] = true;
            $book = DiaryBookNamespace::getUserById($this->orgWord);
            if ($book) {
                $this->params['diarybook'] = $book['book_name'];
                $this->orgWord = $this->params['diarybook'];
            }
        //搜索日记本通过kw
        } elseif(strtolower($this->typeId) == 'bookname') {
            $this->params['bookname'] = true;
        //搜索个关键词
        } else {
            $this->typeId = (int) $this->typeId;
            $pa = CategoryNamespace::getById($this->typeId);
            $this->type = $pa['type'];
            $this->params[$pa['type']] = $pa;
            
        }
        
        $page = HttpNamespace::getGET('p');
        list($result['article'], $result['count'], $this->cutWord) = DBXapian::searchByQuery($this->params, $page, self::$PAGE_SIZE);
        $result['cutword'] = $this->createUrlByWord($this->cutWord);
        $result['kw'] = $this->orgWord;
        $result['title'] = $this->orgWord;
        $result['type_id'] = $this->typeId;
        $result['page']    = $this->_showPage($result['count']);
        $this->assign($result);
        $this->display();
    }
    
    private function _showPage($count) {
        $page = new Page($count, self::$PAGE_SIZE);
        return $page->show();
    }
    public function createUrlByWord($word) {
        $re = array();
        if (is_numeric($this->typeId) && $this->typeId != 0) {
            $re[] = array('word' => $this->params[$this->type]['name'] . '类','url' => UrlNamespace::searchUrl($this->orgWord));
        } elseif($this->typeId === 'author') {
            $re[] = array('word' => '作者','url' => UrlNamespace::searchUrl($this->orgWord));
        } elseif (strtolower($this->typeId) == 'uid') {
            $this->typeId = 'author';
            $w = '';
            foreach (DBScws::cutWord($this->params['username']) as $v) {
                $w .= $v;
            }
            $re[] = array('word' => $this->params['username'],'url' => UrlNamespace::searchUrl());
            return $re;
        } elseif (strtolower($this->typeId) == 'bookid') {
            $this->typeId = 'bookname';
            $w = '';
            foreach (DBScws::cutWord($this->params['diarybook']) as $v) {
                $w .= $v;
            }
            $re[] = array('word' => $this->params['diarybook'],'url' => UrlNamespace::searchUrl());
            return $re;
        } elseif($this->typeId === 'bookname') {
            $re[] = array('word' => '日记本','url' => UrlNamespace::searchUrl($this->orgWord));
        }
        foreach ($word as $value) {
            $w = '';
            foreach ($this->cutWord as $v) {
                if ($value != $v) {
                    $w .= $v;
                }
            }
            $re[] = array('word' => $value, 'url' => UrlNamespace::searchUrl($w, $this->typeId));
        }
        return $re;
    }
}
