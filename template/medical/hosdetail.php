<?php $this->load('medical/widget/header.php');?>
<!--header-->
<div class="header_d3 shadow">
    <a href="http://datougou.cn/diary/index.php/medical/hospital" class="arrowleft atop" id="backhref">
        <label id="backlabel">返回</label>
    </a>
    <h1 class="h1name"><?php echo mb_substr($this->hospital['title'],0,10,'utf8');?></h1>
    <a href="http://m.lashou.com/share.php?id=7984848" class="arrowside-fun" title="分享到">
        <span class="ml-fx">分享到</span>
    </a>
    <a style="right:60px;" class="arrowside-fun" title="收藏" href="http://m.lashou.com/login.php?back=http%3A%2F%2Fm.lashou.com/detail.php?id=7984848">
        <span class="ml-coll">收藏</span>
    </a>
</div>
<!--content-->
<div id="fullbg"></div> 
    <div class="content">
        <div class="d3">
            <div class="section-detailbox">
                <section class="title">
                    <h1 ><?php echo $this->hospital['title'];?></h1>
                    <h3><?php 
                        if (isset(MedicalVar::$HOSPITAL_LEVEL[$this->hospital['level']])){
                            echo MedicalVar::$HOSPITAL_LEVEL[$this->hospital['level']].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                        }
                        if (trim($this->hospital['address'])!='') {
                            echo $this->hospital['address'];
                        }
                        ?>
                    </h3>
                </section>
            </div>
            <div class="section-detailbox">
                <?php if (trim($this->hospital['contact'])!=''){ ?>
                <section class="title">
                    <h2>电话</h2>
                </section>
                <section class="title">
                    <div class="detail_cen" style="padding:0;">
                        <p>
                        <?php
                        $phone = explode(",",$this->hospital['contact']);
                        foreach($phone as $value){
                            preg_match('/[0-9-]+/', $value, $p);
                            echo '<a href="tel:'.$p[0].'">'.$value.'</a>&nbsp;&nbsp;&nbsp;';
                        } ?>
                        </p>
                    </div>
                </section>
            <?php } ?>
            <?php if (trim($this->hospital['brief'])!=''){ ?>
                <section class="title">
                    <h2>简介</h2>
                </section>
                <section class="title">
                    <div class="detail_cen" style="padding:0;">
                        <p><?php echo $this->hospital['brief'];?></p>
                    </div>
                </section>
                <?php if (trim($this->hospital['intro'])!=''){ ?>
                <section class="deal-view">
                    <a href="#more">查看更多</a>
                </section>
                <?php } ?>
            </div>
            <?php } ?>
            <?php $department = unserialize($this->hospital['departments']);
                  if(count($department)>0){
            ?>
            <div class="section-detailbox">
                <section class="title">
                    <h2>科室</h2>
                </section>
                <section class="title">
                    <div class="detail_cen" style="padding:0; font-size:12px;">
                         <ul id="tips_generated_by_system">
                         <?php foreach($department as $key=>$value){ ?>
                             <li>
                                 <strong><?php echo $key;?>：</strong>
                                 <?php foreach($value as $v){
                                          echo $v.'&nbsp;&nbsp;';
                                       }
                                 ?>
                             </li>
                         <?php } ?>
                         </ul>
                         <p><span></span></p>
                         <div id="kfzs" class="new_h2_1"></div>
                    </div>
                </section>
            </div>
            <?php } ?>
        </div>
        <?php if (trim($this->hospital['intro'])!=''){ ?>
        <div class="section-detailbox" id="more">
                <section class="title">
                    <h2>介绍</h2>
                </section>
                <section class="title">
                    <div class="detail_cen" style="padding:0; font-size:12px;">
                         <ul id="tips_generated_by_system">
                             <p><?php echo $this->hospital['intro'];?></p>
                         </ul>
                    </div>
                </section>
        </div>
        <?php } ?>
    </div>
<?php $this->load('medical/widget/footer.php');?>