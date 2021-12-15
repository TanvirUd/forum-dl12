<?php 
    use App\Service\Session;
    $topic = $response["data"]["topic"];
    $category = $response["data"]["category"];
?>

<section class="topicBox">
    <?php 
        foreach($topic as $tpc)
        {
        ?> 
            <div class="topic_name">
                <h2>
                    <a href="?ctrl=post&action=allPostByTopic&id=<?=$tpc->getId()?>"><?=$tpc->getName()?></a>
                </h2>
            </div>
        <?php
        }
    ?>
</section>
<section class="insertBox">
    <form action="?ctrl=topic&action=insertTopicByUser" method="post">
        <p>
            <label>
                <select name="category" class="categorySelect">
                    <?php
                    foreach($category as $cat)
                    {
                        ?>
                        <option value="<?=$cat->getId()?>">
                            <?= $cat->getName()?>
                        </option>
                        <?php
                    }
                    ?>
                </select>
            </label>
        </p>
        <p>
            <label>
                <textarea name="topic" rows="1" placeholder="Submit a topic:"></textarea>
            </label>
        </p>
        <p>
        <?php if(empty(Session::get("user"))){?>
                <a href="?ctrl=security&action=login">Please login to post</a>
            <?php } else { ?>
                <input type="submit" value="Submit">
            <?php }?>
        </p>
    </form>
</section>