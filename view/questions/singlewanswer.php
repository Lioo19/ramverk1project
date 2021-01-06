<?php

/**
 * Render content within an article - extended from anax/v2/article/default
 */

namespace Anax\View;

?>
<article>
    <article>
        <div class="singleq">
            <h1><?= $question["title"]?></h1>
            <p><?= $question["body"] ?></p>
            <p>Q asked by <i><?= $question["ownerusername"] ?></i></p>
            <a class="commentlink" href="<?= url("q/commenton?id=" . $question["id"]) ?>">Comment</a>
            <p>Tags:    </p>
            <div class="qTags">
                <?php
            foreach ($tags as $key => $value) {?>
                    <p>
                        <a href="<?= url("tags/showsingle?id=" . $value[1] . "&name=" . $value[0]) ?>"><?= $value[0] ?></a>
                    </p>
            <?php
            }
            ?>
            </div>
        </div>
    <?php
    if ($comments[$question["id"]]) {
        foreach ($comments[$question["id"]] as $key => $value) {
            ?><div class="comment"><?php
            foreach ($value as $key1 => $value1) {
                switch ($key1) {
                    case 'body':
                    // case 'score':
                    ?><p><?= $value1 ?></p><?php
                    break;
                    case 'username':
                    ?><p>comment by: <i><?= $value1 ?></i></p><?php
                    break;
                }
            }?>
        </div><?php
        }
    }
    ?>
    </article>
    <article>
        <h3>Answers</h3>
    <?php foreach ($answers as $key => $value) { ?>
            <div class="singleqanswers">
                <p><?= $value->body ?></p>
                <i>From: <?= $value->ownerusername ?></i>
                <?php
                if ($value->acceptedanswer) {
                    ?><p>This is an accepted answer</p><?php
                } ?>
                <a href="<?= url("q/commenton?id=" . $value->id) ?>">Comment</a>
                </div>
                <?php
                if ($comments[$value->id]) {
                    foreach ($comments[$value->id] as $key => $value) {
                        ?><div class="comment"><?php
                        foreach ($value as $key1 => $value1) {
                            switch ($key1) {
                                case 'body':
                                // case 'score':
                                ?><p><?= $value1 ?></p><?php
                                break;
                                case 'username':
                                ?><p>comment by: <i><?= $value1 ?></i></p><?php
                                break;
                            }
                        }?>
                    </div><?php
                    }
                }
                ?>
        <?php
    }

    // Prepare classes
    $classes[] = "article";
    if (isset($class)) {
        $classes[] = $class;
    }


    ?>
    <article <?= classList($classes) ?>>
        <?= $newAnswer ?>
        <br>

    </article>
</article>
