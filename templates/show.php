<?php $title = $question->getTitle() ?>
<?php ob_start(); ?>

<?php if (has_get('message')) {?>
    <div class="alert alert-success">
        <?php echo get_param('message'); ?>
    </div>
<?php } ?>

<table border="0" width="100%">
    <tr>
      <td colspan="2"><h2><?php echo $question->getTitle(); ?></h2></td>
    </tr>
  <tr>
    <td>
        Нэр: <a href="/qanda/index.php/profile?user_id=<?php echo $question->getUserId() ?> ">
            <?php echo User::getUserNameById($question->getUserId());?></a>
  </td>
    <td align="right">
        <?php echo "Огноо: ".$question->getCreatedDate()->format('Y-m-d H:i:s') ?>
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
           if (logged_in()){
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
<table border="0" width="100%">
    <?php foreach ($question->getAnswers() as $answer){?>
 <tr>
    <td>
        <a href="/qanda/index.php/profile?user_id=<?php echo $question->getUserId() ?> ">
            <?php echo User::getUserNameById($answer->getUserId()) ?>
        </a>
    </td>
    <td align="right">
        <?php echo $answer->getCreatedDate()->format('Y-m-d H:i:s') ?>
    </td>
 </tr>
  <tr>
    <td colspan="2"><?php echo nl2br($answer->getAnswer()) ?></td>
  </tr>
   <tr>
    <td>
        <?php
            if (logged_in()){
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
            if (logged_in()){
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

<?php if (logged_in()){?>
<form method="POST" action="">
<label for="Answer">Хариулт:</label>
<?php if($form_answer->getError('answer')){ ?>
<div class="form-group has-error">
        <textarea rows="8" cols="65" class="form-control" name="answer"></textarea>
<label class="control-label"><?php echo $form_answer->getError('answer') ?></label>
</div>
<?php } else { ?>
<div class="form-group">
        <textarea rows="8" cols="65" class="form-control" name="answer"><?php echo $form_answer->getAnswer() ?></textarea>
      </div>

<?php } ?>
        <input type="hidden" name="question_id"
            value="<?php echo $question->getId(); ?>"/>
      <br>
        <input type="submit" class="btn btn-primary" value="Илгээх" name="submit"/>
</form>
<?php } else { ?>
    <label>Хариулт бичхийн тулд нэр, нууц үгээрээ
            <a href="login?question_id=<?php echo $question->getId()?>">
            холбогдоно </a>уу!
    </label>
<?php } ?>
<?php $content=ob_get_clean() ?>

<?php include 'layout.php' ?>
