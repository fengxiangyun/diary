<?php $this->load('index/widget/header.php');?>
<div id="headlines" class="module">
<!-- 头条 --> 
<?php $this->load('index/widget/one_image.php', array('image' => $this->top_image));?>
  <div id="headlines_slider" class="headlines_slider">
    <ul id="headlines_slider_cont" class="headlines_slider_cont">
      <li>
      <!-- 顶部最热 -->
        <?php $this->load('index/widget/topic.php', array('topic' => $this->topic));?>
        </div>
      </li>
    </ul>
  </div>
 </div>
<?php $this->load('more/widget/module.php');?>
<?php $this->load('footer/footer.php');?>
</body></html>