<?php

/**
 * Startpage
 */

namespace Anax\View;

?>
<article class="startpage">
    <div class="startQs">
        <h3>Latest Qs</h3>
        <?php foreach ($fourQs as $key => $value) { ?>
            <div class="qBox">
                <a href="<?= url("q/showq?id=" .  $value->id)?>">
                    <h2><?= $value->title?></h2>
                    <p><i>Q asked by: <?= $value->ownerusername?></i></p>
                </a>
            </div>
            <?php
        } ?>
    </div>
    <div class="startTags">
    <h3>Popular Tags</h3>
    <?php foreach ($threeTags as $key => $value) { ?>
            <a
                href="<?= url("tags/showsingle?id=" . $value->id . "&name=" . $value->tagname) ?>"
            >
                <?= $value->tagname ?>
            </a>
        <?php
    } ?>
    </div>
    <div class="startUsers">
        <h3>Top Users</h3>
        <?php foreach ($threeUsers as $key => $value) { ?>
            <div class="userBox">
            <a
                href=<?= url("user/singleuser?username=" . $value["username"])?>>
                <p>
                    <img
                    class="gravatarAll"
                    src="<?= $value["gravatar"]; ?>"
                    alt="user-icon by gravatar"
                />
                <h2><?= $value["username"]?></h2>
                <p><?= $value["reputation"]?> points</p>
            </a>
        </div>
            <?php
        } ?>
    </div>
</article>
