<?php $this->load('index/widget/header.php');?>
<div id="headlines" class="module">
<!-- 头条 --> 
<?php $this->load('index/widget/one_image.php', array('image' => $this->result['top_image']));?>
  <div id="headlines_slider" class="headlines_slider">
    <ul id="headlines_slider_cont" class="headlines_slider_cont">
      <li>
      <!-- 顶部最热 -->
        <?php $this->load('index/widget/topic.php', array('topic' => $this->result['topic']));?>
        <ul class="module_list ">
        <?php foreach ($this->result['top_article'] as $value) {?>
            <li><a href="<?php echo UrlNamespace::detailUrl($value['majory_id'], $value['puid']);?>"><i class="channel">[<?php echo $value['majory']?>]</i><?php echo $value['title'];?></a></li>
        <?php }?>
        </ul>
        <!-- 中间大图 -->
        <div class="module_imgNews">
          <div class="sliderImgNews">
              <ul class="sliderImgNews_block" style="">
                <li style="width: 25%;"><a href="<?php echo $this->result['mid_image']['href'];?>"><img src="<?php echo $this->result['mid_image']['url'];?>" width="320" height="140" alt=""><p>Give me your love!</p></a></li>
              </ul>
          </div>
         <!-- end中间大图 -->
        </div>
      </li>
    </ul>
  </div>
 </div>
<?php $this->load('index/widget/module.php', array('article' => $this->result['article']));?>
<?php $this->load('footer/footer.php');?>
</body></html>