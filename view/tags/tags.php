<?php

/**
 * Render content within an article - extended from anax/v2/article/default
 */

namespace Anax\View;

?>
<h1>Tags</h1>
<article>
<?php foreach ($content as $key => $value) { ?>
    <div class="tagbox">
    <?php
    if ($value->count > 3) {
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
