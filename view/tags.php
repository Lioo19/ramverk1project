<?php

/**
 * Render content within an article - extended from anax/v2/article/default
 */

namespace Anax\View;

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

// Prepare classes
$classes[] = "article";
if (isset($class)) {
    $classes[] = $class;
}

?>
<h1>All Tags</h1>
<article>
<?php foreach ($content as $key => $value) { ?>
    <div style="margin: 5px; border: 1px solid black;">
    <?php
    foreach ($value as $key1 => $value1) {
        switch ($key1) {
            case "tagid":
                ?><a href="tags/tag?id=<?= $value1 ?>"><?php
            case "ownerusername":
                ?><h4>User: <?= $value1?> </h4><?php
                break;
            case "title":
            case "body":
                ?><p><?= $value1 ?> </p><?php
                break;
        }
    }
    ?>
    </div>
    <?php
} ?>
</article>
