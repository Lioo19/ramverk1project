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
        <?php

    // Prepare classes
    $classes[] = "article";
    if (isset($class)) {
        $classes[] = $class;
    }


    ?>
    <article <?= classList($classes) ?> style="margin: 12px;">
        <?= $newComment ?>
        <br>

    </article>
</article>

<?php
// var_dump($question);
// var_dump($answers); ?>
