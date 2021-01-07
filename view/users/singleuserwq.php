<?php

/**
 * Render content within an article - extended from anax/v2/article/default
 */

namespace Anax\View;

?>
<h1><?= $user?> </h1>
<article>
    <?php
    if (count($allQs) === 0) {
        ?><p>This user has not posted any Qs or As yet</p><?php
    } else {
        ?><h3>Qs and As</h3><?php
    }
    foreach ($allQs as $key => $value) { ?>
    <div class="qBox">
        <a href=<?= url("q/showq?id=" . $value->id)?>>
            <?php if ($value->parentid) {
                ?><h4 class="tiny"> Answer</h4><?php
            } else {
                ?><h4 class="tiny"> Question: <?= $value->title?></h4>
                <?php
            }?>
            <p><?= $value->body?></p>
        </a>
    </div>
        <?php
    }
    if (count($allCs) === 0) {
        ?><p>This user has not posted any Comments</p><?php
    } else {
        ?><h3>Comments</h3><?php
    }
    foreach ($allCs as $key => $value) {?>
        <div class="comment">
            <a href=<?= url("q/showq?id=" . $value->postid)?>>
                <p><?= $value->body?></p>
            </a>
        </div>
        <?php
    } ?>
</article>
