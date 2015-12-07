<?php $this->load('index/widget/header.php');?>
<div id="headlines" class="module">
<!-- 头条 --> 
<?php $this->load('index/widget/one_image.php', array('image' => $this->top_image));?>
</div>
<div class="crumbs">
    <a href="__APP__" class="a-blue">首页</a> &gt;用户注册
</div>

 <div class="set-password">
    <form method="post" action="" id="regForm">
        <p class="label">用户名</p>
        <div class="form-item limit-input">
            <input type="text" class="comn-input" placeholder="汉字\字母\数字" value="<?php echo $this->name;?>" name="username" id="userName">
        </div>
        <p class="red-ae user-tip" <?php if(!isset($this->username)){?>style="display:none;"<?php }?> id="userNameTip"><?php echo $this->username;?></p>
        <p class="label">密码</p>
        <div class="form-item limit-input">
            <input type="password" class="comn-input" placeholder="字母&amp;数字" value="" name="password" id="password">
        </div>
        <p class="red-ae user-tip" <?php if(!isset($this->password)){?>style="display:none;"<?php }?> id="passwordTip"><?php echo $this->password;?></p>
        <p class="label">再次输入密码</p>
        <div class="form-item limit-input">
            <input type="password" class="comn-input" placeholder="字母&amp;数字" value="" name="password2" id="passwordAgain">
        </div>
        <input type="submit" value="注册" class="comn-submit over-submit">
    </form>
</div>
<?php $this->load('footer/footer.php');?>
</body></html>