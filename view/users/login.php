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


?><article <?= classList($classes) ?>>
<?= $content ?>
<p>Not a member?<br>
<a href="<?= url("user/create") ?>">Sign up</a></p>
<br>

</article>
