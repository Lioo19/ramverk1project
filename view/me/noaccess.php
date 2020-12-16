<?php

namespace Anax\View;

/**
 * Failpage me
 */

?>
<h1>Please login to view your profile</h1>

<div style="height: 400px;">
    <h4>You cannot view your profile if you're not logged in</h4>
    <p><a href="<?= url("user/login") ?>">Sign In</a></p>
    <p>
    <p>or
        <br>
        <br>
        <a href="<?= url("user/create") ?>">Sign Up</a>
        <br>
    </p>
    <br>
    <br>
</div>
