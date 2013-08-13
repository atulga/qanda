<?php $title = 'Асуултууд' ?>

<?php ob_start() ?>
<table border="0">
<?php foreach ($questions as $question){ ?>
  <tr>
    <td colspan="2">
        <h3><a href="/qanda/index.php/show?question_id=<?php echo $question->getId(); ?>">
            <?php echo $question->getTitle() ?></a>
        </h3>
    </td>
  </tr>
  <tr>
    <td>Нэр:<?php echo $question->getName() ?></td>
    <td align="right"><?php echo $question->getDate() ?></td>
  </tr>
  <tr>
    <td colspan="2"><?php echo nl2br($question->getQuestion()) ?></td>
  </tr>
  <tr>
    <td>Хариултаа авч чадсан эсэх:
        <?php echo ($question->getBestAnswer() == "0" ? "Үгүй" : "Тийм"); ?>
     </td>
    <td align="right">Нийт хариултын тоо:<?php echo $question->getAnswersCount() ?></td>
  </tr>
  <tr>
    <td colspan="2"><hr/></td>
  </tr>
<?php } ?>
</table>

<?php $content = ob_get_clean() ?>

<?php include 'layout.php' ?>
