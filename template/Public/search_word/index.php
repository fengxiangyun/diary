<!-- 热搜词最多四个一行 -->
<ul class="mod_listSub">
  <li>
  <?php foreach ($this->result['search_word'] as $value) {?>
    <a href="<?php UrlNamespace::WordUrl($value);?>"><?php echo $value;?></a>
    <?php }?>
   </li>
</ul>