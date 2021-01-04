<?php

/**
 * Render all Questions
 */

namespace Anax\View;
?>
<h1>All Qs</h1>
<article>
<?php foreach ($content as $key => $value) { ?>
    <div style="margin: 5px; border: 1px solid black;">
        <a href="<?= url("q/showq?id=" . $value->id)?>">
            <h2><?= $value->title?></h2>
            <h5><?= $value->body?></h5>
            <p><i>Q asked by: <?= $value->ownerusername?></i></p>
    </div>
    <?php
} ?>
</article>
