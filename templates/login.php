<?php $title = "Нэвтрэх хэсэг"?>
<?php ob_start() ?>
<?php if (has_get('message')) echo get_param('message'); ?>
<form method="POST" action="">
<div class="form_group">
    <label for="Name">Нэр:</label>
        <input type="text" class="form-control1" name="name" value="<?php echo $form->getName() ?>"/>
        <i id='error_message'><?php echo $form->getError('name') ?></i>
</div>
<div class="form_group">
   <label for="Pass">Нууц үг:</label>
        <input type="password" class="form-control1" name="password" value="<?php echo $form->getPassword() ?>"/>
        <i id='error_message'><?php echo $form->getError('password') ?></i>
</div>
<br>
    <button type="submit" class="btn btn-primary" value="Нэвтрэх" name="login">Login</button>
    <a href="register">Шинээр бүртгүүлэх</a>
</form>

<?php $content = ob_get_clean() ?>
<?php include 'layout.php' ?>
