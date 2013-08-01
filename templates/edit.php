<?php $title= 'Асуулт засах';
ob_start();
?>
    <a href="/qanda/index.php/show?question_id=
        <?php echo $question['id'] ?>">Буцах
    </a>
<h2>Асуулт засварлах хэсэг</h2>
<form method="POST" action='question_update'>
  <table border="0">
    <tr>
      <td align="right">Гарчиг:</td>
      <td><input type="text" name="title"
        value="<?php echo $question['title']?>"size="105"/></td>
    </tr>
    <tr>
      <td align="right">Асуулт:</td>
      <td><textarea rows="10" cols="80"
    name="question"><?php echo $question['question'] ?>
  </textarea>
      </td>
    </tr>
    <tr>
      <td></td>
      <td><input type="hidden" name="question_id"
        value="<?php echo $question['id'] ?>"/>
  <input type="submit" name="update" value="Шинэчлэх"/>
      </td>
  </table>
</form>
<?php $content=ob_get_clean() ?>
<?php include 'layout.php'?>
