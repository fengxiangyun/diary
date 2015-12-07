<?php if (isset($image)){?>
<div class="mod">
  <div class="mod_slidePic">
    <div class="mod_slidePic_wrap">
      <ul class="mod_slidePic_block">
        <li style="width: 25%;">
          <a href="<?php echo $image['href'];?>" title="<?php echo $image['title'];?>">
            <img src="<?php echo $image['url'];?>" width="320" height="140" alt="<?php echo $image['title'];?>">
            <p><?php echo $image['title'];?></p>
          </a>
        </li>
      </ul>
      <ul class="mod_slidePic_tab"></ul>
    </div>
  </div>
</div>
<?php }?>