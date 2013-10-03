<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../bootstrap/assets/ico/favicon.png">

    <title><?php echo $title ?></title>

    <link href="../bootstrap/dist/css/bootstrap.css" rel="stylesheet">

  </head>
  <body>
    <div class="navbar navbar-inverse navbar-fixed">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="/qanda/index.php">Нүүр хуудас</a></li>
            <li><a href="question_add">Асуулт оруулах</a></li>
            <?php if (logged_in()){ ?>
                <li><a href="profile?user_id=<?php echo $_SESSION['id'] ?> "><?php echo $_SESSION['name'] ; ?></a></li>
                <li><a href="logout">Гарах</a></li>
            <?php } else {?>
                <li><a href="login">Нэвтрэх</a></li>
            <?php }?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    
    <div class="container">
        <?php if (has_get('message')) {?>
            <div class="alert alert-success"><?php echo get_param('message'); ?></div>
        <?php } ?>
        <?php echo $content ?>
      </div>
    </div><!-- /.container -->

    <script src="../bootstrap/assets/js/jquery.js"></script>
    <script src="../bootstrap/dist/js/bootstrap.min.js"></script>
  </body>
</html>
