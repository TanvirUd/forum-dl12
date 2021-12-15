<?php

use App\Service\Session;

$post = $response["data"]["post"];
    $comments = $response["data"]["comments"];
    $topic = $response["data"]["topic"];
?>
<section class="postBox">
    <h2 class="topicOfPost"><?= $topic->getName() ?></h2>
    <?php
        if(empty($post)){
        ?>
            <h3>This thred is empty :(</h3>
        <?php
        } else {
            foreach($post as $pst)
            {
            ?>
                <div class="postBox">
                    <h3><a href="?ctrl=comment&action=allCommentsByPost&id=<?=$pst->getId()?>" class="commentRedirect"><?=$pst->getContent()?></a></h3>
                    <div class="commentBox">
                        <?php 
                        if(!empty($comments)){
                            foreach($comments as $cmt){
                                $cmt = array_slice($cmt, 0, 2);
                                foreach($cmt as $c)
                                {
                                ?>
                                    <p><?=$c->getContent()?></p>
                                <?php
                                }
                            } ?>
                            
                            <?php
                            unset($comments);
                        } else {
                        ?>
                        <p class="commentEmpty">There is no comment in this thred</p>
                        <?php 
                        } ?>
                    </div>
                </div>
            <?php
            }
        }
    ?>
</section>
<section class="insertBox">
    <form action="?ctrl=post&action=insertPostByUser&id=<?=$topic->getId()?>" method="post">
        <p>
            <label>
                <textarea name="post" rows="1" placeholder="Submit a post:"></textarea>
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