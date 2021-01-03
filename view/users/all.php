<?php

/**
 * Render content within an article - extended from anax/v2/article/default
 */

namespace Anax\View;
var_dump($content)

?>
<h1>All Users</h1>
<article>
<?php foreach ($content as $key => $value) { ?>
    <div style="margin: 5px; background-color: beige;">
    <a
        href=<?= url("user/singleuser?username=" . $value["username"])?>>
        <p>
            <img
            class="gravatarAll"
            src="<?= $value["gravatar"]; ?>"
            alt="user-icon by gravatar"
        />
        <h2><?= $value["username"]?></h2>
        <p><?= $value["reputation"]?> points</p>
        <p><?= $value["info"]?></p>
    </a>
    <?php
} ?>
</article>
