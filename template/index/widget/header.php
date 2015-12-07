<!DOCTYPE html>
<html>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>大头狗日记 - 大头狗 - 日记</title>
<meta name="apple-mobile-web-app-capable" content="yes" />
 <link rel="shortcut icon" href="../Public/favicon.ico" type="image/x-icon" />
<META NAME="ROBOTS" CONTENT="INDEX,FOLLOW">
<meta name="format-detection" content="telephone=no" />
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
<meta name="keywords" content="大头狗日记   日记">
<meta name="description" content="大头狗日记,大头狗,日记,情感,校园,围城,旅行,搜索">
<?php echo $this->helper('css_loader', $this->css);?>
  <!--[if lte IE 8]>
        <link rel="stylesheet" type="text/css" href="../Public/css/common-ie.css?v=0.1">
        <script type="text/javascript" src="../Public/html5.js?ver=0.1"></script>
        <![endif]-->
</head>
<body>
  <header>
    <div class="header_top">
      <h1 class="header_top_logo">
        <a href="__APP__">
          <img src="../Public/image/logo.png" height="37" alt="大头狗日记" title="大头狗日记">
          <span>大头狗日记</span>
        </a>
      </h1>
    <div class="header_top_right">
      <div class="header_top_search">
        <form id="search" class="search" method="get" action="__APP__/search">
          <input type="text" name="kw" value="很远">
          <input type="submit" value="搜索">
        </form>
      </div>
    </div>
  </div>
  <nav class="header_nav">
    <ul class="header_nav_list">
    <?php $this->load('Public/header/list.php');?><!--
    <li style="float: right;"><a style="color:#FDFDFD" href="/diary/index.php/pub/">发帖</a></li>
    <li style="float: right;"><a style="color:#c5c5c5;height:32px" href="__APP__/user/login"><?php if ($_SESSION['login']) {echo $_SESSION['user']['user_name'];}else{echo '登陆';}?></a></li>

    --></ul>
  </nav>
</header>