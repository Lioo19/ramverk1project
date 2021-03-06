<?php

/**
 * Render content within an article - extended from anax/v2/article/default
 */

namespace Anax\View;

?>
<h1>All Users</h1>
<article class="allUsers">
<?php foreach ($content as $key => $value) { ?>
    <div class="userBox">
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
        </a>
    </div>
    <?php
} ?>
</article>
