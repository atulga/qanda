<?php $title = 'Асуултууд' ?>
<?php ob_start() ?>
<table border="0" width="100%">
<?php foreach ($questions as $question){ ?>
  <tr>
    <td colspan="2">
        <h4><a href="/qanda/index.php/show?question_id=<?php echo $question->getId(); ?>">
            <?php echo $question->getTitle() ?></a>
        </h4>
    </td>
  </tr>
  <tr>
    <td>Нэр:
        <strong>
        <a href="/qanda/index.php/profile?user_id=<?php echo $question->getUserId() ?> "><?php echo User::getUserNameById($question->getUserId())?>
        </strong>
    </td>
    <td align="right"><?php echo $question->getCreatedDate() ?></td>
  </tr>
  <tr>
    <td colspan="2"><?php echo nl2br($question->getQuestion()) ?></td>
  </tr>
  <tr>
    <td><i>Хариултаа авч чадсан эсэх:</i>
        <strong>
            <?php echo ($question->isAnswered() ? "Тийм" : "Үгүй");?>
        </strong>
    </td>
    <td align="right"><i>Нийт хариултын тоо:</i>
        <strong><?php echo $question->getAnswerCount() ?></strong>
    </td>
  </tr>
    <td colspan="2"><hr/></td>
<?php } ?>
</table>

<ul class="pagination">
<?php
foreach ($pager->getPages() as $page) {
    if ($pager->getCurrentPage() == $page){ ?>
        <li class="active"><span><?php echo $page; ?></span></li>
   <?php } else{ ?>
        <li class="disabled"><a href="?page=<?php echo $page ?>"><?php echo $page ?></a></li>
  <?php }
}
?>
</ul>

<?php $content = ob_get_clean() ?>

<?php include 'layout.php' ?>
