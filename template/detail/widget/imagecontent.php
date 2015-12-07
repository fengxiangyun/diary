<header class="article-hd">
    <h1 class="article-tit"><?php echo $this->article['title'];?></h1>
    <p class="article-byline">
        <a href="" class="commnum"><i></i><?php echo $this->article['comment_times'];?></a>作者：<a href="__APP__/search?type=author&kw=<?php echo $this->article['author'];?>"><?php echo mb_substr($this->article['author'], 0, 11, 'utf8');?></a>
        &nbsp;&nbsp;浏览：<?php echo $this->article['read_times'];?>&nbsp;&nbsp;
        <time class="time"><?php echo date("Y-m-d H", $this->article['time_step']);?></time>
    </p>
   
    <!-- 日记类型end -->
    <!-- <p class="article-hd-ad">
        <a href="">广告 </a>
    </p> -->
</header>
<div class="articleCont">
    
    <div class="content_bimg" data-in="1">
        <img alt="" style="" src="http://datougou.b0.upaiyun.com/<?php echo $this->article['content'];?>">
        <h2></h2>
    </div>

</div>