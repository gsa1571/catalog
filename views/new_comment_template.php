<div class='comment-content'>
    <div class='comment-meta'>
        <em><b><span><?=htmlspecialchars($comment['comment_author'])?></span> </b><?=$comment['created']?></em>
    </div>
    <div>
        <?=nl2br(htmlspecialchars($comment['comment_text']))?>
    </div>
</div>
