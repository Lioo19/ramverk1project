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
<h1>All Qs</h1>
<article>
<?php foreach ($content as $key => $value) { ?>
    <div style="margin: 5px; border: 1px solid black;">
        <a href="q/showq?id=<?= $value["postid"]?>">
            <h2><?= $value["title"]?></h2>
            <h5><?= $value["body"]?></h5>
            <p><i>Q asked by: <?= $value["ownerusername"]?></i></p>
    </div>
    <?php
} ?>
</article>
