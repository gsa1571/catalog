<?php defined('CATALOG') or die('Access denied.'); ?>
<li <?php if(isset($parent_cut) && $parent_cut['id']=$category['id']) echo "class = 'dcjq-current-parent'"; ?> >
    <a href="<?=PATH?>category/<?=$category['id']?>"><?=$category['title']?></a>
    <?php if(isset($category['childs']) && $category['childs']): ?>
        <ul>
            <?= categories_to_string($category['childs'])?>
        </ul>
    <?php endif; ?>    
</li>



