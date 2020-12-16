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
<article>
<?php foreach ($content as $key => $value) { ?>
    <div style="margin: 5px; border: 1px solid black;">
    <?php
    foreach ($value as $key1 => $value1) {
        switch ($key1) {
            case "username": ?>
            <h4>User: <?= $value1?> </h4><?php
            break;
            case "reputation": ?>
            <p><?= $value1 ?> </p><?php
            break;
            case "info": ?>
            <p><?= $value1 ?> </p><?php
            break;
            case "gravatar": ?>
            <img
                class="gravatarAll"
                src="<?= $value1; ?>"
                alt="user-icon by gravatar"
                /><?php
            break;
        }
    }
    ?>
    </div>
<?php
} ?>
</article>
