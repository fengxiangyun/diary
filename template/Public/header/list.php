<?php 
$limit = isset($limit) ? $limit : 1000;
$type = CategoryNamespace::getAllCategory(false, $this->category['id']);
$len = 1;
foreach ($type as $value) {?>
  <li <?php if (isset($class)) {?>class="<?php echo $class;?>"<?php }?>><a <?php if (isset($this->category) && $this->category['id'] == $value['id']){?>style="background-color: #496D94;"<?php }?> href="<?php if (isset($value['url'])){ echo $value['url'];}else {echo UrlNamespace::categoryUrl($value['id']);}?>"><?php echo $value['name'];?></a></li>
<?php
    if ($len >= $limit) {
        break;
    }
    $len++;
}?>