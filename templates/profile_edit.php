<?php $title = 'Профайл';
ob_start();
?>
<a href="/qanda/index.php/profile">Back
</a>
<h3>Field for Edit Profile</h3>
<form method="POST" action="">
  <table>
    <tr>
      <td align="right">Your Name:</td>
      <td>
        <input type="text" name="nickname" value="<?php echo $user->getNickname(); ?>"/>
        <i id='error_message'><?php echo $user->getError('title') ?></i>
      </td>
    </tr>
    <tr>
      <td align="right">Description:</td>
      <td>
        <textarea name="description" cols="40" rows="10" > <?php echo $user->getDescription(); ?> </textarea>
        <i id='error_message'><?php echo $user->getError('title') ?></i>
      </td>
    </tr>
    <tr>
      <td></td>
      <td>
        <input type="hidden" name="id" value="<?php echo $user->getId(); ?>">
        <input type="submit" name="update" value="Шинэчлэх"/>
      </td>
    </tr>
  </table>
</form>

<?php $content = ob_get_clean() ?>
<?php include 'layout.php'?>
