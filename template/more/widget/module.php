<?php foreach (DiaryTypeConfig::$TYPE as $key => $value){
if(!$value['show']) continue;
?>
<div class="module">
    <div class="module_header">
        <h2><a href="<?php echo UrlNamespace::categoryUrl($value['id']);?>" class="cur"><?php echo $value['name'];?></a></h2>
        <ul class="category">
        <li><a data-cid="106" href="<?php echo UrlNamespace::categoryUrl($value['id']);?>">查看</a></li>
<!--            <li><a data-cid="101" href="">社会</a></li>-->
<!--            <li><a data-cid="102" href="">军迷</a></li>-->
<!--            <li><a data-cid="103" href="">呛调</a></li>-->
<!--            <li><a data-cid="106" href="">图片</a></li>-->
        </ul>
    </div>
    <div class="module_goucai">
        <table class="tableCol4">
            <tbody>
                <tr>
                <?php $i=0; foreach ($value['majory'] as $k => $v){?>
                   <?php if ($i%4==0 && $i!=0){?></tr><tr><?php }?>
                   <td><a href="<?php echo UrlNamespace::majoryUrl($v['id']);?>"><?php echo $v['name'];?></a></td>
                <?php $i++; }?>
               </tr>
           </tbody>
       </table>
   </div>
</div>
<?php }?>
