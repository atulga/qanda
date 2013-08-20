<?php $title = "Асуулт асуух хэсэг" ?>

<?php ob_start() ?>
<form method="POST" action="">
  <table border="0">
  <tr>
    <td align="right">Асуултын гарчиг:</td>
    <td>
    <input type="text" name="title" value="<?php echo $form->getTitle() ?>"/>
    <i id='error_message'><?php echo $form->getError('title') ?></i>
    </td>
  </tr>
  <tr>
    <td align="right">Асуулт:</td>
    <td>
    <textarea rows="14" name="question" cols="60"><?php echo $form->getQuestion() ?></textarea>
    </td>
  </tr>
  <tr>
    <td></td>
    <td>
    <i id='error_message'><?php echo $form->getError('question') ?></i>
    </td>
  </tr>
  <tr>
    <td><input type="hidden" name="id" value="<?php echo $form->getId() ?>"/></td>
    <td>
      <input type="submit" value="Илгээх" name="submit">
    </td>
  </tr>
  </table>
</form>
<?php $content = ob_get_clean() ?>
<?php include 'layout.php' ?>
