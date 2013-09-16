<?php $title = "Нэвтрэх хэсэг"?>
<?php ob_start() ?>
<?php if (has_get('message')) echo get_param('message'); ?>
<form method="POST" action="">
<?php if($form->getError('name')){ ?>
<div class="form-group has-error">
    <label for="Name">Нэр:</label>
        <input type="text" class="form-control1" name="name" value="<?php echo $form->getName() ?>"/>
        <label class="control-label"><?php echo $form->getError('name') ?></label>
</div>
<?php } else { ?>
<div class="form-group">
    <label for="Name">Нэр:</label>
        <input type="text" class="form-control1" name="name" value="<?php echo $form->getName() ?>"/>
</div>
<?php } ?>
<?php if($form->getError('password')){ ?>
<div class="form-group has-error">
   <label for="Pass">Нууц үг:</label>
        <input type="password" class="form-control1" name="password" value="<?php echo $form->getPassword() ?>"/>
        <label class="control-label"><?php echo $form->getError('password') ?></label>
</div>
<?php } else { ?>
<div class="form-group">
   <label for="Pass">Нууц үг:</label>
        <input type="password" class="form-control1" name="password" value="<?php echo $form->getPassword() ?>"/>
</div>
<?php } ?>
<br>
    <button type="submit" class="btn btn-primary" value="Нэвтрэх" name="login">Login</button>
    <a href="register">Шинээр бүртгүүлэх</a>
</form>

<?php $content = ob_get_clean() ?>
<?php include 'layout.php' ?>
