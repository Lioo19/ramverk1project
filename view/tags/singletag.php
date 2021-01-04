<?php

/**
 * Render content within an article - extended from anax/v2/article/default
 */

namespace Anax\View;

?>
<h1>Questions tagged with <?= $tagname?></h1>
<article>
<?php foreach ($questions as $key => $value) { ?>
    <div class="qBox">
        <a href="<?= url("q/showq?id=" . $value["id"])?>">
            <h2><?= $value["title"]?></h2>
            <h5><?= $value["body"]?></h5>
            <p><i>Q asked by: <?= $value["ownerusername"]?></i></p>
    </div>
    <?php
} ?>
</article>
