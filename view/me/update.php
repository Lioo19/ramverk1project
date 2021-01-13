<?php

/**
 * Render content within an article - extended from anax/v2/article/default
 */

namespace Anax\View;

// Prepare classes
$classes[] = "article";
if (isset($class)) {
    $classes[] = $class;
}

?><article <?= classList($classes) ?>>
<?= $content ?>
<br>
</article>
