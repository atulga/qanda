<?php $title = $question['title'] ?>

<?php ob_start(); ?>

<a href="/qanda/index.php">Буцах</a>
<form method="POST" action="index.php">
  <h2><?php echo $question['title']; ?></h2>
  <?php echo "Үүссэн огноо:". $question['createdate']." Асуулт асуугч:".$question['name'];?>
  <?php
  if($question['result'] == "0"){?>
      <input type="checkbox" name="resulted" value="1">Хариултаа авсан эсэх
  <?php } else {?>
      <input type="checkbox" name="resulted" value="1" checked>Хариултаа авсан
  <?php } ?>
  <br/>
  Асуулт:
  <br/>
  <?php
      echo $question['question'];
      $question_id = $question['id'];
  ?>
  <input type="hidden" name="question_id" value="<?php echo $question_id ?>">
  <br/>
  <input type="submit" name="edit" value="Засах"/>
</form>
<hr/>
<h2>Хариултууд</h2>
<form method="POST" action="index.php">
  <table border="0" >
  <?php foreach ($answers as $answer){?>
    <tr>
      <td><?php echo $answer['name'] ?></td>
      <td></td>
      <td><?php echo $answer['createdate'] ?></td>
    </tr>
    <tr>
      <td colspan="3"><?php echo $answer['answer'] ?></td>
    </tr>
    <tr>
      <td colspan="2"><hr/></td>
      <input type="hidden" name="answer_id_delete" value="<?php echo $answer['id'] ?>">
      <td><input type="submit" name="answer_delete" value="Хариулт устгах"></td>
    </tr>
  <?php } ?>
  </table>
</form>
<hr/>
<form method="POST" action="answer_add">
  <table border = "0">
    <tr>
        <td>Хариулагчийн нэр:</td>
        <td>
            <input type="text" name = "name" size="30">
            <input type="hidden" name = "question_id" value="<?php echo $question_id; ?>">
        </td>
    </tr>
    <tr>
        <td>Хариулт:</td>
        <td>
          <textarea rows = "3" cols = "60" name = "answer" ></textarea>
            <input type = "submit" value = "Илгээх" name = "submit">
        </td>
    </tr>
  </table>
</form>
<?php $content = ob_get_clean() ?>

<?php include 'layout.php' ?>
