<?php

/**
 * Frontpage for profilpage
 */

namespace Anax\View;

?>
<h1>All about you</h1>

<div style="height: 600px; text-align: center;">
    <img src="<?= $content["grav_url"]; ?>" alt="user-icon by gravatar" />
    <h2 class="profileh1"><?= $content["username"]?></h2>
    <h4>Email: <?= $content["email"]?></h4>
    <p>Member since: <?= $content["created"]?></p>
    <p>Description: <?= $content["info"]?></p>
    <p>Reputation: <?= $content["reputation"]?></p>
    <a href="<?= url("user/singleuser?username=" . $content["username"]) ?>">
        Your activity
    </a>
    <p>
        <a class="updatebutton" href="<?= url("me/update") ?>">
            Update Profile
        </a>
    </p>

    <br>
    <br>
</div>
