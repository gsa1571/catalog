<?php defined('CATALOG') or die('Access denied.');?>
<ul class="menu">
    <?php foreach($navpages as $key => $value ) : ?>
        <?php $reflink = ($key == 'index') ? PATH : PATH."page/{$key}" ?>
         
        <li>
            <a href='<?=$reflink?>'><?=$value?></a>
        </li>
    <?php endforeach; ?>
    <li>
        <a href=<?=PATH.'category/'?>>Каталог</a>
    </li>
</ul>
