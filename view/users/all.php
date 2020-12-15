<?php

namespace Anax\View;

/**
 * Render content within an article - extended from anax/v2/article/default
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

// Prepare classes
$classes[] = "article";
if (isset($class)) {
    $classes[] = $class;
}



?>
<h1>All Users</h1>
<article <?= classList($classes) ?>>
<?= $content ?>
</article>

<p>Test for adding stuff</p>
