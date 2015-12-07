<?php if (isset($topic)) {?>
<div class="mod">
  <div class="mod_titleBar">
    <a href="<?php echo $topic['url'];?>" title="<?php echo $topic['title'];?>">
      <h3 style="font-size:18px;text-align:center;font-weight:bold;font-style:normal;text-decoration:none;color:#9F0101;"><?php echo $topic['title'];?></h3>
    </a>
  </div>
</div>
<!-- 
<div class="mod">
  <ul class="mod_listSub">
    <li style="text-align:center">
      <a href="" title=""></a>|
      <a href="" title=""></a>
    </li>
  </ul>
</div> -->
<?php }?>