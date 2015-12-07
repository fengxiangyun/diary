<?php $this->load('medical/widget/header.php');?>
    <div style="position: relative;">
    <script type="text/javascript" src="../Public/js/medical/category.js"></script>
    <div class="header_v3" >
        <a class="logo" href="http://datougou.cn/"></a>
        <h1 class="h1name">医院</h1>
        <!-- <div class="city"><a href=""></a></div> -->
        <nav>
            <ul class="head-nav">
            <li class="h-login"><a href="/disease.html" style="background-position:14px 9px; width:35px">疾病</a></li>
            <li class="h-sort"><a href="http://m.lashou.com/search.php">搜索</a></li>
            </ul>
         
        </nav>
    </div>
        <div class="content" id="content">
            <div class="searchbox cf">
                <form id="searchForm" action="" method="get">
                <div style="float: right;margin-right: 0px;"><input type="submit" class="search-submit" value=""></div>
                <div class="search-left" style="margin-right:50;">
                    <a href="<?php echo UrlNamespace::creatHospitalUrl($this->disease, $this->province['province_id'], $this->city['city_id'], $this->district['district_id'],'',$this->level,'');?>"><em></em></a>
                    <input value="<?php echo $this->keyword;?>" name="keyword" type="text" class="inputsearch" id="search_input" maxlength="26" style="color: rgb(204, 204, 204);">
                </div>
                </form>
            </div>
            <!--头部 分类  排序 -->
            <div class="mall-cate-box">
                <ul class="mall-cate">
                    <li>
                        <a href="javascript:void(0);" id="show_categories" class="cate21">
                        <?php if ($this->city){
                                  echo $this->city['short_name'];
                              }elseif($this->province){
                                  echo $this->province['short_name'];
                              } else{
                                  echo '全部';
                              }?>
                        <em></em>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" id="show_district" class="cate31">
                            <?php if ($this->district){
                                      echo $this->district['short_name'];
                                  }else{
                                      echo '全部地区';
                                  }?><em></em>
                        </a>
                    </li>
                    <li style="width:34%">
                        <a href="javascript:void(0);" id="show_sort" class="cate41">
                        <?php if ($this->level==3){
                                  echo '三级';
                              }elseif($this->level==2){
                                  echo '二级';
                              }elseif($this->level==1){
                                  echo '其他';
                              }else{
                                  echo '等级';
                              }?>
                        <em></em>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- 头部 结束 -->

            <!-- 点击菜单遮罩 -->
            <div id="fullbg" style="width:100%;height: 100%;display:none; top:0; z-index:10001;-webkit-user-select:none;-webkit-tap-highlight-color:rgba(0,0,0,0);-webkit-transform:translate3d(0,0,0);">
                <i class="pull"></i>
            </div>
            <!-- 点击菜单遮罩结束 -->

<!-- 分类信息 -->
<div class="float-navbox" id="navbox">
    <div class="navwarp" id="navbox_inner">
        <dl>
            <dd class="online">
                <a href="<?php echo UrlNamespace::creatHospitalUrl($this->disease, '', '', '', '', $this->level, $this->keyword);?>" class="tit_link down">全部</a> 
            </dd>
            <?php foreach($this->provinces as $key=>$value){ ?>
            <dd class="online">
                <a href="<?php
                        if(count($value['city'])==1){
                            echo UrlNamespace::creatHospitalUrl($this->disease, $value['province_id'], $value['city'][0]['city_id'], '', '', $this->level, $this->keyword);
                        }else{
                            echo 'javascript:void(0)';
                        } 
                        ?>"
                        <?php if(count($value['city'])!=1){ ?>
                        onclick="show_cate2(<?php echo $value['province_id']?>,event)" <?php } ?> id="cate_<?php echo $value['province_id']?>_a" class="<?php 
                    if(count($value['city'])==1){
                        echo 'tit_link';
                    }else{
                        echo 'tit';
                    }?>"><?php echo $value['short_name']?></a>
                    <?php
                    if (count($value['city']) == 1){
                        continue;
                    }
                    ?>
                <section class="category-box" id="cate_<?php echo $value['province_id']?>" style="display:none">
                    <h3>
                    <table>
                            <tbody>
                            <tr>
                            <?php foreach($value['city'] as $k=>$v){ ?>
                                <td width="84"><a href="<?php echo UrlNamespace::creatHospitalUrl($this->disease, $value['province_id'], $v['city_id'], '', '', $this->level, $this->keyword);?>"><?php echo $v['short_name'];?></a></td>
                                     <?php
                                     if (($k+1)%3 == 0 && $k!=0) {
                                       echo '</tr></tbody></table></h3><h3><table><tbody><tr>';
                                     }
                                 } ?>
                            </tr>
                            </tbody>
                    </table>
                    </h3>
                </section>
            </dd>
            <?php } ?>
        </dl>
    </div>
</div>
<!-- 分类信息 -->

