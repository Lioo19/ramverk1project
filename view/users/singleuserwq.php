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
        <div class="singleUserQ">
            <a href=<?= url("q/showq?id=" . $value->id)?>>
                <?php if ($value->parentid) {
                    ?><h2 class="tiny"> Answer</h2><?php
                } else {
                    ?><h2 class="tiny"> Question</h2>
                    <h4><?= $value->title?></h4>
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
        <div class="singleUserc">
            <a href=<?= url("q/showq?id=" . $value->postid)?>>
                <p><?= $value->body?></p>
        </div>
    <?php
    } ?>
</article>
