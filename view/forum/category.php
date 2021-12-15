<?php
    $category = $response["data"]["category"];
    $topic = $response["data"]["topic"];
?>

<section class="insertBox">
    <nav id="categoryBox">
        <?php
            foreach($category as $cat)
            {
            ?>
                <a href="?ctrl=topic&action=AllTopicByCategory&id=<?=$cat->getId()?>"><?=$cat->getName()?></a>
            <?php
            }
        ?>
    </nav>
</section>