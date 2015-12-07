<?php
class Weinin {
    
    private static $_TOKEN = 'zhaoxiaozhi123';
    public $MsgType = null;
    public $msg = null;
    public $article = null;
    public $title = null;
    public $url = null;
    public function __construct() {
//        echo  $_GET["echostr"];exit;
        if ($this->_checkSignature()) {
            $this->_getMsg();
            $this->_returnMsg();
        } else {
            
        }
    }
    
    
    private function _getMsg() {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        if (!empty($postStr)) {
            $this->msg = (array)simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $this->MsgType = strtolower($this->msg['MsgType']);
        }
    }
    
    /**
     * @brief 签名认证
     */
    private function _checkSignature(){
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];	
        $tmpArr = array(self::$_TOKEN, $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );
        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }
    
    private function _returnMsg() {
        $flag = true;
        if ($this->MsgType == 'text') {
            $id = $this->msg['Content'];
            $cateogory = CategoryNamespace::getCategoryById($id);
            
            $majory    = CategoryNamespace::getMajoryById($id);
            if ($cateogory) {
                //
                if ($cateogory['id'] == 400){
                    
                }
                $this->article = CommonNamespace::getNewArticle($cateogory['id'], null, 8);
               
                $this->title = $cateogory['name'];
                $this->url = 'http://datougou.cn/diary/index.php/category/?category='.$cateogory['id'];
            } elseif ($majory){
                $this->article = CommonNamespace::getNewArticle($majory['parent']['id'], $majory['id'], 8);
                $this->title = $majory['parent']['name'] . ' - ' . $majory['name'];
                $this->url = 'http://datougou.cn/diary/index.php/majory/?majory='.$majory['id'];
            } else {
                $flag = false;
            }
        } elseif($this->MsgType == 'event' && strtolower($this->msg['Event']) == 'subscribe') {
            //$this->article = IndexPageConfig::$TOP_ARTICLE;
            $this->title = '欢迎关注大头狗日记散文小站';
            $this->url = 'http://datougou.cn';
        }
        if ($flag) {
            $content = $this->_makeNews();
        } else {
            $content = $this->makeText();
        }
        //$content = $this->_makeNews();
        file_put_contents(dirname(__FILE__).'/test.txt', $GLOBALS["HTTP_RAW_POST_DATA"]."\r\n", FILE_APPEND);
        echo $content;
        exit;
    }
    
    private function _makeNews() {
        $CreateTime = time();
        $newTplHeader = "<xml>
            <ToUserName><![CDATA[{$this->msg['FromUserName']}]]></ToUserName>
            <FromUserName><![CDATA[{$this->msg['ToUserName']}]]></FromUserName>
            <CreateTime>{$CreateTime}</CreateTime>
            <MsgType><![CDATA[news]]></MsgType>
            <ArticleCount>%s</ArticleCount><Articles>";
        $newTplItem = "<item>
            <Title><![CDATA[%s]]></Title>
            <Url><![CDATA[%s]]></Url>
            </item>";
        $newTplFoot = "</Articles>
            </xml>";
        $Co = "<item>
            <Title><![CDATA[%s]]></Title> 
<PicUrl><![CDATA[%s]]></PicUrl>
<Url><![CDATA[%s]]></Url>
            </item>";
        $Content = '';
       
        $Content .= sprintf($Co ,$this->title ,'http://datougou.cn/diary/Public/image/test.jpg?t=1',$this->url);
        if($this->MsgType == 'event' && strtolower($this->msg['Event']) == 'subscribe') {
            $Content .= "<item>
            <Title><![CDATA[回复 h 查看更多信息]]></Title> 
            </item>";
        }
        $itemsCount = count($this->article)+2;
        $itemsCount = $itemsCount < 10 ? $itemsCount : 10;//微信公众平台图文回复的消息一次最多10条
        if ($itemsCount) {
            foreach ($this->article as $key => $item) {
                $url = 'http://datougou.cn/diary/index.php/detail/?majory='.$item['majory_id'].'&puid='.$item['puid'];
                $Content .= sprintf($newTplItem,$item['title'],$url);
            }
        }
        $Content .="<item>
            <Title><![CDATA[查看更多此类文章   >>]]></Title> 
<Url><![CDATA[{$this->url}]]></Url>
            </item>";
        $header = sprintf($newTplHeader,$itemsCount);
        return $header . $Content . $newTplFoot;
    }
    
    
     public function makeText($text='') {
        $CreateTime = time();
        $textTpl = "<xml>
            <ToUserName><![CDATA[{$this->msg['FromUserName']}]]></ToUserName>
            <FromUserName><![CDATA[{$this->msg['ToUserName']}]]></FromUserName>
            <CreateTime>{$CreateTime}</CreateTime>
            <MsgType><![CDATA[text]]></MsgType>
            <Content><![CDATA[%s]]></Content>
            </xml>";
        if (empty($text)) {
            $text = "欢迎访问大头狗日记小站\n请回复序号查看信息\n";
            foreach (DiaryTypeConfig::$TYPE as $key => $value) {
                $text .= $value['id'].':'.$value['name']."\n";
                if ($this->msg['Content'] == '000') {
                    foreach ($value['majory'] as $k=>$v){
                        $text .= $v['id'].':'.$value['name'].' - '.$v['name']."\n";
                    }
                }
            }
            if ($this->msg['Content'] != '000') {
                $text .= "000:更多\n";
            }
        }
        return sprintf($textTpl,$text);
    }
}
