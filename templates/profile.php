<?php $title = 'Профайл';
ob_start();
?>

<?php if (has_get('message')) {?>
    <div class="alert alert-success">
        <?php echo get_param('message'); ?>
    </div>
<?php } ?>

<?php if($isme){ ?>
     <h4> <a href="profile_edit">Хувийн мэдээлэл засах</a></h4>
<?php } else { ?>

<?php } ?>

<table width="100%">
    <tr>
        <td width="50%"><b>Нэр :</b></td>
        <td><?php echo $user->getNickname();?></td>
    </tr>
    <tr>
        <td width="50%"><b>Тодорхойлолт:</b></td>
        <td><?php echo $user->getDescription(); ?></td>
    </tr>
    <tr>
        <td width="50%"><b>Нийт хариултын тоо:</b></td>
        <td><?php echo $answer_count; ?></td>
    </tr>
    <tr>
        <td width="50%"><b>Нийт асуултын тоо:</b></td>
        <td><?php echo $question_count;?></td>
    </tr>
</table>

<table border="0" width="100%">
  <tr>
    <td><b>Сүүлийн 5 хариулт: </b></td>
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
        <br><b>Сүүлийн 5 асуулт: </b><br>
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
