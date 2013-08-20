<?php $title = "Бүртгэлийн хэсэг"?>
<?php ob_start() ?>

<form method="POST" action="">
  <table border="0">
  <tr>
    <td align="right">Нэр:</td>
    <td>
        <input type="text" name="name" value="<?php echo $form->getName() ?>"/>
        <i id='error_message'><?php echo $form->getError('name') ?></i>
    </td>
  </tr>
   <tr>
    <td align="right">Нууц үг:</td>
    <td>
        <input type="password" name="password" value="<?php echo $form->getPassword() ?>"/>
        <i id='error_message'><?php echo $form->getError('password') ?></i>
    </td>
  </tr>
  <tr>
    <td align="right">Нууц үг (ахин оруулах):</td>
    <td>
        <input type="password" name="password_again" value="<?php echo $form->getPasswordAgain() ?>"/>
        <i id='error_message'><?php echo $form->getError('password_again') ?></i>
    </td>
   </tr>
   <tr>
    <td></td>
    <td>
      <input type="submit" value="Бүртгүүлэх" name="submit"/>
    </td>
  </tr>
  </table>
</form>

<?php $content = ob_get_clean() ?>
<?php include 'layout.php' ?>
