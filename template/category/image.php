<?php $this->load('header/header2.php');?>

<!-- 图片 -->
<?php $this->load('Public/image/up.php', array('image' => $this->top_image));?>
<div class="mod_nav1">
  <h2><a href="<?php echo UrlNamespace::hotArticleUrl($this->category['id'], null);?>">最热文章</a></h2>
</div>
<?php $this->load('Public/title/up.php', array('topic' => $this->topic));?>
<!-- 图片 -->
<?php $this->load('Public/image/middle.php',array('image' => $this->mid_image));?>
<!-- 最热 
<?php $this->load('Public/list/list.php',
    array(
        'title'=> false,
        'article' => (array)$this->top_article,
        'type' => true,
        'ad' => false,
        'comment_times' => true,
    )
);
?>
-->
<?php 
$this->load('Public/list/search.php',
    array(
        'type_id' => $this->category['id'],
        'type_name' => 'category',
        'type'      => CategoryNamespace::getAllCategory(true)
    )
);?>
<!-- 列表最新发布 -->
<?php $this->load('Public/image.php', array('list' => $this->list));?>
<?php 
if (!empty($this->result['down_image'])) { 
    $this->load('Public/image/down.php', array('image' => $this->result['down_image']));
}
if (!empty($this->result['search_word'])) { //热搜词
     $this->load('Public/search_word/index.php');
} 
$this->load('footer/footer.php');?>
</body></html>