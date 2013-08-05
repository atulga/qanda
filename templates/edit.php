<?php $title = 'Асуулт засах';
ob_start();
?>
<a href="/qanda/index.php/show?question_id=
    <?php echo $question['id'] ?>">Буцах
</a>
<h2>Асуулт засварлах хэсэг</h2>

<form method="POST" action="">
  <table border="0">
    <tr>
      <td align="right">Гарчиг:</td>
      <td>
        <input type="hidden" name="name" value="<?php echo $form_edit->getName() ?>"/>
        <input type="text" name="title"
        value="<?php echo $form_edit->getTitle() ?>"/>
        <i id='error_message'><?php echo $form_edit->getError('title') ?></i>
      </td>
    </tr>
    <tr>
      <td align="right">Асуулт:</td>
      <td>
        <textarea rows="6" cols="60" name="question"><?php echo $form_edit->getQuestion() ?></textarea>
        <i id='error_message'><?php echo $form_edit->getError('question') ?></i>
      </td>
    </tr>
    <tr>
      <td></td>
      <td><input type="hidden" name="id"
        value="<?php echo $question['id'] ?>"/>
        <input type="submit" name="update" value="Шинэчлэх"/>
      </td>
    </tr>
  </table>
</form>
<?php $content = ob_get_clean() ?>
<?php include 'layout.php'?>
