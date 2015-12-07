<?php $this->load('detail/widget/header.php');?>
<div class="wrap clearfix">
  <div class="main">
<!-- 头部广告ContxtHeadAd() -->
<?php 
if (isset($this->ad_top) && !empty($this->ad_top)) {
    $this->load('detail/widget/ad_header.php', array('ad' => $this->ad_top));
}
?>
  <article class="article-holder small size3">          
    <?php echo $this->bread;?>
    <?php $this->load('detail/widget/content.php');?>
    <!--投票-->
    <!-- 上一篇 下一篇 -->
    <div class="main-ad5">
        <ul class="list list-ad ">
        <?php if (!empty($this->near[0])) {?>
          <li><a href="<?php echo UrlNamespace::detailUrl($this->near[0]['majory_id'], $this->near[0]['puid'])?>">上一篇：<?php echo $this->near[0]['title'];?><i></i></a></li>
        <?php }
              if (!empty($this->near[1])) {?>
          <li><a href="<?php echo UrlNamespace::detailUrl($this->near[1]['majory_id'], $this->near[1]['puid'])?>">下一篇：<?php echo $this->near[1]['title'];?><i></i></a></li>
        <?php }?>
         </ul>
    </div>
    <!-- image down-->
    <?php if (isset($this->image['down']) && !empty($this->image['down'])) {?>
     <div class="main-ad6 s320">
           <a class="pic-ad" href="<?php echo $this->image['href'];?>"><img style="max-height:100px;" src="<?php echo $this->image['down']['url'];?>" alt="<?php echo $this->image['down']['title'];?>"></a>
     </div>
     <?php }?>
     <!--全网：相关文章-->
    <div class="area relateNews">
        <div class="titlebar tb-o">
            <h2 class="titlebar-t">相关文章</h2>
        </div>
        <ul id="relnews" class="list list-relnews clearfix">
        <?php foreach ($this->related as $value) {?>
            <li><a href="<?php echo UrlNamespace::detailUrl($value['majory_id'], $value['puid']);?>"><i></i><?php echo $value['title'];?></a><!-- <i class="author"><?php echo $value['author'];?></i> --></li>
        <?php }?>
        </ul>
    </div>
    <aside class="article-share">
        <p class="as-tit">分享此文章：</p>
        <p class="as-icon">
            <a rel="nofollow" href="<?php echo UrlNamespace::shareUrl($this->article['majory_id'], $this->article['puid']);?>&type=1" class="s-sina" title="新浪微博"></a>
            <a rel="nofollow" href="<?php echo UrlNamespace::shareUrl($this->article['majory_id'], $this->article['puid']);?>&type=2" class="s-weblog" title="腾讯微博"></a>
            <a rel="nofollow" href="<?php echo UrlNamespace::shareUrl($this->article['majory_id'], $this->article['puid']);?>&type=3" class="s-QZone" title="QQ空间"></a>
         </p>
        <p class="as-num">已有<span class="col-r"><?php echo $this->article['share_times'];?></span>人分享</p>
    </aside>
</article>


<section class="comment-holder" id="commentHolder">
    <header class="titlebar tb-o">
        <h2 class="titlebar-t"><i></i>评论</h2>
        <a href="" class="titlebar-r commentMore more">&gt;&gt;评论<b><?php echo $this->article['comment_times'];?></b>条</a>
    </header>
    
    <ul id="comment" class="comment">
    <?php if (!empty($this->comment)){
    foreach ($this->comment as $value) {?>
        <li class="item">
         <p class="byline"><?php echo $value['nick_name']?><time class="time"><?php echo date('Y-m-d H:m:i', $value['times']);?></time></p>
         <div class="tools"></div>
         <p><?php echo $value['content'];?></p>
         </li>
    <?php }}?>
    </ul>
    <div class="reply-holder">
    <div class="main-ad3 pAd2" style="color:red;"><?php if (isset($this->error) && !empty($this->error)){echo $this->error;}?></div>
        <div class="replyBox hide">
            <div class="reply-hd">
                <h2 class="reply-tit">我要评论</h2>
                <p class="login" style="display:none;">
                    <span class="notlogged">
                    <a href="">登录</a>
                    <a href="">注册</a>
                    </span>
                </p>
            </div>
            
            <form class="" method="post" action="__APP__/comment" id="commentForm">
                <input type="hidden" id="puid" name="puid" value="<?php echo $this->article['puid'];?>">
                <input type="hidden" id="category" name="category" value="<?php echo $this->article['type_id'];?>">
                <input type="hidden" id="majory" name="majory" value="<?php echo $this->article['majory_id'];?>">
                <div class="textareabox"><textarea class="textarea" id="content" name="content"></textarea></div>
                <div class="line"><input type="submit" value="发表评论" class="btn btn-submit"></div>
            </form>
        <!--简版大图
        <p class="replyBox-ad">
            <a href="http://datougou.cn"><span></span></a>
         </p>-->     
        </div>
        
    </div>
</section>
</div>
<?php $this->load('detail/widget/right.php');?>
</div>
<footer class="footer">
    <div class="footer_version">
        <a href="">普版</a>
        
    <a class="cur">炫版</a>
        <a href="">客户端</a>
    </div>
    <div class="footer_consult">
        <a href="">客服</a>
        <a href="">广告</a>
        <a href="">免责声明</a>
    </div>
</footer>
</div></div>
     <script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F10b297fc416f306a363709652c62a912' type='text/javascript'%3E%3C/script%3E"));
</script>
</body></html>