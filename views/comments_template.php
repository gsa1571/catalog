<?php defined('CATALOG') or die('Access denied.'); ?>
<li>
    <div class="comment-content <?php if($category['is_admin']) echo 'manager';?>">
        <div class="comment-meta">
            <em><b><span><?=htmlspecialchars($category['comment_author'])?></span></b>
            <?=$category['created']?></em>
        </div>
        <div>
            <?=nl2br(htmlspecialchars($category['comment_text']))?>
            <p><a href="#<?=$category['comment_id']?>">Ответить</a></p>
        </div>
    </div>
    <?php if(isset($category['childs']) && $category['childs']): ?>
    <ul>
        <?= categories_to_string($category['childs'], $template)?>
    </ul>
    <?php endif; ?>    
</li>
