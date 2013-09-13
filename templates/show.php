<?php $title = $question->getTitle() ?>
<?php ob_start(); ?>

<table border="0" width=700>
    <tr>
      <td colspan="2"><h2><?php echo $question->getTitle(); ?></h2></td>
    </tr> 
  <tr>
    <td>
        <?php echo "Нэр: ".User::getUserNameById($question->getUserId());?>
  </td>
    <td align="right">
        <?php echo "Огноо: ".$question->getCreatedDate() ?>
    </td>
  </tr>
    <tr>
       <td colspan="2">
        <?php echo nl2br($question->getQuestion());?>
  </td>
</tr>
  <tr>
    <td>
        <?php
           if (logid_in()){
                if ($_SESSION['id'] == $question->getUserId()){ ?>
            <a href="question_edit?question_id=<?php echo $question->getId() ?>">
            Засах
            </a>
    </td>
    <td align="right">
            <a href="delete_question?question_id=<?php echo $question->getId() ?>">
            Устгах
            </a>
        <?php }  }?>
    </td>
  </tr>
</table>
<hr/>
<h3>Хариултууд</h3>
<table border="0" width="700">
    <?php foreach ($question->getAnswers() as $answer){?>
 <tr>
  <td><?php echo User::getUserNameById($answer->getUserId()) ?></td>
    <td align="right">
        <?php echo $answer->getCreatedDate() ?>
    </td>
 </tr>
  <tr>
    <td colspan="2"><?php echo nl2br($answer->getAnswer()) ?></td>
  </tr>
   <tr>
    <td>
        <?php
            if (logid_in()){
            if ($_SESSION['id'] == $answer->getUserId()){
        ?>
    <a href="delete_answer?answer_id=<?php echo $answer->getId()
                    ?>&question_id=<?php echo $question->getId() ?>">
        Хариултыг устгах
        </a>
        <?php } }?>
    </td>
    <td align="right">
        <?php
            if($answer->getId() == $question->getBestAnswerId()){
                echo "<strong>*Зөв хариулт</strong>";
            } else {
            if (logid_in()){
                if ($_SESSION['id'] == $question->getUserId()){
        ?>
        <a href="best_answer?question_id=<?php echo $question->getId() ?>
        &answer_id=<?php echo $answer->getId() ?>">
             Хариулт зөв үү?
        </a>
         <?php       }
            }
        } ?>
        </td>
    </tr>
  <tr>
<td colspan="2"><hr/></td>
</tr>
<?php } ?>
</table>

<h3>Хариулт бичих</h3>

<?php if (logid_in()){?>
<form method="POST" action="">
  <table border="0">
    <tr>
    <div class="form-group">
      <label for="Answer">Хариулт:</label>
      <td>
          <textarea rows="8" cols="65" class="form-control" name="answer" ><?php echo
          $form_answer->getAnswer() ?></textarea>
  </td>
    </tr>
     <tr>
      <td></td>
      <td>
          <i id='error_message'>
            <?php echo $form_answer->getError('answer') ?>
          </i>
      </td>
    </tr>
    <tr>
      <td>
        <input type="hidden" name="question_id"
            value="<?php echo $question->getId(); ?>"/>
      </td>
      <td>
        <input type="submit" class="btn btn-primary" value="Илгээх" name="submit"/>
      </td>
    </tr>
  </table>
</form>
<?php } else { ?>
    <label>Хариулт бичхийн тулд нэр, нууц үгээрээ
            <a href="login?question_id=<?php echo $question->getId()?>">
            холбогдоно </a>уу!
    </label>
<?php } ?>
<?php $content=ob_get_clean() ?>

<?php include 'layout.php' ?>
