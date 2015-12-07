<?php $this->load('index/widget/header.php');?><div id="headlines" class="module">
<!-- 头条 --> 
<?php $this->load('index/widget/one_image.php', array('image' => $this->top_image));?>
</div>
<div class="crumbs">
    <a href="__APP__" class="a-blue">首页</a> &gt; <a href="<?php echo UrlNamespace::pubrUrl();?>" class="a-blue"><?php echo $this->category['name'];?></a> &gt; <?php echo $this->majory['name'];?>
</div>
 <div class="publish">
    <form method="post" class="publish-send" action="" id="regForm">
    
       <p class="red-ae user-tip" >网站完善中 ，敬请期待</p>
    
    
        <?php if (isset($this->diary)) {?>
        <div class="pub-item radio-item">
            <span class="gray9 label">类型</span>
            <span class="radio-collect">
                <input type="radio" name="private" value="0" checked="">不加密
            </span>
            <span class="radio-collect">
                <input type="radio" name="private" value="1">加密
            </span>
        </div>
        <?php }?>
        <p class="label gray9">标题</p>
        <div class="form-item limit-input">
             <input type="text" class="comn-input" value="" name="title" >
        </div>
        <p class="red-ae user-tip" <?php if (isset($this->error)){?>style="display:none;"<?php }?> ><?php echo $this->error;?></p>
       <!-- 内容 -->
       <p class="label gray9">内容</p>
       <div class="reply-holder">
           <div class="main-ad3 pAd2" style="color:red;"></div>
            <div class="replyBox hide">
                <div class="textareabox"><textarea class="textarea" id="content" name="content"></textarea></div>
           </div>
       </div>
       <?php if (!isset($_SESSION['login']) || !$_SESSION['login']){?>
       <p class="label">验证码<span class="gray-bfbf">(不区分大小写)</span></p>
       <div class="form-item check-code">
            <input type="text" class="comn-input" name="checkcode" id="checkcode">
            <img id="check_code" src="__APP__/image/" class="code-img">
            <a href="__APP__/user/login" class="prime-a" id="reset_code">换一张</a>
        </div>
        <!-- end内容 -->
        <?php }?>
      <input type="submit" value="发布" class="comn-submit over-submit">
    </form>
</div>
<?php $this->load('footer/footer.php');?>
</body></html>