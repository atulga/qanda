<?php $title = $post['title'] ?>

<?php ob_start(); ?>

  <a href="/qanda/index.php">Буцах</a>
<form method="POST" action="index.php">
  <h2><?php echo $post['title']; ?></h2>
  <div class="date">
        <?php echo "Үүссэн огноо:  ". $post['createdate']
            ." Асуулт асуугч:".$post['whoask'];?>
<?php 
if($post['result'] == "0"){?>
    <input type="checkbox" name="resulted" value="1">Хариултаа авсан эсэх
<?php } else {?> 
    <input type="checkbox" name="resulted" value="1" checked>Хариултаа авсан
<?php } ?>

  </div>
  <div class="body">
    Асуулт:
  <textarea rows="3" cols="60" name="question">
<?php 
    echo $post['mainq'];
    $questionid = $post['id'];
?>
  </textarea>
  </div>
    <input type="hidden" name="question_id" value="<?php echo $questionid ?>">
    <input type="submit" name="edit" value="Засах">
</form>
  <table border="0">
  <hr>
  <h2>Хариултууд</h2>
  <table border="0" >
    <?php
    foreach ($answerpost as $apost): ?>
    <form method="POST" action="index.php">
    <tr>
        <td><?php echo $apost['whoanswer'] ?></td>
        <td></td>
        <td><?php echo $apost['answerdate'] ?></td>
    </tr>
    <tr>
        <td colspan="3"><?php echo $apost['answer'] ?></td>
    </tr>
    <tr>
        <td colspan="2"><hr></td>
            <input type="hidden" name="answer_id_delete" value="<?php echo $apost['id'] ?>">
            <td><input type="submit" name="answer_delete" value="Хариулт устгах"></td>
    </tr>
    </form>
    <?php endforeach; ?>
  </table>

  <hr>
  <table border = "0">
  <form method = "POST" action= "index.php">
    <tr>
        <td>Хариулагчийн нэр:</td>
        <td><input type="text" name = "answername" size="30"></td>
        <input type="hidden" name = "questionid" value="<?php echo $questionid; ?>">
    </tr>
    <tr>
        <td>Хариулт:</td>
        <td>
            <textarea rows = "3" cols = "60" name = "answer" ></textarea>
            <input type = "submit" value = "Илгээх" name = "submit">
        </td>
    </tr>
  </form>
  </table>
<?php $content = ob_get_clean() ?>

<?php include 'layout.php' ?>
