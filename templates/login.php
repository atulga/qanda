<?php $title = "Нэвтрэх хэсэг"?>
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
    <td>
        <td><input type="submit" value="Нэвтрэх" name="login"/></td>
    </td>
  </tr>
  </table>
</form>
<a href="register">Шинээр бүртгүүлэх</a> | 
<a href="recover-password">Нууц үг сэргээх</a>

<?php $content = ob_get_clean() ?>
<?php include 'layout.php' ?>