<!-- 商圈信息 -->
<div class="float-navbox" id="navbox_district">
    <div class="navwarp" id="navbox_district_inner">
        <dl>
            <div id="district_show">
                <dd class="online"><a href="<?php echo UrlNamespace::creatHospitalUrl($this->disease, $this->province['province_id'], '', '', '', $this->level, $this->keyword);?>" class="tit_link down">所有地区</a></dd>
                <?php foreach($this->districts as $key=>$value){ ?>
                <dd class="online"> 
                    <a href="<?php echo UrlNamespace::creatHospitalUrl($this->disease, $this->province['province_id'], $this->city['city_id'], $value['district_id'],'',$this->level,$this->keyword);?>" id="district_<?php echo $value['district_id'];?>_a" style="display: block;padding: 13px 10px;outline: 0;background: transparent;"><?php echo $value['short_name'];?><em></em></a>
                    <!--<a href="javascript:void(0)" id="district_<?php echo $value['district_id'];?>_a" class="tit" onclick="show_zone(<?php echo $value['district_id'];?>)"><?php echo $value['short_name'];?><em></em></a>-->
                    <!--
                    <section class="category-box" id="district_<?php echo $value['district_id'];?>" style="display:none">
                        <h3>
                        <table>
                            <tbody>
                            <tr>
                               <?php foreach($value['street'] as $k=>$v){ ?>
                                <td width="84"><a href="<?php echo UrlNamespace::creatHospitalUrl('',$value['province_id'], $v['city_id']);?>"><?php echo $v['short_name'];?></a></td>
                                     <?php 
                                     if (($k+1)%3 == 0 && $k!=0) {
                                       echo '</tr></tbody></table></h3><h3><table><tbody><tr>';
                                     }
                                 } ?>
                             </tr>
                            </tbody>
                        </table>
                        </h3>
                    </section>
                     -->
                </dd>
                <?php } ?>
            </div>
        </dl>
    </div>
</div>
<!-- 商圈信息结束-->

<!-- 排序 -->
<div class="float-navbox" id="navbox_sort">
    <div class="navwarp">
        <dl>
            <dd class="online">
                <a href="<?php echo UrlNamespace::creatHospitalUrl($this->disease, $this->province['province_id'], $this->city['city_id'], $this->district['district_id'],'','',$this->keyword);?>" class="tit_sort down">不限<em class="d"></em></a>
            </dd>
            <dd class="online">
                <a href="<?php echo UrlNamespace::creatHospitalUrl($this->disease, $this->province['province_id'], $this->city['city_id'], $this->district['district_id'],'',3,$this->keyword);?>" class="tit_sort">三级<em class="d"></em></a>
            </dd>
            <dd class="online">
                <a href="<?php echo UrlNamespace::creatHospitalUrl($this->disease, $this->province['province_id'], $this->city['city_id'], $this->district['district_id'],'',2,$this->keyword);?>" class="tit_sort">二级<em class="d"></em></a>
            </dd>
            <dd class="online">    
                <a href="<?php echo UrlNamespace::creatHospitalUrl($this->disease, $this->province['province_id'], $this->city['city_id'], $this->district['district_id'],'',1,$this->keyword);?>" class="tit_sort">其他<em class="g"></em></a>
            </dd>
        </dl>
    </div>
</div>
<!-- 排序结束 -->


    <div id="fullbg_f" style="width:100%;height: 100%;display:none; top:0; z-index:10003;-webkit-user-select:none;-webkit-tap-highlight-color:rgba(0,0,0,0);-webkit-transform:translate3d(0,0,0);"></div>
    <div class="v3">
        <ul class="common-item">
            <?php foreach($this->hospital as $value){ ?>
            <li>
                <div>
                    <!-- <div class="pic">
                        <img src="" original="" alt="" style="display: inline;">
                    </div> -->
                    <div class="item-name" style="padding: 12px 10px 0 13px;">
                        <!--<div class="item-ico">
                            <span class="icon-freeres"></span>
                        </div>-->
                        <h2><a href="<?php echo UrlNamespace::hospitalDetail($value['id']);?>" style="width: 230px;float: left;"><?php echo $value['title'];?></a>
                        <p style="color:#F08A01;"><?php
                        if (isset(MedicalVar::$HOSPITAL_LEVEL[$value['level']])) {
                            echo MedicalVar::$HOSPITAL_LEVEL[$value['level']];
                        }
                        ?></p></h2>
                        <h3><?php echo $value['brief'];?></h3>
                        <?php if ($value['contact'] !=''){ ?>
                        <div class="item-edit">
                            <?php 
                                preg_match('/[0-9-]+/', $value['contact'], $phone);
                                echo '<a href="tel:'.$phone[0].'">电话：'.$phone[0].'</a>';
                            ?>
                            <p class="num"><span></span></p>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </li>
            <?php } ?>
        </ul>
        
        <div class="pagebox">
            <?php echo $this->page;?>
           
            <!--<a class="btnpage non" href="javascript:()">没有更多产品</a>-->
            
        </div>
    </div>
</div>
<?php $this->load('medical/widget/footer.php');?>