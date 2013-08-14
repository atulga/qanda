<?php $title = 'Асуулт засах';
ob_start();
?>
<a href="/qanda/index.php/show?question_id=
    <?php echo $form->getId() ?>">Буцах
</a>
<h2>Асуулт засварлах хэсэг</h2>

<form method="POST" action="">
  <table border="0">
    <tr>
      <td align="right">Гарчиг:</td>
      <td>
        <input type="hidden" name="name" value="<?php echo $form->getName() ?>"/>
        <input type="text" name="title"
        value="<?php echo $form->getTitle() ?>"/>
        <i id='error_message'><?php echo $form->getError('title') ?></i>
      </td>
    </tr>
    <tr>
      <td align="right">Асуулт:</td>
      <td>
        <textarea rows="6" cols="60" name="question"><?php echo $form->getQuestion() ?></textarea>
        <i id='error_message'><?php echo $form->getError('question') ?></i>
      </td>
    </tr>
    <tr>
      <td></td>
      <td><input type="hidden" name="id"
        value="<?php echo $form->getId() ?>"/>
        <input type="submit" name="update" value="Шинэчлэх"/>
      </td>
    </tr>
  </table>
</form>

<?php
$v = "asdf\r\nasdf\r\nasssss";
echo $v;
var_dump($v);
echo '-------------<br/>';
$v = mysql_real_escape_string($v);
echo $v;
var_dump($v);
echo '-------------<br/>';
echo $v;
$v = mysql_real_escape_string($v);
var_dump($v);
?>

<?php $content = ob_get_clean() ?>
<?php include 'layout.php'?>
