<div class="side" data-status="1">
    <div class="side-ad1 pAd3"></div>
    <!--全网：相关新闻下的搜索-->
        <div class="side-ad2 Ad2 clearfix">
            <!-- 频道：最新发布-->
           <ul class="list list-ad ">
            <?php foreach ($this->new as $value) {?>
            <li><a href="<?php echo UrlNamespace::detailUrl($value['majory_id'], $value['puid']);?>"><?php echo $value['title'];?><i></i><!--<i class="author"><?php echo $value['author'];?></i> --></a></li>
           <?php }?>
           </ul>
         </div>
    <!-- 搜索框 -->
    <div class="search-bar">
        <form action="__APP__/search/" method="get" class="search-form">
        <input type="hidden" value="mobilecontent" name="channel">
        <input type="text" name="kw" class="search-txt" value="">
        <i class="search-icon"></i>
        <input type="submit" class="search-btn" value="">
        <div id="selectWrap" class="selectWrap">
             <select name ="type">
                <option value="" >全部</option>
                <?php
                $allCategory = CategoryNamespace::getAllCategory(true);
                foreach ($allCategory as $key => $value) {?>
                    <option <?php if ($this->category['id'] == $value['id']){?>selected<?php }?> value="<?php echo $value['id'];?>" ><?php echo $value['name'];?></option>
                <?php }?>
                </select>
        </div>
        </form>
    </div>
    <!-- 频道热点 -->
     <section class="hotSpotC">
        <header class="titlebar tb-o not-bd-b">
            <h2 class="titlebar-t"><i></i>频道热点</h2>
            <a class="titlebar-r commentMore more" href="<?php echo UrlNamespace::majoryUrl($this->majory['id'])?>">更多文章<i></i></a>
        </header>
         <div class="switch sw-news">
            <ul class="sw-nav sw-nav5 clearfix">
                <li class="first"><a href="javascript:void(0);" class="cur">最新</a></li></li>
            </ul>
             <div class="sw-cont">
                <div class="sw-area hover">
                   <ul class="list list-order">
                   <?php $i = 0;foreach ($this->hot as $value){?>
                   <li class="li<?php echo $i++;?>"><i></i><a href="<?php echo UrlNamespace::detailUrl($value['majory_id'], $value['puid']);?>"><?php echo $value['title'];?></a><!-- <author class="author"><?php echo $value['author'];?></author> --></li>
                   <?php }?>
                  </ul>
                </div>
            </div>
        </div>
    </section>
    <?php if (isset($this->image['right']) && !empty($this->image['right'])) {?>
    <section class="gallery" style="display: block;">
        <header class="titlebar tb-o not-bd-b">
            <h2 class="titlebar-t"><i></i>精彩热图</h2>
            <a class="titlebar-r commentMore more" href="">更多热图<i></i></a>
        </header>
        <ul id="pics" class="list list-pic clearfix" data-in="2">
        <?php $i=0; foreach ($this->image['right'] as $value) {?>
          <li class="li<?php echo $i++;?>"><a href="<?php echo $value['href'];?>"><p class="pic"><img src="<?php echo $value['url'];?>"></p><p class="tit"><?php echo $value['title'];?></p></a></li>
        <?php }?>
        </ul>
    </section>
    <?php }?>
    
    
<section class="hotSpot">
    <header class="titlebar tb-o not-bd-b">
        <h2 class="titlebar-t"><i></i>全网热点</h2>
        <a class="titlebar-r commentMore more" href="">更多热点<i></i></a>
    </header>

    <div class="switch sw-news">
        <ul class="sw-nav sw-nav5 clearfix">
            <li class="first"><a id="All" class="cur" href="javascript:void(0);">全网</a></li>
        </ul>
        <div class="sw-cont">
            <div class="sw-area hover">
                <ul id="AllNewsDay" class="list list-order">
                <?php $i=0; foreach ($this->all_hot as $value) {?>
                    <li class="li<?php echo $i++;?>"><a href="<?php echo $value['href'];?>">
                        <p class="tit"><i></i><?php echo $value['title'];?></p></a>
                    </li>
                <?php }?>
                </ul>
            </div>
        </div>
    </div>
</section>
</div>
