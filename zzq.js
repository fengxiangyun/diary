/**
 * Ganji UI Library基础模块.
 * 使用全局变量GJ作为命名空间，用以包装最基础的应用.
 * @module ganji
 * @file js/util/ganji/ganji.js
 * @author lwg_8088@yahoo.com.cn
 * @version 2010-01-05
 */


var GJ = window.GJ || {},
    __GJ_CONFIG__ = window.__GJ_CONFIG__ || {};

(function (){
    var win = window, doc = win.document;
    if (win.__GJ_LOADED__){
        return;
    }
    win.__GJ_LOADED__ = true;

    /**
     * 配置变量.
     * 包括：
     * <ul>
     *     <li><strong>debug</strong> &nbsp; &nbsp; 是否调试。如果为true将使用未压缩、未合并的文件。</li>
     *     <li><strong>rootDir</strong> &nbsp; &nbsp; 根目录。当debug为true时是'src/'，否则为'public/'</li>
     *     <li><strong>addVersion</strong> &nbsp; &nbsp; 是否添加版本号。</li>
     *     <li><strong>useCombine</strong> &nbsp; &nbsp; 是否使用合并文件。</li>
     *     <li><strong>cookieDomain</strong> &nbsp; &nbsp; 保存cookie时的域，默认为'ganji.com'。</li>
     *     <li><strong>iframeProxyUrl</strong> &nbsp; &nbsp; 使用跨域iframe时的代理文件，默认为'/iframeproxy.html'。该文件要放在父窗口同域的根目录下。</li>
     *     <li><strong>defaultServer</strong> &nbsp; &nbsp; 静态文件服务默认域名。默认值'sat.ganji.com'</li>
     *     <li><strong>servers</strong> &nbsp; &nbsp; 静态文件服务其他域名。</li>
     *     <li><strong>fileVersions</strong> &nbsp; &nbsp; 文件版本号信息。</li>
     *     <li><strong>fileCombines</strong> &nbsp; &nbsp; 合并文件对应信息。</li>
     *     <li><strong>fileCodes</strong> &nbsp; &nbsp; 文件或文件组代号。</li>
     * </ul>
     * @property GJ.config
     * @static
     * @type object
     */
    GJ.config = {
        debug : false,
        rootDir : '', //debug == true ? 'src/' : 'public/'
        addVersion : false,
        useCombine : false, //debug为true时只能是false
        cookieDomain : 'ganji.com',
        documentDomain : 'ganji.com',
        iframeProxyUrl : '/iframeproxy.html',  //跨域iframe调用时的代理文件，必须放在当前域下
        defaultServer : 'http://localhost',
        servers : ["sta.ganjistatic1.com"],
        fileVersions : {},
        fileCombines : {},
        fileCodes    : {
            jquery         : "js/util/jquery/jquery-1.7.2.js",
            log_tracker    : "js/util/log_tracker/log_tracker_simple.js"
        }
    };

    //数据类型判断
    (function(){
        var TYPES = {
            'undefined'         : 'undefined',
            'number'            : 'number',
            'boolean'           : 'boolean',
            'string'            : 'string',
            '[object Function]' : 'function',
            '[object RegExp]'   : 'regexp',
            '[object Array]'    : 'array',
            '[object Date]'     : 'date',
            '[object Error]'    : 'error'
        },
        L = {
            /**
             * 判断一个变量是不是数组.
             * @method GJ.isArray
             * @static
             * @param o 用来测试的变量
             * @return {boolean} 如果是数组返回true
             */
            isArray : function(o){
                return L.typeOf(o) === 'array';
            },

            /**
             * 判断一个变量是不是布尔值.
             * @method GJ.isBoolean
             * @static
             * @param o 用来测试的变量
             * @return {boolean} 如果是布尔值返回true
             */
            isBoolean : function(o){
                return typeof o === 'boolean';
            },

            /**
             * 判断一个变量是不是函数.
             * @method GJ.isFunction
             * @static
             * @param o 用来测试的变量
             * @return {boolean} 如果是函数返回true
             */
            isFunction : function(o){
                return L.typeOf(o) === 'function';
            },

            /**
             * 判断一个变量是不是日期.
             * @method GJ.isDate
             * @static
             * @param o 用来测试的变量
             * @return {boolean} 如果是日期返回true
             */
            isDate : function(o){
                return L.typeOf(o) === 'date';
            },

            /**
             * 判断一个变量是不是null.
             * @method GJ.isNull
             * @static
             * @param o 用来测试的变量
             * @return {boolean} 如果是null返回true
             */
            isNull : function(o){
                return o === null;
            },

            /**
             * 判断一个变量是不是数字.
             * @method GJ.isNumber
             * @static
             * @param o 用来测试的变量
             * @return {boolean} 如果是数字返回true
             */
            isNumber : function(o){
                return typeof o === 'number' && isFinite(o);
            },

            /**
             * 判断一个变量是不是对象.
             * @method GJ.isObject
             * @static
             * @param o 用来测试的变量
             * @param failfn {boolean} 如果设为true，则函数不算作对象。默认值：false
             * @return {boolean} 如果是对象返回true
             */
            isObject : function(o, failfn){
                return (o && (typeof o === 'object' || (!failfn && L.isFunction(o)))) || false;
            },

            /**
             * 判断一个变量是不是字符串.
             * @method GJ.isString
             * @static
             * @param o 用来测试的变量
             * @return {boolean} 如果是字符串返回true
             */
            isString : function(o){
                return typeof o === 'string';
            },

            /**
             * 判断一个变量是不是未定义。
             * 只能判断一个对象的元素，不能是单独的变量，如:
             * if (GJ.isUndefined(window.name)){
             *     ...
             * }
             * @method GJ.isUndefined
             * @static
             * @param o 用来测试的变量
             * @return {boolean} 如果是未定义返回true
             */
            isUndefined : function(o){
                return typeof o === 'undefined';
            },

            /**
             * 判断一个变量是否不是null/undefined/NaN.
             * @method GJ.isValue
             * @static
             * @param o 用来测试的变量
             * @return {boolean} 如果不是null/undefined/NaN返回true
             */
            isValue : function(o){
                var t = L.typeOf(o);
                switch (t){
                    case 'number':
                        return isFinite(o);
                    case 'null':
                    case 'undefined':
                        return false;
                    default:
                        return !!(t);
                }
            },

            /**
             * 检测一个变量的类型.
             * @method GJ.typeOf
             * @static
             * @param o 用来检测的变量
             * @return {string} 返回变量的类型
             */
            typeOf : function (o){
                return  TYPES[typeof o] || TYPES[Object.prototype.toString.call(o)] || (o ? 'object' : 'null');
            }
        };

        /**
         * 合并两个对象。
         * 将参数supplies对象的元素合并到参数receive对象中
         * @method GJ.mix
         * @static
         * @param {object} receive 源对象
         * @param {object} supplies 用来合并到receive中的对象
         * @param {boolean} overwritten 如果设为true，supplies中的元素将替换receive中的同名元素，默认值为false
         * @param {boolean} recursion 是否递归，默认值为false
         * @return {object} 返回receive对象的引用
         */
        GJ.mix = function (r, s, ov, rec)
        {
            if (L.isObject(r) && L.isObject(s)){
                for (var i in s){
                    if (s.hasOwnProperty(i)) {
                        if (!(i in r)) {
                            r[i] = s[i];
                        } else if (ov) {
                            if (rec && L.isObject(r[i], true) && L.isObject(s[i], true)) {
                                GJ.mix(r[i], s[i], ov, rec);
                            } else {
                                r[i] = s[i];
                            }
                        }
                    }
                }
            }
            return r;
        };

        GJ.mix(GJ, L, true);
    })();

    /**
     * 遍历对象或数组，对每个元素应用回调函数。
     * @method GJ.each
     * @static
     * @param {object|array} o 要遍历的对象或数组
     * @param {Function} callback 回调函数。将为此函数设置两个参数：val元素值，key元素下标。
     * 在函数内部使用return false可以终止遁环
     */
    GJ.each = function(o, cb){
        if (GJ.isFunction(cb)){
            var i, n, r;
            if (GJ.isArray(o)){
                for (i=0, n=o.length; i<n; i++){
                    r = cb(o[i], i);
                    if (r === false) break;
                }
            }
            else if (GJ.isObject(o)){
                for (i in o){
                    if (o.hasOwnProperty(i)){
                        r = cb(o[i], i);
                        if (r === false) break;
                    }
                }
            }
        }
    };
    GJ.map = function (arr, cb) {
        var ret = [];
        GJ.each(arr, function (v, i) {
            ret.push(cb(v, i));
        });
        return ret;
    }
    GJ.inArray = function (v, arr) {
        var index = -1;
        GJ.each(arr, function (a, i) {
            if (a === v) {
                index = i;
                return false;
            }
        });
        return index;
    }

    /**
     * 取得从from(含from)到to(含to)的整数随机数。
     * @method GJ.rand
     * @static
     * @param {int} from 起始数字
     * @param {int} to 结束数字
     * @return {int} 返回生成的随机数
     */
    GJ.rand = function (from, to)
    {
        return parseInt(Math.random() * (to - from + 1) + from);
    };

    (function(){
        var guid_counter = 0;
        /**
         * 取得一个不重复的随机字符串
         * @method GJ.guid
         * @static
         * @param {string} pre 前缀 默认为"guid_"
         * @return {string}
         */
        GJ.guid = function(pre)
        {
            var r = new Date().getTime() + '' + Math.random();
            return (pre ? pre : 'guid_') + guid_counter++ + '_' + r.replace(/\./g, '_');
        }

        var cacheData = {};
        /**
         * 根据id号取得缓存对象
         * @method GJ.getCache
         * @static
         * @param {string} id 关联缓存对象的id号
         * @return {object}
         */
        GJ.getCache = function (id)
        {
            return !GJ.isUndefined(cacheData[id]) ? cacheData[id] : null;
        };
        /**
         * 将一个局部变量存入缓存，以便通过GJ.getCache(id)获取
         * 有两种用法：<br />
         * 1、直接将变量存入缓存，并返回id号。如：var id = GJ.setCache(val);<br />
         * 2、将变量存入缓存的同时，指定id号。如：GJ.setCache(id, val);
         * @method GJ.setCache
         * @static
         * @param {string} id 关联缓存对象的id号
         * @param {object} data 要存储的变量
         * @return {string} 返回关联缓存对象的id号
         */
        GJ.setCache = function (id, data)
        {
            if (arguments.length == 1){
                data = id;
                id = GJ.guid();
            }
            cacheData[id] = data;
            return id;
        };
        /**
         * 根据id号移除缓存对象
         * @method GJ.removeCache
         * @static
         * @param {string} id 关联缓存对象的id号
         * @return {void}
         */
        GJ.removeCache = function (id)
        {
            if (!GJ.isUndefined(cacheData[id])){
                delete cacheData[id];
            }
        };
        /**
         * 清空缓存数据
         * @method GJ.clearCache
         * @static
         * @return {void}
         */
        GJ.clearCache = function ()
        {
            cacheData = {};
        };
    })();

    /**
     * 根据cookie名称取得cookie值
     * @method GJ.getCookie
     * @static
     * @param {string} name cookie名称
     * @return {string}
     */
    GJ.getCookie = function(name)
    {
        var doc=document, val = null, regVal;

        if (doc.cookie){
            regVal = doc.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));
            if(regVal != null){
                val = decodeURIComponent(regVal[2]);
            }
        }

        return val;
    };

    /**
     * 设置cookie
     * @method GJ.setCookie
     * @static
     * @param {string} name cookie名称
     * @param {string} value cookie值
     * @param {int} expire 过期时间(秒)，默认为零
     * @param {string} path 路径，默认为空
     * @param {string} domain 域
     * @return {boolean} 设置成功返回true
     */
    GJ.setCookie = function(name, value, expire, path, domain, s)
    {
        if (GJ.isUndefined(document.cookie)){
            return false;
        }

        expire = !GJ.isNumber(expire) ? 0 : parseInt(expire);
        if (expire < 0){
            value = '';
        }

        var dt = new Date();
        dt.setTime(dt.getTime() + 1000 * expire);

        document.cookie = name + "=" + encodeURIComponent(value) +
            ((expire) ? "; expires=" + dt.toGMTString() : "") +
            "; path=" + (path || '/') +
            "; domain=" + (domain || GJ.config.cookieDomain) +
            ((s) ? "; secure" : "");

        return true;
    };

    /**
     * 移除cookie
     * @method GJ.removeCookie
     * @static
     * @param {string} name cookie名称
     * @param {string} path 路径，默认为空
     * @param {string} domain 域
     * @return {boolean} 移除成功返回true
     */
    GJ.removeCookie = function(name, path, domain)
    {
        return GJ.setCookie(name, '', -1, path, domain);
    };

    /**
     * 抛出错误提示
     * @method GJ.error
     * @static
     * @param {string} msg 提示信息
     * @return {void}
     */
    GJ.error = function(msg)
    {
        throw new Error(msg);
    };

    /**
     * 通过firebug显示调试信息
     * @method GJ.log
     * @static
     * @param {object} data 要调试的数据
     * @return {void}
     */
    GJ.log = function(data)
    {
        //if (GJ.isFunction(GJ.jsonEncode)){
        //    data = GJ.jsonEncode(data, '    ');
        //}

        if (typeof console != 'undefined' && console.log){
            console.log(data);
        }
        else if (typeof opera != 'undefined'){
            opera.postError(data);
        }
    };

    /**
     * 延迟定时执行回调函数
     * 是对setTimeout()和setInterval()的包装
     * @method GJ.later
     * @static
     * @param {Function} fn 回调函数
     * @param {int} when 延迟毫秒数
     * @param {boolean} loop 是否循环。默认为false
     * @return {object} 返回一个对象，通过此对象的cancel()方法，可以取消定时器
     * @example
     * <script type="text/javascript">
     * var i = 0, timer;
     * timer = GJ.later(function(){
     *     alert(i);
     *     i++;
     *     if (i == 10) timer.cancel();
     * }, 2000, true);
     * </script>
     */
    GJ.later = function(fn, when, loop)
    {
        when = when || 0;
        var r = null,
            run = function(){
                r = r || (loop) ? setInterval(fn, when) : setTimeout(fn, when);
            };
        run();

        return {
            run : run,
            cancel: function(){
                if (r){
                    if (loop){
                        clearInterval(r);
                    } else {
                        clearTimeout(r);
                    }
                    r = null;
                }
            }
        };
    };

    /**
     * 为元素绑定事件
     * @event GJ.addEvent
     * @static
     * @param {object} el 要绑定事件的网页元素
     * @param {string} type 事件类型名称，如click
     * @param {Function} func 要绑定的事件函数
     * @return {void}
     */
    GJ.addEvent = function(el, type, fn){
        if (el.addEventListener){
            el.addEventListener(type, fn, false);
        }
        else if (el.attachEvent){
            el.attachEvent("on" + type, fn);
        }
    };

    /**
     * 为元素移除事件绑定
     * @event GJ.removeEvent
     * @static
     * @param {object} el 要移除事件绑定的网页元素
     * @param {string} type 事件类型名称，如click
     * @param {Function} func 要移除的事件函数
     * @return {void}
     */
    GJ.removeEvent = function(el, type, fn){
        if (el.removeEventListener){
            el.removeEventListener(type, fn, false);
        }
        else if (el.detachEvent){
            el.detachEvent("on" + type, fn);
        }
    };

    (function(){
        var win=window,
            doc=document,
            domIsReady = false,
            domReadyQueue = [],
            readyState,
            isRunning = false,
            dom_onReady = function (){
                if (isRunning) return;
                isRunning = true;
                dom_onReady = Function.prototype;
                domIsReady = true;
                for (var i = 0; i < domReadyQueue.length; i++) {
                    domReadyQueue[i]();
                }
                domReadyQueue.length = 0;
                isRunning = false;
            };

        if ("readyState" in doc) {
            readyState = doc.readyState;
            domIsReady = readyState == "complete" || (~ navigator.userAgent.indexOf('AppleWebKit/') && (readyState == "loaded" || readyState == "interactive"));
        }
        else {
            domIsReady = !!doc.body;
        }

        if (!domIsReady) {
            if (win.addEventListener) {
                doc.addEventListener("DOMContentLoaded", dom_onReady, false);
            }
            else {
                doc.attachEvent("onreadystatechange", function(){
                    if (doc.readyState == "complete") {
                        dom_onReady();
                    }
                });
                if (doc.documentElement.doScroll && win === top) {
                    (function doScrollCheck(){
                        if (domIsReady) {
                            return;
                        }
                        try {
                            doc.documentElement.doScroll("left");
                        }
                        catch (e) {
                            setTimeout(doScrollCheck, 1);
                            return;
                        }
                        dom_onReady();
                    }());
                }
            }

            GJ.addEvent(win, "load", dom_onReady);
        }

        /**
         * 页面载入完成时触发的事件
         * @event GJ.onDomReady
         * @static
         * @param {Function} func 回调函数
         * @return {void}
         */
        GJ.onDomReady = function (fn, scope){
            if (domIsReady) {
                fn.call(scope);
                return;
            }
            domReadyQueue.push(function(){
                fn.call(scope);
            });
        };
    })();

 // 错误处理
    (function () {
        GJ.errorStack = [];
     })();
     
    (function () {
        GJ.Deferred = function (){
            // state in ['pending', 'done', 'fail']
            var state = "pending";
            var callbacks = {
                    'done':     [],
                    'fail':     [],
                    'always':   []
                };
            // `args` will be the `arguments` of callbacks
            var args = [];

            function dispatch ( status, cb ) {
                if (typeof cb === 'function') {
                    if ( state === status || (status === 'always' && state !== 'pending') ) {
                        setTimeout( function () {
                            cb.apply( {}, args );
                        }, 0 );
                    } else {
                        callbacks[status].push( cb );
                    }
                } else if ( state === 'pending' ) { // only 'pending' can change to 'done' or 'fail'
                    state = status;
                    var cbs = callbacks[status];
                    var always = callbacks['always'];

                    while( (cb = cbs.shift()) || (cb = always.shift()) ) {
                        setTimeout( (function ( fn ) {
                            return function () {
                                fn.apply( {}, args );
                            }
                        })( cb ), 0 );
                    }
                }
            };

            return {
                state: function () {
                    return state;
                },
                done: function (cb) {
                    if (typeof cb === 'function') {
                        dispatch('done', cb);
                    } else {
                        args = [].slice.call(arguments);
                        dispatch('done');
                    }
                    return this;
                },
                fail: function (cb) {
                    if (typeof cb === 'function') {
                        dispatch('fail', cb);
                    } else {
                        args = [].slice.call(arguments);
                        dispatch('fail');
                    }
                    return this;
                },
                always: function (cb) {
                    if (typeof cb === 'function') {
                        dispatch('always', cb);
                    }
                    return this;
                },
                promise: function () {
                    return {
                        done: function (cb) {
                            if (typeof cb === 'function') {
                                dispatch('done', cb);
                            }
                            return this;
                        }
                        ,fail: function (cb) {
                            if (typeof cb === 'function') {
                                dispatch('fail', cb);
                            }
                            return this;
                        }
                        ,always: function (cb) {
                            if (typeof cb === 'function') {
                                dispatch('always', cb);
                            }
                            return this;
                        }
                        ,state: function () {
                            return state;
                        }
                    }
                }
            };
        };

        GJ.when = function (){
            var ret     = GJ.Deferred(),
                defers  = [].slice.call(arguments),
                len     = defers.length,
                count   = 0;
            if (!len) {
                return ret.done().promise();
            }
            for ( var i = defers.length - 1; i >= 0; i-- ) {
                defers[i].fail(function () {
                    ret.fail();
                }).done(function () {
                    if ( ++count === len ) {
                        ret.done();
                    }
                });
            };
            return ret.promise();
        }
    })();
    // GJ.Module
    (function () {
        var headNode = document.getElementsByTagName("head")[0], cfg=GJ.config;
        var versions = cfg.fileVersions, alias=cfg.fileCodes, combines = cfg.fileCombines;
        var debug = GJ.config.debug ? true : false;
        var defers = {};
        var eventList = [];
        var startTime = +new Date;
        GJ.defers = defers;
        GJ.eventList = eventList;
        var STATUS = {
            'ERROR'     : -2,
            'FAILED'    : -1,
            'FETCHING'  : 1,   // The module file is fetching now.
            'FETCHED'   : 2,   // The module file has been fetched.
            'SAVED'     : 3,   // The module info has been saved.
            'READY'     : 4,   // The module is waiting for dependencies
            'COMPILING' : 5,   // The module is in compiling now.
            'PAUSE'     : 6,
            'COMPILED'  : 7    // The module is compiled and module.exports is available.
        }
        var require = function (uri) {
            uri = require.resolve(uri)[0];
            if (require.cache[uri] && require.cache[uri].status === STATUS.COMPILED) {
                return require.cache[uri].exports;
            } else {
                throw new Error(uri+'尚未加载');
            }
        }
        require.resolve = function (uri) { // 处理别名，返回为一个uri数组
            var ret = [];
            if (alias[uri]) {
                if (typeof alias[uri] === 'string') {
                    ret.push(alias[uri]);
                }
            } else {
                ret.push(uri);
            }
            return ret;
        }
        require.cache = {};

        GJ.Module = {
            STATUS: STATUS,
            fileLoaders: {
                ".js": jsLoader
            },
            find: function (uri) {
                return require.cache[require.resolve(uri)];
            }
        }

        var getAbsoluteUrl = function(uri, server){
            var _uri = uri.toLowerCase();
            if(_uri.indexOf('http:') === 0 || _uri.indexOf('https:') === 0){
                return uri;
            }

            if (uri.indexOf('./') === 0 || uri.indexOf('../') === 0) {
                var loc = window.location,
                    port = (loc.port ? ':' + loc.port : '');
                return loc.protocol + '//' + loc.host + port + '/' + uri;
            } else {
                if (!server) {    
                    server = GJ.config.defaultServer;
                }

                if (server.indexOf('http') !== 0) {
                    server = 'http://' + server;
                }

                return server + '/' + cfg.rootDir
                + uri.replace(/(\.(js|css|html?|swf|gif|png|jpe?g))$/i, "$1");
            }
        };
        /**
         * 取得一个格式化的url
         * 根据一个相对url，取得添加了http://sta*.ganji.com域名与版本号的完整url
         * @method GJ.getFormatUrl
         * @static
         * @param {string} url 文件url，相对http://sta*.ganji.com/src指定
         * @param {string} hostname 域名。默认为空。如果不为空将使用此域名，否则随机生成sta*.ganji.com域名
         * @return {string}
         * @example
         * <script type="text/javascript">
         * var url = GJ.getFormatUrl('js/util/json/json.js');
         * //url的值：http://sta1.ganji.com/src/js/util/json/json.__2343654234__.js
         * var url = GJ.getFormatUrl('js/util/json/json.js', 'sta.ganji.com');
         * //url的值：http://sta.ganji.com/src/js/util/json/json.__2343654234__.js
         * </script>
         */
        GJ.getFormatUrl = function(url, hostname){
            var urls = require.resolve(url), ret=[];
            var ret = GJ.map(urls, function(url){
                return getAbsoluteUrl(url, hostname);
            });
            return ret.length === 1 ? ret[0] : ret;
        };

        /**
         * 同步载入一个或多个js、css文件
         * 采用document.write()方式载入。<br />代码要用script标签包装。<br />由于同步载入影响性能，一般不要使用
         * @method GJ.require
         * @static
         * @param {string|array} urls 可以是js、css文件url，也可以是一组文件的代号，多个可用逗号分隔，也可用数组。相对http://sta*.ganji.com/src指定
         * @return {void}
         * @example
         * <script type="text/javascript">
         * GJ.require('jquery,js/util/json/json.js');
         * GJ.require(['js/util/panel/panel.js', 'js/util/panel/panel.css']);
         * </script>
         */
        GJ.require = function(uris, onError){
            var doc=document;
            var deps = resolveDeps(uris);
            var files = [];
            if (debug) {
                GJ.each(deps, function (dep) {
                    if (combines[dep.uri]) {
                        GJ.each(resolveDeps(combines[dep.uri]), function (d) {
                            files.push(d);
                        });
                    } else {
                        files.push(dep);
                    }
                });
            } else {
                files = deps;
            }
            GJ.each(files, function(dep){
                var uri = dep.uri;
                dep.status = STATUS.FETCHING;
                if (GJ.isFunction(onError)) {
                    defers[dep.id].fail(onError);
                }
                doc.write(unescape("%3Cscript src='"+getAbsoluteUrl(uri)+"' type='text/javascript'%3E%3C/script%3E"));
            });
        };

        /**
         * 异步载入一个或多个js、css文件
         * @method GJ.use
         * @static
         * @param {string|array} urls 可以是js、css文件url，也可以是一组文件的代号，多个可用逗号分隔，也可用数组。相对http://sta*.ganji.com/src指定
         * @param {Function} onLoad 全部载入完成时的回调函数
         * @param {Function} onError 载入出错时的回调函数
         * @return {void}
         * @example
         * <script type="text/javascript">
         * GJ.use('jquery,js/util/json/json.js', function(){
         *     $('#id').html(GJ.jsonEncode({msg:'Hello World!'}));
         * });
         * </script>
         */
        GJ.use = function(dependencies, func, onError){
            var id = GJ.guid();
            dependencies = resolveDeps(dependencies);
            var module = require.cache[id] = {
                id              : id
                ,dependencies   : dependencies
                ,status         : STATUS.SAVED
                ,factory         : func
                ,onError        : onError
            }
            var defer = defers[id] = GJ.Deferred();
            if (GJ.isFunction(onError)) {
                defer.fail(onError);
            };
            eventList.push([-(startTime - new Date), 'use', id]);
            moduleWait(id);
        };
        require.async = GJ.use;

        /**
         * 通知文件已载入
         * 作为js文件编写模板
         * @method GJ.add
         * @static
         * @param {string} url 当前文件的url，相对http://sta*.ganji.com/src指定
         * @param {string|array} needUrls 所依赖的其它文件。可以是js、css文件url，也可以是一组文件的代号，多个可用逗号分隔，也可用数组。相对http://sta*.ganji.com/src指定
         * @param {Function} func 在所依赖的文件都载入后的回调函数。主体代码置于此函数中
         * @return {void}
         */
        GJ.add = function(uri, dependencies, func, onError){
            var module = require.cache[uri], defer = defers[uri];
            if (module && module.status >= STATUS.SAVED) { // 阻止重复载入模块
                GJ.log(uri+' 重复载入['+module.status+']');
                return;
            }
            if (GJ.isFunction(dependencies)) {
                onError = func;
                func = dependencies;
                dependencies = [];
            }
            dependencies = resolveDeps(dependencies);
            if (module) {
                module.dependencies = dependencies;
                module.status       = STATUS.SAVED;
                module.factory      = func;
                module.onError      = onError;
                module.exports      = {};
            } else {
                require.cache[uri] = {
                    id              : uri
                    ,uri            : uri
                    ,dependencies   : dependencies
                    ,status         : STATUS.SAVED
                    ,factory        : func
                    ,onError        : onError
                    ,exports        : {}
                }
                module = require.cache[uri];
            }
            if (!defer) {
                defer = defers[uri] = GJ.Deferred();
            }
            eventList.push([-(startTime - new Date), 'add', uri]);
            if (GJ.isFunction(onError)) {
                defer.fail(onError);
            };
            moduleWait(uri);
        };
        function moduleWait (uri) {
            var module = require.cache[uri];
            var toFetchDeps = [];
            eventList.push([-(startTime - new Date), 'waiting', uri]);
            GJ.each(module.dependencies, function (dep) {
                if (dep.status < STATUS.FETCHING) { // before fetching
                    toFetchDeps.push(dep.uri);
                }
            });
            GJ.each(toFetchDeps, function (uri) {
                loadFile(uri);
            });
            var depDefers = GJ.map(module.dependencies, function (dep) {
                return defers[dep.id];
            });
            GJ.when.apply({}, depDefers)
                .done(function () {
                    moduleReady(uri);
                });
        }
        function moduleReady (uri) {
            eventList.push([-(startTime - new Date), 'ready', uri]);
            var module = require.cache[uri], defer = defers[uri];
            module.exports = {};
            module.status = STATUS.READY;
            if (GJ.isFunction(module.factory)) {
                module.status = STATUS.COMPILING;
                try {
                    if (module.uri) { // GJ.add  =>  function (require, exports, module)
                        module.pause = function () {
                            module.status = STATUS.PAUSE;
                        }
                        module.resume = function () {
                            // keep clean
                            delete module.pause;
                            delete module.resume;

                            module.status = STATUS.COMPILED;
                            defer.done();
                        }
                        var ret = module.factory.call(window, require, module.exports, module);
                        if (ret) {
                            module.exports = ret;
                        }
                    } else { // GJ.use  =>  function (d1, d2, d3, d4)
                        var depExports = GJ.map(module.dependencies, function (dep) {
                            return dep.exports;
                        });
                        module.factory.apply(window, depExports);
                    }
                } catch (ex) {
                    // TODO: 更具体的调试信息，包括模块的调用栈(module.parent);
                    GJ.log('MOD: '+uri);
                   
                    GJ.log('ERR: '+ex.message);
                    module.status = STATUS.ERROR;
                    defer.fail();
                    throw ex;
                }
            }
            if (module.status === STATUS.PAUSE) {
                return;
            } else {
                module.status = STATUS.COMPILED;
                defer.done();
            }
        }

        function jsLoader (uri, onLoad) {
            var module = require.cache[uri];
            var timer;

            loadFromRemote();

            function loadFromRemote() {
                var timer = setTimeout(function () {
                    headNode.removeChild(node);
                    moduleFail(uri, 'Load timeout');
                }, 30000); // 30s
                var node = doc.createElement("script");
                var done = false;
                node.setAttribute('type', "text/javascript");
                node.setAttribute('src', getAbsoluteUrl(uri));
                node.setAttribute('async', true);

                node.onload = node.onreadystatechange = function(){
                    if (!done && (!this.readyState || this.readyState == "loaded" || this.readyState == "complete")){
                        done = true;
                        clearTimeout(timer);
                        eventList.push([-(startTime - new Date), 'loaded', uri]);
                        if (module.status === STATUS.FETCHING) {
                            module.status = STATUS.FETCHED;
                        }
                        if (GJ.isFunction(onLoad)) {
                            onLoad();
                        }
                        // 如果一个文件在script.onload之后状态还未变为STATUS.SAVED
                        // 则说明这个文件为外部文件
                        if (module.status < STATUS.SAVED) {
                            GJ.log('This is not a GJ module, maybe wrong GJ.add?: '+uri);
                            moduleReady(uri);
                        }
                    }
                };

                node.onerror = function(e){
                    clearTimeout(timer);
                    headNode.removeChild(node);
                    moduleFail(uri, 'Load Fail');
                };
                module.status = STATUS.FETCHING;
                headNode.appendChild(node);
            }
        }
        function cmbFileLoader (uri) {
            var deps = combines[uri];
            var loader;
            if (!deps) {
                throw new Error(uri+'is not a combined js file');
            }
            deps = resolveDeps(deps);
            if (!debug) {
                // 将合并文件中的js文件标记为STATUS.FETCHING，防止重复抓取
                GJ.each(deps, function (dep) {
                    if (dep.status < STATUS.FETCHING && dep.uri.indexOf('.js') !== -1) {
                        dep.status = STATUS.FETCHING;
                    }
                });

                // 加载合并文件
                if (uri.indexOf('.css') === -1) {
                    loader = jsLoader;
                } else {
                    loader = cssLoader;
                }

                loader(uri, function () {
                    GJ.add(uri, combines[uri]);
                });
            } else {
                GJ.add(uri, combines[uri]);
            }
        }
        function loadFile (uri){
            eventList.push([-(startTime - new Date), 'fetching', uri]);
            if (combines[uri]) {
                return cmbFileLoader(uri);
            }
            var loaders = GJ.Module.fileLoaders;
            // TODO: jsonLoader
            for (var t in loaders) {
                if (loaders.hasOwnProperty(t)) {
                    if (uri.indexOf(t) !== -1) {
                        return loaders[t](uri);
                    }
                }
            }
            // default type is JS
            return loaders['.js'].call({
                require     : require
                ,defers     : defers
            }, uri);
        }
        var retryList = {}, defaultServerIndex = 0;
        function moduleFail (uri, reason) {
            if (retryList[uri]) {
                require.cache[uri].status = STATUS.FAILED;
                defers[uri].fail();
                GJ.errorStack.push({
                    'type': 'GJ_MODULE_FAIL',
                    'message': reason,
                    'uri': uri
                });
                throw new Error(reason + ": " + getAbsoluteUrl(uri));
            } else {
                retryList[uri] = true;
                defaultServerIndex = defaultServerIndex+1 >= GJ.config.servers.length ? 0 : defaultServerIndex + 1;
                GJ.config.defaultServer = GJ.config.servers[defaultServerIndex];
                GJ.setCookie('STA_DS', defaultServerIndex);
                loadFile(uri);
            }
        }
        function resolveDeps (dependencies) {
            var deps = [];
            if (dependencies && typeof dependencies === 'string') {
                dependencies = dependencies.replace(/^ */, "");
                dependencies = dependencies.split(/[, \r\n\t\f]+/);
            }
            GJ.each(dependencies, function (uri) {
                GJ.each(require.resolve(uri), function (u) {
                    if (GJ.inArray(u, deps) === -1) {
                        deps.push(u);
                    }
                });
            });
            deps = GJ.map(deps, function (dep) {
                if (!require.cache[dep]) {
                    require.cache[dep] = {
                        id              : dep
                        ,uri            : dep
                        ,dependencies   : []
                        ,status         : 0
                    }
                    defers[dep] = GJ.Deferred();
                }
                return require.cache[dep];
            });
            return deps;
        }
    })();
    /**
     * 远程跨域调用url后，执行回调函数
     *
     * @method GJ.jsonp
     * @static
     * @param {string|array} url 访问的文件url，url中不能包含callbackName和postData两个参数
     * @param {object} postData 要传递的数据，将进行json编码，服务器端通过josn_decode($_GET['postData'])获取
     * @param {Function} onLoad 全部载入完成时的回调函数
     * @param {Function} onError 载入出错时的回调函数
     * @param {string} callbackName 要传递的函数名，可以为空，服务器端通过$_GET['callbackName']获取
     * @return {void}
     */
    GJ.jsonp = function(url, postData, onLoad, onError, callbackName){
        if (!url) {
            alert('[GJ.jsonp]url不能为空 ');
            return;
        }

        if (GJ.isFunction(postData)) {
            callbackName = onError;
            onError = onLoad;
            onLoad = postData;
            postData = {};
        }

        if (!callbackName) {
            callbackName = GJ.guid();
        }

        url += url.indexOf('?') === -1 ? '?' : '&';
        url += 'postData=' + encodeURIComponent(GJ.jsonEncode(postData));
        url += '&callbackName=' + encodeURIComponent(callbackName);

        var doc=document, n, executed = false,
            doError = function(){
                if (!executed && GJ.isFunction(onError)) {
                    executed = true;
                    onError();
                }
            };

        var head = document.getElementsByTagName("head")[0];

        window[callbackName] = function(ret){
            executed = true;
            if (GJ.isFunction(onLoad)){
                onLoad(ret);
            }
        };

        n = doc.createElement("script");
        n.setAttribute('type', "text/javascript");
        n.setAttribute('src', url);
        n.setAttribute('async', true);

        var timer = GJ.later(function(){
            doError();
            GJ.error("文件载入失败: '"+url+"'");
            head.removeChild(n);
        }, 30 * 1000, false);

        var done = false;
        n.onload = n.onreadystatechange = function(){
            if (!done && (!this.readyState || this.readyState == "loaded" || this.readyState == "complete")){
                done = true;
                timer.cancel();
                doError();
            }
        };

        n.onerror = function(e){
            timer.cancel();
            doError();
            GJ.error(e + ": " + url);
            head.removeChild(n);
        };

        head.appendChild(n);
    };


    /**
     * 浏览器信息
     * 包括：
     * <ul>
     *     <li><strong>ie</strong> &nbsp; &nbsp; ie版本号。0表示非ie浏览器</li>
     *     <li><strong>opera</strong> &nbsp; &nbsp; Opera版本号。</li>
     *     <li><strong>gecko</strong> &nbsp; &nbsp; Gecko引擎版本号。</li>
     *     <li><strong>webkit</strong> &nbsp; &nbsp; AppleWebKit版本号。</li>
     *     <li><strong>chrome</strong> &nbsp; &nbsp; Chrome版本号。</li>
     *     <li><strong>mobile</strong> &nbsp; &nbsp; mobile属性。</li>
     *     <li><strong>air</strong> &nbsp; &nbsp; Adobe AIR版本号。</li>
     *     <li><strong>ipad</strong> &nbsp; &nbsp; Apple iPad's OS版本号。</li>
     *     <li><strong>iphone</strong> &nbsp; &nbsp; Apple iPhone's OS版本号。</li>
     *     <li><strong>ipod</strong> &nbsp; &nbsp; Apple iPod's OS版本号。</li>
     *     <li><strong>ios</strong> &nbsp; &nbsp; General truthy check for iPad, iPhone or iPod。</li>
     *     <li><strong>android</strong> &nbsp; &nbsp; Googles Android OS版本号。</li>
     *     <li><strong>caja</strong> &nbsp; &nbsp; Google Caja版本号。</li>
     *     <li><strong>secure</strong> &nbsp; &nbsp; 是否使用ssl安全协议。</li>
     *     <li><strong>os</strong> &nbsp; &nbsp; 操作系统。</li>
     * </ul>
     * @property GJ.ua
     * @static
     * @type object
     */
    GJ.ua = function() {
        var numberify = function(s) {
                var c = 0;
                return parseFloat(s.replace(/\./g, function() {
                    return (c++ == 1) ? '' : '.';
                }));
            },
            nav = win && win.navigator,
            ua = nav && nav.userAgent,
            loc = win && win.location,
            href = loc && loc.href,
            m,
            o = {
                ie: 0,
                opera: 0,
                gecko: 0,
                webkit: 0,
                chrome: 0,
                mobile: null,
                air: 0,
                ipad: 0,
                iphone: 0,
                ipod: 0,
                ios: null,
                android: 0,
                caja: nav && nav.cajaVersion,
                secure: false,
                os: null,
                isqplus: false,
                is360app: false
            };

        o.secure = href && (href.toLowerCase().indexOf("https") === 0);

        if (ua) {
            if ((/windows|win32/i).test(ua)) {
                o.os = 'windows';
            } else if ((/macintosh/i).test(ua)) {
                o.os = 'macintosh';
            } else if ((/rhino/i).test(ua)) {
                o.os = 'rhino';
            }

            if ((/KHTML/).test(ua)) {
                o.webkit=1;
            }

            m=ua.match(/AppleWebKit\/([^\s]*)/);
            if (m&&m[1]) {
                o.webkit=numberify(m[1]);

                if (/ Mobile\//.test(ua)) {
                    o.mobile = "Apple";

                    m = ua.match(/OS ([^\s]*)/);
                    if (m && m[1]) {
                        m = numberify(m[1].replace('_', '.'));
                    }
                    o.ipad = (navigator.platform == 'iPad') ? m : 0;
                    o.ipod = (navigator.platform == 'iPod') ? m : 0;
                    o.iphone = (navigator.platform == 'iPhone') ? m : 0;
                    o.ios = o.ipad || o.iphone || o.ipod;
                } else {
                    m=ua.match(/NokiaN[^\/]*|Android \d\.\d|webOS\/\d\.\d/);
                    if (m) {
                        o.mobile = m[0];
                    }
                    if (/ Android/.test(ua)) {
                        o.mobile = 'Android';
                        m = ua.match(/Android ([^\s]*);/);
                        if (m && m[1]) {
                            o.android = numberify(m[1]);
                        }
                    }
                }

                m=ua.match(/Chrome\/([^\s]*)/);
                if (m && m[1]) {
                    o.chrome = numberify(m[1]);
                } else {
                    m=ua.match(/AdobeAIR\/([^\s]*)/);
                    if (m) {
                        o.air = m[0];
                    }
                }
            }

            if (!o.webkit) {
                m=ua.match(/Opera[\s\/]([^\s]*)/);
                if (m&&m[1]) {
                    o.opera=numberify(m[1]);
                    m=ua.match(/Opera Mini[^;]*/);
                    if (m) {
                        o.mobile = m[0];
                    }
                } else {
                    m=ua.match(/MSIE\s([^;]*)/);
                    if (m&&m[1]) {
                        o.ie=numberify(m[1]);
                    } else {
                        m=ua.match(/Gecko\/([^\s]*)/);
                        if (m) {
                            o.gecko=1;
                            m=ua.match(/rv:([^\s\)]*)/);
                            if (m&&m[1]) {
                                o.gecko=numberify(m[1]);
                            }
                        }
                    }
                }
            }
        }

        try {
            if (win.external && win.external.qplus && GJ.isObject(win.external.qplus)){
                o.isqplus = true;
            }

            if(!o.isqplus && win.external && win.external.wappGetAppId && win.external.wappGetAppId()){
                o.is360app = true;
            }
        }
        catch (e) { }
        return o;
    }();

    /**
     * 去掉字符串首尾空格
     * @method GJ.trim
     * @static
     * @param {string} str 要处理的字符串
     * @return {string} 返回去掉首尾空格的字符串
     */
    GJ.trim = function(s)
    {
        return s.replace(/^\s+/, '').replace(/\s+$/, '');
    };
	   
    GJ.add('js/ganji.js');

})();

window.onerror = function (err, url, lineNumber) {
    //GJ.errorManager.send(err, url + '[' + lineNumber+']', 'WINDOW_ON_ERROR');
}