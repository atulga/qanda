<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <link href="/qanda/css/main.css" rel="stylesheet">
        <title><?php echo $title ?></title>
    </head>
    <body>
        <div id="header">
            <h3>
                <a href="/qanda/index.php">Нүүр хуудас</a> |
                <a href="question_add">Асуулт оруулах</a> | 
                <?php if(logid_in()){ ?>
                    <a href="profile?user_id=<?php echo $_SESSION['id'] ?> "><?php echo $_SESSION['name'] ; ?></a> | 
                    <a href="logout">Гарах</a>
                <?php } else {?>
                    <a href="login">Нэвтрэх</a>
                <?php }?>
            </h3>
        </div>
        <div id="content">
        <?php echo $content ?>
        </div>
    </body>
</html>

