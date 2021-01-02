<?php

/**
 * Render content within an article - extended from anax/v2/article/default
 */

namespace Anax\View;

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

// Prepare classes
// $classes[] = "article";
// if (isset($class)) {
//     $classes[] = $class;
// }

?>
<article>
    <article class="singleq" style="border:1px solid green;margin-bottom: 10px;">
    <?php foreach ($question as $key => $value) { ?>
        <article>
            <?php
            switch ($key) {
                case 'id':
                    // code...
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
    ?>
    </article>
    <article class="singleq">
    <?php foreach ($answers as $key => $value) { ?>
        <article style="border: 1px solid black; margin: 12px; padding: 5px;">
            <h3>Answers</h3>
            <div style="background-color: beige; margin: 10px; padding: 5px;">
                <?php
                foreach ($value as $key1 => $value1) {
                    switch ($key1) {
                        case 'id':
                            // code...
                            break;
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
