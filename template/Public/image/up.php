<?php if (isset($image)) {?>
<div class="da_item">
  <ul>
    <li style="background-color: #F2F2F2;border-bottom: 1px solid #F2F2F2;font-size: 16px;height: 50px;line-height: 36px;overflow: hidden;text-align: center;">
      <a href="<?php echo $image['href'];?>">
        <img alt="<?php echo $image['title'];?>" style="max-width:320px;" src="<?php echo $image['url'];?>">
      </a>
    </li>
  </ul>
</div>
<?php }?>