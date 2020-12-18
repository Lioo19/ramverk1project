<?php

/**
 * Frontpage for profilpage
 */

namespace Anax\View;

?>
<h1>All about you</h1>

<div style="height: 600px; text-align: center;">
    <h1 class="profileh1"><?= $content["username"]?></h1>
    <img src="<?= $content["grav_url"]; ?>" alt="user-icon by gravatar" />
    <h4>Email: <?= $content["email"]?></h4>
    <p>Member since: <?= $content["created"]?></p>
    <p>Description: <?= $content["info"]?></p>
    <p>Reputation: <?= $content["reputation"]?></p>
    <p>Votes: <?= $content["votes"]?></p>

    <p>
        <a class="updatebutton" href="<?= url("me/update") ?>">
            Update Profile
        </a>
    </p>

    <br>
    <br>
</div>
