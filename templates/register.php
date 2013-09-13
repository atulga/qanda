<?php $title = "Бүртгэлийн хэсэг"?>
<?php ob_start() ?>
<form method="POST" action="">
<div class="form-group"> 
    <label for="Name">Нэр:</label>
        <input type="text" class="form-control1" name="name" value="<?php echo $form->getName() ?>"/>
        <i id='error_message'><?php echo $form->getError('name') ?></i>
  <div class="form-group">
    <label for="right">Нууц үг:</label>
        <input type="password" class="form-control1" name="password" value="<?php echo $form->getPassword() ?>"/>
        <i id='error_message'><?php echo $form->getError('password') ?></i>
  <div class="form-group">
    <label for="right">Нууц үг (ахин оруулах):</label>
        <input type="password" class="form-control1" name="password_again" value="<?php echo $form->getPasswordAgain() ?>"/>
        <i id='error_message'><?php echo $form->getError('password_again') ?></i>
      <br>
      <input type="submit" class="btn btn-primary" value="Бүртгүүлэх" name="submit"/>
</form>

<?php $content = ob_get_clean() ?>
<?php include 'layout.php' ?>
