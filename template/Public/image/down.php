<?php if (isset($image) && !empty($image)) {?>
<p class="mod_part">
  <a href="<?php echo $image['href'];?>">
    <img style="max-width:320px" src="<?php echo $image['url'];?>" alt="<?php echo $image['title'];?>">
  </a>
</p>
<?php }?>