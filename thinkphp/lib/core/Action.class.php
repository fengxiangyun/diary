<?php
class Action {
    
    protected $tVar        =  array(); // 模板输出变量
    // 视图实例对象
    protected $view   =  null;
    // 当前Action名称
    private $name =  '';
    
    public $cumtomParams = array();
    // 设置自定义参数，在入口调用
    
    public function setCustomParams($cumtomParams = array()) {
        $this->cumtomParams = $cumtomParams;
    }

   /**
     +----------------------------------------------------------
     * 架构函数 取得模板对象实例
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     */
    public function __construct() {
        //实例化视图类
        $this->view       = new View();
        //控制器初始化
    }

    public function init() {
    }

    /**
     +----------------------------------------------------------
     * 模板显示
     * 调用内置的模板引擎显示方法，
     +----------------------------------------------------------
     * @access protected
     +----------------------------------------------------------
     * @param string $templateFile 指定要调用的模板文件
     * 默认为空 由系统自动定位模板文件
     * @param string $charset 输出编码
     * @param string $contentType 输出类型
     +----------------------------------------------------------
     * @return void
     +----------------------------------------------------------
     */
    protected function display($templateFile='',$charset='',$contentType='') {
        $this->view->display($templateFile,$charset,$contentType, $this->tVar);
        exit;
    }

    /**
     +----------------------------------------------------------
     *  获取输出页面内容
     * 调用内置的模板引擎fetch方法，
     +----------------------------------------------------------
     * @access protected
     +----------------------------------------------------------
     * @param string $templateFile 指定要调用的模板文件
     * 默认为空 由系统自动定位模板文件
     +----------------------------------------------------------
     * @return string
     +----------------------------------------------------------
     */
    protected function fetch($templateFile='') {
        return $this->view->fetch($templateFile);
    }

    /**
     +----------------------------------------------------------
     *  创建静态页面
     +----------------------------------------------------------
     * @access protected
     +----------------------------------------------------------
     * @htmlfile 生成的静态文件名称
     * @htmlpath 生成的静态文件路径
     * @param string $templateFile 指定要调用的模板文件
     * 默认为空 由系统自动定位模板文件
     +----------------------------------------------------------
     * @return string
     +----------------------------------------------------------
     */
    protected function buildHtml($htmlfile='',$htmlpath='',$templateFile='') {
        $content = $this->fetch($templateFile);
        $htmlpath   = !empty($htmlpath)?$htmlpath:HTML_PATH;
        $htmlfile =  $htmlpath.$htmlfile.C('HTML_FILE_SUFFIX');
        if(!is_dir(dirname($htmlfile)))
            // 如果静态目录不存在 则创建
            mk_dir(dirname($htmlfile));
        if(false === file_put_contents($htmlfile,$content))
            throw_exception(L('_CACHE_WRITE_ERROR_').':'.$htmlfile);
        return $content;
    }

    /**
     +----------------------------------------------------------
     * 模板变量赋值
     +----------------------------------------------------------
     * @access protected
     +----------------------------------------------------------
     * @param mixed $name 要显示的模板变量
     * @param mixed $value 变量的值
     +----------------------------------------------------------
     * @return void
     +----------------------------------------------------------
     */
    public function assign($name,$value=''){
        if ($name == '' || empty($name)) {
            return false;
        }
        if(is_array($name)) {
            $this->tVar   =  array_merge($this->tVar,$name);
        }elseif(is_object($name)){
            foreach($name as $key =>$val)
                $this->tVar[$key] = $val;
        }else {
            $this->tVar[$name] = $value;
        }
    }

    public function __set($name,$value) {
        $this->assign($name,$value);
    }
     /**
     +----------------------------------------------------------
     * 取得模板变量的值
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param string $name
     +----------------------------------------------------------
     * @return mixed
     +----------------------------------------------------------
     */
    

    /* 取得所有模板变量 */
    public function getAllVar(){
        return $this->tVar;
    }
    
    public function get($name){
        if(isset($this->tVar[$name]))
            return $this->tVar[$name];
        else
            return false;
    }
    /**
     +----------------------------------------------------------
     * 取得模板显示变量的值
     +----------------------------------------------------------
     * @access protected
     +----------------------------------------------------------
     * @param string $name 模板显示变量
     +----------------------------------------------------------
     * @return mixed
     +----------------------------------------------------------
     */
    public function __get($name) {
        return $this->get($name);
    }

    /**
     +----------------------------------------------------------
     * 魔术方法 有不存在的操作的时候执行
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param string $method 方法名
     * @param array $args 参数
     +----------------------------------------------------------
     * @return mixed
     +----------------------------------------------------------
     */
    public function __call($method,$args) {
        if( 0 === strcasecmp($method,ACTION_NAME)) {
            if(method_exists($this,'_empty')) {
                // 如果定义了_empty操作 则调用
                $this->_empty($method,$args);
            }elseif(file_exists_case(C('TEMPLATE_NAME'))){//test
                // 检查是否存在默认模版 如果有直接输出模版
                $this->display();
            }elseif(function_exists('__hack_action')) {
                // hack 方式定义扩展操作
                __hack_action();
            }elseif(APP_DEBUG) {
                // 抛出异常
                throw_exception(L('_ERROR_ACTION_').ACTION_NAME);
            }else{
                if(C('LOG_EXCEPTION_RECORD')) Log::write(L('_ERROR_ACTION_').ACTION_NAME);
                send_http_status(404);
                exit;
            }
        }else{
            switch(strtolower($method)) {
                // 判断提交方式
                case 'ispost':
                case 'isget':
                case 'ishead':
                case 'isdelete':
                case 'isput':
                    return strtolower($_SERVER['REQUEST_METHOD']) == strtolower(substr($method,2));
                // 获取变量 支持过滤和默认值 调用方式 $this->_post($key,$filter,$default);
                case '_get':      $input =& $_GET;break;
                case '_post':$input =& $_POST;break;
                case '_put': parse_str(file_get_contents('php://input'), $input);break;
                case '_request': $input =& $_REQUEST;break;
                case '_session': $input =& $_SESSION;break;
                case '_cookie':  $input =& $_COOKIE;break;
                case '_server':  $input =& $_SERVER;break;
                case '_globals':  $input =& $GLOBALS;break;
                default:
                    throw_exception(__CLASS__.':'.$method.L('_METHOD_NOT_EXIST_'));
            }
            if(isset($input[$args[0]])) { // 取值操作
                $data	 =	 $input[$args[0]];
                $fun  =  $args[1]?$args[1]:C('DEFAULT_FILTER');
                $data	 =	 $fun($data); // 参数过滤
            }else{ // 变量默认值
                $data	 =	 isset($args[2])?$args[2]:NULL;
            }
            return $data;
        }
    }

   /**
     +----------------------------------------------------------
     * 析构方法
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     */
    public function __destruct() {
      
    }
}