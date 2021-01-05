<?php

/**
 * Render content within an article - extended from anax/v2/article/default
 */

namespace Anax\View;

?>
<h1 class="tagsh1">Tags</h1>
<article class="tagbox">
<?php foreach ($content as $key => $value) { ?>
    <div class="singletag">
    <?php
    if ($key > 40) {
        break;
    } elseif ($value->count > 5) {
        ?>
        <a
            style="font-size: 180%;"
            href="<?= url("tags/showsingle?id=" . $value->id . "&name=" . $value->tagname) ?>"
            >
            <?= $value->tagname?>
        </a><?php
    } elseif ($value->count > 3) {
        ?>
        <a
            style="font-size: 150%;"
            href="<?= url("tags/showsingle?id=" . $value->id . "&name=" . $value->tagname) ?>"
            >
            <?= $value->tagname?>
        </a><?php
    } elseif($value->count > 1) {
        ?>
        <a
            style="font-size: 125%;"
            href="<?= url("tags/showsingle?id=" . $value->id . "&name=" . $value->tagname) ?>"
            >
            <?= $value->tagname?>
        </a><?php
    } else {
        ?>
        <a
            href="<?= url("tags/showsingle?id=" . $value->id . "&name=" . $value->tagname) ?>"
            >
            <?= $value->tagname?>
        </a><?php
    }
    ?>
    </div><?php
} ?>
</article>
