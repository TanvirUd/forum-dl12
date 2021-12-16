<?php 
    use App\Service\Session;
    $comments = $response["data"]["comments"];
    $post = $response["data"]["post"];
    $topicId = $post->getTopic()->getId();
?>

<section class="commentBox">
<a href="?ctrl=post&action=allPostByTopic&id=<?=$topicId?>" class="commentRedirect">Return</a>
    <h2 class="postOfComment"><?=$post->getContent()?></h2>
    <?php
        foreach($comments as $cmt){
        ?>
            <div class="comments">
                <p><?=$cmt->getContent()?></p>
            </div>
        <?php
        }
    ?>
</section>
<section class="insertBox">
    <form action="?ctrl=comment&action=insertCommentByUser&id=<?=$post->getId()?>" method="post">
        <p>
            <label>                
                <textarea name="comment" rows="1" placeholder="Submit a comment:"></textarea>
            </label>
        </p>
        <p>
            <?php if(empty(Session::get("user"))){?>
                <a href="?ctrl=security&action=login">Please login to post</a>
            <?php } else { ?>
                <input type="submit" value="Submit">
                <input type="hidden" name="csrf_token" value="<?= $token ?>">
            <?php }?>
        </p>
    </form>
</section>