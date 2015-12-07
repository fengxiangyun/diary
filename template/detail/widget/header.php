<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo $this->title;?> - 大头狗日记</title>
<meta name="keywords" content="大头狗日记-<?php echo $this->title;?>-日记-大头狗">
<META NAME="ROBOTS" CONTENT="INDEX,FOLLOW">
<meta name="description" content="<?php echo $this->title;?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
<meta name="format-detection" content="telephone=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <!-- 全网：头部引用资源文件-->
<?php echo $this->helper('css_loader', $this->css);?>
  <!--[if lte IE 8]>
        <link rel="stylesheet" type="text/css" href="../Public/css/common-ie.css?v=0.1">
        <script type="text/javascript" src="../Public/html5.js?ver=0.1"></script>
        <![endif]-->
</head>
<body class="Repaint">
    <div class="pageBox">
        <div class="containBox">
        <div class="containBox_opbg"></div>
            <!--全网,头部链接-->
            <!-- 
<header class="header">
    <div class="header-holder clearfix" style="border-bottom: 1px solid #6189b5;">
        <h1 class="header_top_logo">
            <a href="/diary/index.php">
              <img src="/diary/Public/image/logo.png" height="37" alt="大头狗日记" title="大头狗日记">
              <span>大头狗日记</span>
            </a>
          </h1>
          <div class="header_top_right">
          <div class="header_top_search">
            <form id="search" class="search" method="get" action="">
              <input type="text" name="q" value="">
              <input type="submit" value="搜索">
            </form>
          </div>
        </div>
    </div>
    <div class="header-holder clearfix">
        <div class="header-channel">
          <ul class="header-menu clearfix">
             <?php $this->load('Public/header/list.php', array('class' => 'hm-item'));?>
             <li class="hm-item"><a href="__APP_/category/more">更多</a></li>
          </ul>
        </div>
    </div>
</header> -->


<header class="header" >
    <div class="header-holder clearfix">
        <nav class="header-link">
            <a class="lg" href="__APP__"><i></i>大头狗日记</a>
            <a href="<?php echo UrlNamespace::majoryUrl($this->majory['id'])?>"><?php echo $this->category['name'];?></a>
        </nav>
        <a href="__APP__">
        <h2 class="logo"><i class="logo_bg_" style="width:105px;height:30px;"></i><i class="logo_name"><?php echo $this->majory['name'];?></i><i class="logo_url">datougou.cn</i></h2>
        </a>
        
       
        
        <a href="__APP__/more/"><i class="tmBtn"></i></a>
        <div class="header-channel">
            <ul class="header-menu clearfix">
                 <?php $this->load('Public/header/list.php', array('class' => 'hm-item'));?>
            </ul>
            <!--
            <div class="searchBar search1">
                <form action="http://paike.3g.cn/Ijump_xuan.ashx" method="get" class="searchForm1">
                    <input type="hidden" value="1" name="jmty">
                    <input type="hidden" value="mobilecontent" name="channel">
                    <input type="text" id="s" name="q" class="txt stxt1 fl" placeholder="">
                    <label for="s" class="btn sbtn1 fl"><i class="icon-search png"></i></label>
                </form>
                <label for="s2" class="btn sbtn2"><i class="icon-search png"></i></label>
            </div>-->
        </div>
<!--
        <div class="searchBar search2">
            <div class="searchForm2 hide">
                <form action="http://paike.3g.cn/Ijump_xuan.ashx" method="get">
                    <input type="hidden" value="1" name="jmty">
                    <input type="hidden" value="mobilecontent" name="channel">
                    <input type="text" id="Text1" name="q" class="txt stxt2" placeholder="">
                </form>
            </div>
        </div>-->

    </div>
</header>