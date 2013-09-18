<?php $title = "Бүртгэлийн хэсэг"?>
<?php ob_start() ?>
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
    <label for="right">Нууц үг:</label>
        <input type="password" class="form-control1" name="password" value="<?php echo $form->getPassword() ?>"/>
        <label class="control-label"><?php echo $form->getError('password') ?></label>
</div>
<?php } else { ?>
  <div class="form-group">
    <label for="right">Нууц үг:</label>
        <input type="password" class="form-control1" name="password" value="<?php echo $form->getPassword() ?>"/>
</div>
<?php } ?>
<?php if($form->getError('password_again')){ ?>
  <div class="form-group has-error">
    <label for="right">Нууц үг (ахин оруулах):</label>
        <input type="password" class="form-control1" name="password_again" value="<?php echo $form->getPasswordAgain() ?>"/>
        <label class="control-label"><?php echo $form->getError('password_again') ?></label>
</div>
<?php } else { ?>
<div class="form-group">
    <label for="right">Нууц үг (ахин оруулах):</label>
        <input type="password" class="form-control1" name="password_again" value="<?php echo $form->getPasswordAgain() ?>"/>
</div>
<?php } ?>
      <br>
      <input type="submit" class="btn btn-primary" value="Бүртгүүлэх" name="submit"/>
</form>

<?php $content = ob_get_clean() ?>
<?php include 'layout.php' ?>
