<?php

/**
 * Startpage
 */

namespace Anax\View;

?>
<h1>WELCOME</h1>

<div style="height: 400px;">
    <h4>You cannot view your profile if you're not logged in</h4>
    <p><a href="<?= url("user/signin") ?>">Sign In</a></p>
    <p>
    <p>or
        <br>
        <br>
        <a href="<?= url("user/signup") ?>">Sign Up</a>
        <br>
    </p>
    <br>
    <br>
</div>
