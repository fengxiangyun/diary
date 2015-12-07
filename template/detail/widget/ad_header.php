<div class="main-ad2 Ad1">
  <ul class="list list-ad ">
  
  <?php if (isset($this->ad_top)){ foreach($this->ad_top as $key=>$value){?>
    <li><a href="<?php echo $value['url'];?>"><?php echo $value['title'];?><i></i></a></li>
  <?php  }}?>
  </ul>
</div>