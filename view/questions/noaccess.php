<?php

/*
*Page redirecting you to login page
*/

namespace Anax\View;

?>
<h1>Please login to ask a new question</h1>

<div style="height: 400px;">
    <h4>To ask or answer questions, you need to be logged in</h4>
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
