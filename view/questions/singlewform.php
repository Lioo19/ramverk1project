<?php

/**
 * Render content within an article - extended from anax/v2/article/default
 */

namespace Anax\View;

?>
<article>
    <article>
        <div class="singleq">
            <div class="votelink">
                <a href="<?= url("q/updatevote?id=" . $question["id"] . "&value=1&type=q") ?>">upvote</a>
                <a href="<?= url("q/updatevote?id=" . $question["id"] . "&value=-1&type=q") ?>">downvote</a>
            </div>
            <h1><?= $question["title"]?></h1>
            <p><?= $question["body"] ?></p>
            <p>Q asked by <i><?= $question["ownerusername"] ?></i></p>
            <p>Points: <?= $votesForQ ?>
            <a class="commentlink" href="<?= url("q/commenton?id=" . $question["id"]) ?>">Comment</a></p>
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
            ?><p><?= $value1 ?></p><?php
            break;
        case 'username':
            ?><p>comment by: <i><?= $value1 ?></i></p><?php
            break;
        case 'id':
            ?>
            <div class="votelink">
                <a href="<?= url("q/updatevote?id=" . $value1 . "&value=1&type=qcomment") ?>">upvote</a>
                <a href="<?= url("q/updatevote?id=" . $value1 . "&value=-1&type=qcomment") ?>">downvote</a>
            </div><?php
            break;
        case 'votes':
            ?><p>Points: <?= $value1 ?></p><?php
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
                <div class="votelink">
                    <a href="<?= url("q/updatevote?id=" . $value->id . "&value=1&type=answer") ?>">upvote</a>
                    <a href="<?= url("q/updatevote?id=" . $value->id . "&value=-1&type=answer") ?>">downvote</a>
                </div>
                <p><?= $value->body ?></p>
                <i>From: <?= $value->ownerusername ?></i>
                <p>Points: <?= $value->votes ?>
                <a  class="commentlink" href="<?= url("q/commenton?id=" . $value->id) ?>">Comment</a></p>
                <?php
                //Link for marking as accepted answer, if the person logged in is the same as questionasker
                //link leading to answer-id OBS OBS
                if ($value->acceptedanswer === "true") {
                    ?><p class="tiny">This is an accepted answer </p>
                    <a href="<?= url("q/unacceptanswer?id=" . $value->id) ?>">unaccept</a><?
                } elseif ($loggedin === $question["ownerusername"]) {
                    ?><a class="commentlink" href="<?= url("q/acceptanswer?id=" . $value->id) ?>">mark as accepted answer</a>
                    <?php
                }?>
            </div>
            <?php
            if ($comments[$value->id]) {
                foreach ($comments[$value->id] as $key => $value) {
                    ?><div class="comment"><?php
// This writes the comments for each answer
foreach ($value as $key1 => $value1) {
    switch ($key1) {
        case 'body':
            ?><p><?= $value1 ?></p><?php
            break;
        case 'username':
            ?><p>comment by: <i><?= $value1 ?></i></p><?php
            break;
        case 'id':
            ?>
            <a class="votelink" href="<?= url("q/updatevote?id=" . $value1 . "&value=1&type=anscomment") ?>">upvote</a>
            <a class="votelink" href="<?= url("q/updatevote?id=" . $value1 . "&value=-1&type=anscomment") ?>">downvote</a><?php
            break;
        case 'votes':
            ?><p>Points: <?= $value1 ?></p><?php
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
