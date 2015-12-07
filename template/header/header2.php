<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo $this->title;?> - 大头狗日记</title>
<meta name="keywords" content="大头狗日记,大头狗,日记,情感,校园,围城,旅行,搜索">
<meta name="description" content="大头狗日记 - <?php echo $this->category['name'];if (isset($this->majory)){ echo '-' . $this->majory['name'];}?>">
<META NAME="ROBOTS" CONTENT="INDEX,FOLLOW">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="format-detection" content="telephone=no">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
<?php echo $this->helper('css_loader', $this->css);?>
<?php if(isset($this->image) && $this->image){?>
<script src="http://d2.lashouimg.com/wap/js/jquery-1.3.2.min.js"></script>
<script type="text/javascript">
(function($){
	$.fn.lazyload = function(options){
		var settings={
			threshold:0,
			failurelimit:0,
			event:"scroll",
			effect:"show",
			container:window,
            forceInit:true
		};
		if(options){
			$.extend(settings,options);
		}
		var elements=this;
		//新增safari4上offset().top会随着滚动条变化而变化值是原始值+$(window).scrollTop()
		var dynload_img_offset = elements.offset().top;
		var dynload_flag = false;
		if("scroll"==settings.event){
			$(settings.container).bind("scroll",function(event){
				var counter=0;
				var dynload_img_first_offset = $(".lazy").offset().top;
				if(parseInt(dynload_img_first_offset) > parseInt(dynload_img_offset) + 5){//允许5像素误差
					dynload_flag = true;
				}else{
					dynload_flag = false;
				}
				elements.each(function(i,val){
					if($.abovethetop(this,settings)||$.leftofbegin(this,settings)){

					}else if(!$.belowthefold(this,settings,dynload_flag)&&!$.rightoffold(this,settings)){
						$(this).trigger("appear");
					}else{
						if(counter++>settings.failurelimit){
							return false;
						}
					}
				});
				var temp=$.grep(elements,function(element){
					return!element.loaded;
				});
				elements=$(temp);
			});
		}
		this.each(function(){
			var self=this;
			$(self).one("appear",function(){
				if(!this.loaded){
					$("<img />").bind("load",function(){
						$(self).hide().attr("src",$(self).attr("original"))[settings.effect](settings.effectspeed);
						self.loaded=true;
					}).attr("src",$(self).attr("original"));
				};
			});
			if("scroll"!=settings.event){
				$(self).bind(settings.event,function(event){
					if(!self.loaded){
						$(self).trigger("appear");
					}
				});
			}
		});
        if(settings.forceInit){
            $(settings.container).trigger(settings.event);
        }
		return this;
	};
	$.belowthefold=function(element,settings,dynload_flag){
		if(dynload_flag){
			offset = $(element).offset().top - $(window).scrollTop();
		}else{
			offset = $(element).offset().top
		}
		if(settings.container===undefined||settings.container===window){
			var fold=$(window).height()+$(window).scrollTop();
		}else{
			var fold=$(settings.container).offset().top+$(settings.container).height();
		}
		return fold<=offset-settings.threshold;
	};
	$.rightoffold=function(element,settings){
		if(settings.container===undefined||settings.container===window){
			var fold=$(window).width()+$(window).scrollLeft();
		}else{
			var fold=$(settings.container).offset().left+$(settings.container).width();
		}
		return fold<=$(element).offset().left-settings.threshold;
	};
	$.abovethetop=function(element,settings){
		if(settings.container===undefined||settings.container===window){
			var fold=$(window).scrollTop();
		}else{
			var fold=$(settings.container).offset().top;
		}
		return fold>=$(element).offset().top+settings.threshold+$(element).height();
	};
	$.leftofbegin=function(element,settings){
		if(settings.container===undefined||settings.container===window){
			var fold=$(window).scrollLeft();
		}else{
			var fold=$(settings.container).offset().left;
		}
		return fold>=$(element).offset().left+settings.threshold+$(element).width();
	};
	$.extend($.expr[':'],{
		"below-the-fold":"$.belowthefold(a, {threshold : 0, container: window})",
		"above-the-fold":"!$.belowthefold(a, {threshold : 0, container: window})",
		"right-of-fold":"$.rightoffold(a, {threshold : 0, container: window})",
		"left-of-fold":"!$.rightoffold(a, {threshold : 0, container: window})"
	});
})(jQuery);
</script>
<?php }?>
   <!--[if lte IE 8]>
        <link rel="stylesheet" type="text/css" href="../Public/css/common-ie.css?v=0.1">
        <script type="text/javascript" src="../Public/html5.js?ver=0.1"></script>
        <![endif]-->  <!--[if lte IE 8]>
        <link rel="stylesheet" type="text/css" href="../Public/css/common-ie.css?v=0.1">
        <script type="text/javascript" src="../Public/html5.js?ver=0.1"></script>
        <![endif]-->
</head>
<body id="body0" style="height: auto; overflow: auto;">
<script>
$(function(){
    $(".lazy").lazyload({
        effect : "fadeIn",
        threshold : 200
    });
})
</script>
  <nav class="navTop">
    <ul class="navTop_list">
      <li><a href="__APP__">首页</a></li>
    <?php $this->load('Public/header/list.php');?>
    </ul>
    <a href="__APP__/more/" class="navTop_more">更多</a>
   </nav><!-- 顶栏 -->
<header>
    <div class="header_top">
        <h1 class="header_top_logo">
            <a href="__APP__">
            <img height="34" title="大头狗日记" alt="大头狗日记" src="../Public/image/logo.png">
            <span>大头狗日记</span>
            </a>
        </h1>
        <?php if (isset($no_search_box) && $no_search_box) {}else{?>
        <div class="header_top_right">
            <div class="header_top_search">
                <form action="__APP__/search" method="get" class="search" id="search">
                <div class="selectWrap" id="selectWrap">
                <select name ="type">
                <option <?php if ($this->type_id == ''){?>selected<?php }?> value="" >全部</option>
                <option value="author" <?php if ($this->author){?>selected<?php }?>>作者</option>
                <option value="bookname" <?php if ($this->bookname){?>selected<?php }?>>日记本</option>
                <?php
                $allCategory = CategoryNamespace::getAllCategory(true);
                foreach ($allCategory as $key => $value) {?>
                    <option <?php if ($this->type_id == $value['id']){?>selected<?php }?> value="<?php echo $value['id'];?>" ><?php echo $value['name'];?></option>
                <?php }?>
                </select>
                </div>
                <input type="search" value="<?php echo $this->kw;?>" name="kw" id="searchBar"><input type="submit" value="搜索">
                </form>
            </div>
        </div>
        <?php }?>
    </div>
    <nav class="header_nav">
        <ul class="header_nav_list">
        <?php
            $allMajory = $this->category['majory'];
            $len = 5 - $allMajory%5;
            for($i = 0;$i < $len; $i++) {
                $allMajory[] = array('id'=>'','name'=>'');
            }
            $items = 0;foreach ($allMajory as $key => $value) {
            $items++;
              ?>
            <li style="width: 20%;<?php if (isset($this->majory) && $this->majory['id'] == $value['id']){?>background-color: rgb(35, 68, 109)<?php }?>" item="<?php echo $items;?>"><a href="__APP__/majory/?majory=<?php echo $value['id'];?>"><?php echo $value['name'];?></a></li>
           <?php if ($items%5 == 0) {?>
               </ul><ul class="header_nav_list">
           <?php }?>
            
           <?php }?>
        </ul>
    </nav>
</header>
