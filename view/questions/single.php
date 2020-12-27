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
<article class="singleq">
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
            default:
                ?><p><?= "$key" . ": $value" ?></p><?php
                break;
        }
        ?>
    </article>
    <?php
}
?>
<article class="singleq">
<?php foreach ($answers as $key => $value) { ?>
    <article>
        <?php
        switch ($key) {
            default:
                ?><p><?= "$key" . ": $value" ?></p><?php
                break;
        }
        ?>
    </article>
    <?php
}

// Prepare classes
$classes[] = "article";
if (isset($class)) {
    $classes[] = $class;
}


?><article <?= classList($classes) ?>>
<?= $newAnswer ?>
<br>

</article>
</article>
