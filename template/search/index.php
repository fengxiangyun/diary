<?php $this->load('header/header2.php', array('no_search_box'=>true));?>
<!-- 图片 -->
<style>
.header_top {border-bottom: 1px}
.selected_box {
background-color: #ededed;
border-radius: 2px;
border: 1px solid #d6d6d6;
float: left;
list-style: none;
height: 22px;
line-height: 22px;
margin: 4px;
padding: 0 3px;
cursor: pointer;
width: auto;
}
.person_tag {
float: left;
width: auto;
white-space: nowrap;
overflow: hidden;
-o-text-overflow: ellipsis;
text-overflow: ellipsis;
word-wrap: normal;
}
.close {
float: right;
color: #a8a8a8;
margin-left: 5px;
cursor: pointer;
font-size: 14px;
}
em {
color: #ec3701;
}
/*图片*/
.mod_focusPic {
padding: 5px;
background-color: #eee;
overflow: hidden;
}
.mod_focusPic>div {
float: left;
}
.mod_focusPic_col2 {
width: 50%;
height:117px;
}
.mod_focusPic a:visited {
color: #fefefe;
}
.mod_focusPic_col2 a {
width: 100px;
}
.mod_focusPic a {
display: block;
height: 110px;
margin: 0 auto;
position: relative;
text-align: center;
overflow: hidden;
color: #fff;
}
a {
text-decoration: none;
}
img {
border: 0;
margin: 0;
padding: 0;
}
.mod_focusPic a:visited {
color: #fefefe;
}
.mod_focusPic a {
text-align: center;
color: #fff;
}
.mod_focusPic i {
display: block;
height: 26px;
line-height: 26px;
padding: 0 10px;
background-color: rgba(0,0,0,.4);
position: absolute;
left: 0;
right: 0;
bottom: 0;
overflow: hidden;
}
b, i {
font-style: normal;
}
</style>
<?php $this->load('Public/image/up.php', array('image' => $this->top_image));?>
<?php
$this->load('Public/list/search.php',
    array(
        'type_id' => $this->category['id'],
        'type_name' => 'category',
        'type'      => CategoryNamespace::getAllCategory(true)
    )
);?>
<div class="mod_nav1" style="overflow: hidden;">
  <div>
  <?php foreach($this->cutword as $value) {?>
      <li class="selected_box">
        <a href="<?php echo $value['url'];?>">
          <span class="person_tag"><?php echo $value['word'];?></span>
          <span title="移除" class="close">×</span>
        </a>
      </li>
  <?php }?>
  </div>
  <ul class="mod_nav1_cate">
    <li style="font-size: 13px;"><em> <?php echo $this->count;?> </em>条结果</li>
  </ul>
</div>
<?php if (isset($value['image']) && $value['image']) {?>
<div class="mod">
  <div class="mod_picText_2">
    <a class="img72" href="<?php echo $value['image']['href'];?>" title="<?php echo $value['image']['title'];?>">
      <img src="<?php echo $value['image']['url'];?>" alt="<?php echo $value['image']['title'];?>" width="72" height="72">
        <h3><?php echo $value['image']['title'];?></h3>
          <p><?php echo $value['image']['detail'];?></p>
    </a>
  </div>
</div>
<?php }?>

<div class="mod">
  <ul class="mod_listTxt">
  <?php $image = 1; foreach($this->article as $v){
            if ($v['type_id'] != 400) {
            ?>
    <li>
      <a title="<?php echo $v['title'];?>" href="<?php echo UrlNamespace::detailUrl($v['majory_id'], $v['puid']);?>">
        <?php if (isset($v['diary_book'])){?><i class="diaryBook">《<?php echo $v['diary_book'];?>》</i><?php }?><i class="channel">[<?php echo $v['majory'];?>]</i><?php echo $v['title'];?><i class="author"><?php echo $v['author'];?></i>
      </a>
    </li>
    <?php }else { $image++; ?>
    <div class="mod_focusPic">
        <div class="mod_focusPic_col2">
        <a href="<?php echo UrlNamespace::detailUrl($v['majory_id'], $v['puid']);?>">
        <?php if($image > 4){?>
            <img class="lazy" width="95" height="100" original="http://datougou.b0.upaiyun.com/<?php echo $v['content'];?>!100px" alt="<?php echo $v['title'];?>" >
        <?php }else{?>
            <img width="95" height="100" src="http://datougou.b0.upaiyun.com/<?php echo $v['content'];?>!100px" alt="<?php echo $v['title'];?>" >
        <?php }?>
            <i><?php echo $v['title'];?></i>
        </a>
        </div>
    </div>
    <?php }}?>
  </ul>
</div>
<?php 
$this->load('Public/list/search.php',
    array(
        'type_id' => $this->category['id'],
        'type_name' => 'category',
        'type'      => CategoryNamespace::getAllCategory(true)
    )
);?>
<div class="page">
  <?php echo $this->page;?>
</div>
<?php $this->load('footer/footer.php');?>
</body></html>