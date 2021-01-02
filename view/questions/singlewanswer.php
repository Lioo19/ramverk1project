<?php

/**
 * Render content within an article - extended from anax/v2/article/default
 */

namespace Anax\View;

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>
<article>
    <article class="singleq" style="border:1px solid green;margin-bottom: 10px; padding: 5px;">
    <?php foreach ($question as $key => $value) { ?>
        <article>
            <?php

            switch ($key) {
                case 'id':
                    ?><a href="<?= url("q/commenton?id=" . $value) ?>">Comment</a><?php
                    break;
                case 'title':
                    ?><h1><?= $value ?></h1><?php
                    break;
                case 'body':
                    ?><p><?= $value ?></p><?php
                    break;
                case 'ownerusername':
                    ?><p>Q asked by <i><?= $value ?></i></p><?php
                    break;
            }
            ?>
        </article>
        <?php
        }
        foreach ($question as $key1 => $value1) {
            switch ($key1) {
                case 'id':
                if ($comments[$value1]) {
                    foreach ($comments[$value1] as $key => $value) {
                        foreach ($value as $key1 => $value1) {
                            ?>
                            <div class="comment"> <?php
                            switch ($key1) {
                                case 'body':
                                // case 'score':
                                ?><p><?= $value1 ?></p><?php
                                break;
                                case 'username':
                                ?><p>comment by: <i><?= $value1 ?></i></p><?php
                                break;
                            }
                            ?>
                            </div> <?php
                        }
                    }
                }
            }
        }
    ?>
    </article>
    <article class="singleq">
        <h3>Answers</h3>
    <?php foreach ($answers as $key => $value) { ?>
        <article style="border: 1px solid black; margin: 12px; padding: 5px;">
            <div style="background-color: beige; margin: 10px; padding: 5px;">
                <?php
                foreach ($value as $key1 => $value1) {
                    switch ($key1) {
                        case 'body':
                            ?><p><?= $value1 ?></p><?php
                            break;
                        case 'ownerusername':
                            ?><i>From: <?= $value1 ?></i><?php
                            break;
                        case 'acceptedanswer':
                            if ($value1) {
                                ?><p>This is an accepted answer</p><?php
                            }
                            break;
                    }
                }
                foreach ($value as $key1 => $value1) {
                    switch ($key1) {
                        case 'id':
                        if ($comments[$value1]) {
                            foreach ($comments[$value1] as $key => $value) {
                                foreach ($value as $key1 => $value1) {
                                    ?>
                                    <div class="comment"> <?php
                                    switch ($key1) {
                                        case 'body':
                                        // case 'score':
                                        ?><p><?= $value1 ?></p><?php
                                        break;
                                        case 'username':
                                        ?><p>comment by: <i><?= $value1 ?></i></p><?php
                                        break;
                                    }
                                    ?>
                                    </div> <?php
                                }
                            }
                        }
                    }
                }
                ?>
            </div>
        </article>
        <?php
    }

    // Prepare classes
    $classes[] = "article";
    if (isset($class)) {
        $classes[] = $class;
    }


    ?>
    <article <?= classList($classes) ?> style="margin: 12px;">
        <?= $newAnswer ?>
        <br>

    </article>
</article>

<?php
// var_dump($question);
// var_dump($comments);
// var_dump($answers); ?>
