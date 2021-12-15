<?php
    use App\Service\Session;
    use App\Service\CategoryNav;
    $categories = CategoryNav::get();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= CSS_PATH ?>style.css">
    <title>STORE</title>
</head>
<body>
<header>
        <nav>
            <span>
                <img src="https://via.placeholder.com/80.png?text=LOGO" alt="logo">
            </span>
            <a href="?ctrl=topic">Home</a>
            <?php
                if($user = Session::get("user")){
                    if($user->getRole() == "ROLE_ADMIN"){
                        ?>
                        <a href="?ctrl=admin">Administration</a>
                        <?php
                    }
                    ?>
                    <span><?= ucfirst($user->getUsername()) ?></span>
                    <a href="?ctrl=security&action=logout">Déconnexion</a>
                    <?php
                }
                else{
                    ?>
                    <a href="?ctrl=security&action=login">Connexion</a>
                    <a href="?ctrl=security&action=register">Inscription</a>
                    <?php
                }
            ?>
        </nav>
        <?php
            if($message = Session::get("message")){
                ?>
                <p id="message" class='<?= $message['type'] ?>'>
                    <?= $message['msg'] ?> 
                </p>
                <?php
                Session::remove("message");
            }
        ?>
    </header>

    <main>
        <aside>
            <?php 
                foreach($categories as $category){?>
                    <a href="?ctrl=topic&action=AllTopicByCategory&id=<?=$category->getId()?>"><?=$category->getName()?></a>
                <?php }
            ?>
        </aside>
        <div id="content">
            <?= $content ?>
        </div>        
    </main>
    
    <footer>
        <p>&copy; 2021 - Forum - All Rights Reserved</p>        
    </footer>
</body>
</html>