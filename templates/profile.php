<?php $title = 'Профайл';
ob_start();
?>
    <h4> <a href="profile_edit?user_id=<?php echo $user->getId()?>">
Edit Profile </a></h4>
<table width="600">
    <tr>
        <td><b>Your name :</b></td>
        <td><?php echo $user->getNickname();?></td>
    </tr>
    <tr>
        <td><b>Description:</b></td>
        <td><?php echo $user->getDescription(); ?></td>
    </tr>
    <tr>
        <td><b>Number of Answers you answered:</b></td>
        <td><?php echo $answer_count; ?></td>
    </tr>
    <tr>
        <td><b>Number of questions that you asked:</b></td>
        <td><?php echo $question_count;?></td>
    </tr>
</table>

<table border="0" width="700">
  <tr>
    <td><b>Last 5 answers you answered: </b></td>
  </tr>
  <tr>
    <?php foreach ($answers as $answer) { ?>
      <td colspan="2" >
        <a href = "/qanda/index.php/show?question_id=<?php echo
$answer->getQuestionId();?>">
        <?php echo nl2br($answer->getAnswer()) ?> </a>
      </td>
  </tr>
    <?php } ?>
<br>
<br>
  <tr>
    <td>
        <br><b>Last 5 questions you asked: </b><br>
    </td>
  </tr>
    <?php foreach ($questions as $question){ ?>
    <td colspan="2">
        <a href="/qanda/index.php/show?question_id=<?php echo $question->getId(); ?>">
            <?php echo $question->getTitle() ?></a>
    </td>
   </tr>
    <?php } ?>
</table>
<?php $content = ob_get_clean() ?>

<?php include 'layout.php' ?>
