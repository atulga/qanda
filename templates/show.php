<?php $title = $question['title'] ?>

<?php ob_start(); ?>

<table border="0">
    <tr>
      <td colspan="2"><h2><?php echo $question['title']; ?></h2></td>
    </tr>
    <tr>
      <td><?php echo "Нэр:".$question['name'];?></td>
      <td align="right"><?php echo "Огноо:".$question['create_date'] ?></td>
    </tr>
    <tr>
      <td colspan="2">
        <?php
          echo $question['question'];
          $question_id = $question['id'];
        ?>
      </td>
    </tr>
    <tr>
      <td>
        <a href="question_edit?question_id=<?php echo $question['id'] ?>">
          Засах
        </a>
      </td>
      <td align="right">
        <a href="delete_question?question_id=<?php echo $question['id'] ?>">
           Устгах
        </a>
      </td>
    </tr>
</table>
<hr/>
<h2>Хариултууд</h2>
<table border="0" >
<?php foreach ($answers as $answer){?>
  <tr>
    <td><?php echo $answer['name'] ?></td>
    <td align="right">
        <a href="best_answer?question_id=<?php echo $question['id'] ?>&answer_id=<?php echo $answer['id'] ?>">Зөв хариулт
        </a>
    </td>
  </tr>
  <tr>
    <td colspan="2"><?php echo $answer['answer'] ?></td>
  </tr>
  <tr>
    <td>
    <a href="delete_answer?answer_id=<?php echo $answer['id'] ?>&question_id=<?php echo $question['id'] ?>">Хариултыг устгах
      </a>
    </td>
    <td align="right"><?php echo $answer['create_date'] ?></td>
  </tr>
  <tr>
    <td colspan="2"><hr/></td>
  </tr>
<?php } ?>
</table>
<form method="POST" action="answer_add">
  <table border="0">
    <tr>
        <td>Хариулагчийн нэр:</td>
        <td>
            <input type="text" name="name" size="30">
            <input type="hidden" name="question_id" value="<?php echo $question_id; ?>">
        </td>
    </tr>
    <tr>
        <td>Хариулт:</td>
        <td>
            <textarea rows="8" cols="80" name="answer" ></textarea>
            <input type="submit" value="Илгээх" name="submit">
        </td>
    </tr>
  </table>
</form>
<?php $content=ob_get_clean() ?>

<?php include 'layout.php' ?>
