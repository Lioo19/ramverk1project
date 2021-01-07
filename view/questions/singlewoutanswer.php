<?php

/**
 * Render content within an article - extended from anax/v2/article/default
 */

namespace Anax\View;

?>
<article class="singleq">
<?php foreach ($question as $key => $value) { ?>
    <article>
        <?php
        switch ($key) {
            case 'id':
                // code...
                break;
            case 'title':
                ?><h1><?= $value ?></h1><?php
                break;
            case 'body':
                ?><p><?= $value ?></p><?php
                break;
            default:
                ?><p><?= "$key" . ": $value" ?></p><?php
                break;
        }
        ?>
    </article>
    <?php
}
?>
<article class="singleq">
<?php foreach ($answers as $key => $value) { ?>
    <article>
        <?php
        switch ($key) {
            default:
                ?><p><?= "$key" . ": $value" ?></p><?php
                break;
        }
        ?>
    </article>
    <?php
}?>

</article>
