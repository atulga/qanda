<?php $title= 'Асуулт засах';
ob_start();
?>
    <a href="/qanda/index.php/show?question_id=
        <?php echo $question['id'] ?>">Буцах
    </a>
<h2>Асуулт засварлах хэсэг</h2>
<form method="POST" action='question_update'>
  <label>Гарчиг:</label>
  <input type="text" name="title"
    value="<?php echo $question['title']?>"size="105"/>
  <br/>
  <label>Асуулт:</label>
  <textarea rows="10" cols="80"
    name="question"><?php echo $question['question'] ?>
  </textarea>
  <br/>
  <br/>
  <input type="hidden" name="question_id"
        value="<?php echo $question['id'] ?>"/>
  <input type="submit" name="update" value="Шинэчлэх"/>
</form>
<?php $content=ob_get_clean() ?>
<?php include 'layout.php'?>
