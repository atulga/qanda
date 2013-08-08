<?php $title = $question['title'] ?>

<?php ob_start(); ?>
<table border="0" width=700>
  <tr>
    <td colspan="2"><h2><?php echo $question['title']; ?></h2></td>
  </tr>
  <tr>
    <td><?php echo "Нэр:".$question['name'];?></td>
    <td align="right"><?php echo "Огноо:".$question['create_date'] ?></td>
  </tr>
  <tr>
    <td colspan="2">
      <?php echo nl2br($question['question']);?>
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
<table border="0" width="700">
<?php foreach ($answers as $answer){?>
  <tr>
    <td><?php echo $answer['name'] ?></td>
    <td align="right">
<?php if($answer['best'] == 1){ echo " *Зөв хариулт";
} else { ?>
      <a href="best_answer?question_id=<?php echo $question['id']
?>&answer_id=<?php echo $answer['id'] ?>">Хариулт зөв үү?
      </a>
<?php } ?>
    </td>
  </tr>
  <tr>
    <td colspan="2"><?php echo nl2br($answer['answer']) ?></td>
  </tr>
  <tr>
    <td>
      <a href="delete_answer?answer_id=<?php echo $answer['id'] ?>&question_id=<?php echo $question['id'] ?>">
        Хариултыг устгах
      </a>
    </td>
    <td align="right"><?php echo $answer['create_date'] ?></td>
  </tr>
  <tr>
    <td colspan="2"><hr/></td>
  </tr>
<?php } ?>
</table>
<h2>Хариулт бичих</h2>
<form method="POST" action="">
  <table border="0">
    <tr>
      <td>Хариулагчийн нэр:</td>
      <td>
        <input type="text" name="name" size="30"
            value="<?php
                      if(isset($_SESSION['name']))
                          echo $_SESSION['name'];
                      else {
                           echo $form_answer->getName();
                           $_SESSION['name'] = $form_answer->getName();
                         }
                   ?>"
        />
        <i id='error_message'><?php echo $form_answer->getError('name') ?></i>
      </td>
    </tr>
    <tr>
      <td>Хариулт:</td>
      <td>
          <textarea rows="8" cols="65" name="answer" ><?php echo
          $form_answer->getAnswer() ?></textarea>
      </td>
    </tr>
    <tr>
      <td></td>
      <td>
          <i id='error_message'><?php echo $form_answer->getError('answer') ?></i>
      </td>
    </tr>
    <tr>
      <td>
        <input type="hidden" name="question_id" 
            value="<?php echo $question['id']; ?>"/>
      </td>
      <td>
        <input type="submit" value="Илгээх" name="submit"/>
      </td>
    </tr>
  </table>
</form>
<?php $content=ob_get_clean() ?>

<?php include 'layout.php' ?>
