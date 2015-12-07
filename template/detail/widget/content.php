<header class="article-hd">
    <h1 class="article-tit"><?php echo $this->article['title'];?></h1>
    <p class="article-byline">
        <a href="" class="commnum"><i></i><?php echo $this->article['comment_times'];?></a>作者：<a href="__APP__/search?type=uid&kw=<?php echo $this->article['user_id'];?>"><?php echo mb_substr($this->article['author'], 0, 11, 'utf8');?></a>
        &nbsp;&nbsp;浏览：<?php echo $this->article['read_times'];?>&nbsp;&nbsp;
        <time class="time"><?php echo date("Y-m-d H", $this->article['time_step']);?></time>
    </p>
    <!-- 日记类型 -->
    <?php if (isset($this->diary) && $this->diary){?>
    <p class="article-byline">
                日记本：<a style="color:red" href="__APP__/search?type=bookid&kw=<?php echo $this->article['diary_book_id'];?>"><?php echo $this->article['diary_book'];?></a> - <a href="__APP__/search?type=bookid&kw=<?php echo $this->article['diary_book_id'];?>">所有日记</a>
    </p>
    <?php }?>
    <!-- 日记类型end -->
    <!-- <p class="article-hd-ad">
        <a href="">广告 </a>
    </p> -->
</header>
<div class="articleCont">
    <?php if (isset($this->image['up']) && !empty($this->image['up'])) {?>
    <div class="content_bimg" data-in="1">
        <img alt="<?php echo $this->image['up']['title'];?>" style="" src="<?php echo $this->image['up']['url'];?>">
        <h2></h2>
    </div>
    <?php }?>
<?php echo $this->article['content'];?>
</div>