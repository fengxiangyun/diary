<?php $image =1; foreach($list as $value){?>
<div class="mod_nav1">
  <h2><a href="<?php echo UrlNamespace::majoryUrl($value['majory_id']);?><?php if($value['id']){echo '&name='.$value['id'];}?>"><?php echo $value['name'];?></a></h2>
  <ul class="mod_nav1_cate">
    <li><a href="<?php echo UrlNamespace::majoryUrl($value['majory_id']);?><?php if($value['id']){echo '&name='.$value['id'];}?>">更多</a></li>
  </ul>
</div>

<div class="mod_focusPic">
<?php foreach($value['list'] as $k=>$v){
$image++;
    ?>
    <div class="mod_focusPic_col2">
        <a href="<?php echo UrlNamespace::detailUrl($v['majory_id'], $v['puid']);?>">
            <?php if($image > 5){?>
            <img class="lazy"  width="95" height="100" original="http://datougou.b0.upaiyun.com/<?php echo $v['content'];?>!100px" src="" alt="<?php echo $v['title'];?>" >
            <?php }else{?>
            <img  width="95" height="100" src="http://datougou.b0.upaiyun.com/<?php echo $v['content'];?>!100px" alt="<?php echo $v['title'];?>" >
            <?php }?>
            <i><?php echo $v['title'];?></i>
        </a>
    </div>
<?php }?>
</div>
<?php }?>