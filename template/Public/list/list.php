<?php 
$title = isset($title) ? $title : true;
$type  = isset($type) ? $type : true;
$comment_times = isset($comment_times) ? $comment_times : false;
foreach ($article as $key => $value) {
if ($title) {?>
<div class="mod_nav1">
  <h2><a href="<?php echo UrlNamespace::majoryUrl($value['majory_id']);?>"><?php echo $value['majory_name'];?></a></h2>
  <ul class="mod_nav1_cate">
    <li><a href="<?php echo UrlNamespace::majoryUrl($value['majory_id']);?>">更多</a></li>
  </ul>
</div>
<?php }?>
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
  <?php foreach($value['article'] as $v){?>
    <li>
      <a title="<?php echo $v['title'];?>" href="<?php echo UrlNamespace::detailUrl($v['majory_id'], $v['puid']);?>">
        <?php 
        if (isset($v['diary_book'])){?><i class="diaryBook">《<?php echo $v['diary_book'];?>》</i><?php }
        elseif (isset($v['book'])){?><i class="diaryBook">《<?php echo $v['book'];?>》</i><?php }
        elseif ($comment_times){?><i class="cmtNum"><?php echo $v['comment_times'];?></i><?php }
        if ($type){?><i class="channel">[<?php echo $v['majory'];?>]</i><?php }?>
        <?php echo $v['title'];?><?php if (isset($author) && $author){?><i class="author"><?php echo $v['author'];?></i><?php }?>
      </a>
    </li>
    <?php }?>
  </ul>
</div>
<?php }?>