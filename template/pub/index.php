<?php $this->load('index/widget/header.php');?>
<style>


</style>
<div id="headlines" class="module">
<!-- 头条 --> 
 <?php $this->load('index/widget/one_image.php', array('image' => $this->top_image));?>
</div>
<div class="crumbs">
    <a href="http://3g.ganji.com/bj/" class="a-blue">首页</a> &gt;用户注册
</div>
 <div class="publish">
     <p class="title gray9">选择发布文章所属类别</p>
     <div class="pub-locker">
     <?php $j=0;foreach(DiaryTypeConfig::$TYPE as $key=>$value) {?>
          <div class="locker-item" onclick="show(this,<?php echo $j;?>);">
            <div class="locker-tt">发表<?php echo $value['name'];if ($value['id'] == 2){echo ' （需要创建日记本）';}?><i class="s-arrow arrow"></i></div>
            <div class="cate-items" id="children<?php echo $j;?>" style="display:none;">
               <div class="cate-item">
                <?php $i=0; foreach ($value['majory'] as $k=>$v){
                    $i++;?>
                    <a href="<?php echo UrlNamespace::pubTypeUrl($v['id']);?>"><?php echo $v['name'];?><div></div></a>
                    <?php if ($i%2==0){?>
                    </div><div class="cate-item">
                    <?php }?>
                  <?php }?>
                </div>
                
            </div>
        </div><!--.locker-item-->
        <?php $j++;}?>
     </div><!--.pub-locker-->
  </div>
<script>
function show(d,j){
    var dom_= document.getElementById('children'+j);
   
    if (dom_.style.display == 'none') {
        d.style['background'] = '#6189b5';
        d.style['color'] = '#fff';
        d.childNodes[1].childNodes[1].style['-webkit-transform'] = 'rotate(45deg)';
        d.childNodes[1].childNodes[1].style['border-color'] = '#fff';
        dom_.style['display'] = 'block';
    } else {
        d.style['background'] = '';
        d.style['color'] = '#404040';
        d.childNodes[1].childNodes[1].style['-webkit-transform'] = 'rotate(-135deg)';
        d.childNodes[1].childNodes[1].style['border-color'] = '#808080';
        dom_.style['display'] = 'none'; 
    }
}
</script>
<?php $this->load('footer/footer.php');?>
</body></html>