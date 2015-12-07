<div class="mod">
    <div class="mod_search">
        <form method="get" action="__APP__/search/">
            <div class="mod_search_selectWrap">
            <select name="type">
                <option value="">全部</option>
                <option value="author" <?php if ($this->type_id === 'author'){?>selected<?php }?>>作者</option>
                <option value="bookname" <?php if ($this->type_id  === 'bookname'){?>selected<?php }?>>日记本</option>
                <?php foreach ($type as $value){?>
                <option <?php if ($type_id == $value['id']){?>selected<?php }?> value="<?php echo $value['id'];?>"><?php echo $value['name'];?></option>
                <?php }?>
            </select>
            </div>
            <div class="mod_search_textWrap">
                <input type="search" name="kw" class="mod_search_text" value="<?php echo $this->kw;?>" placeholder="">
            </div>
            <input type="submit" value="搜索">
        </form>
    </div>
</div>