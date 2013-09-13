<?php $title = "Асуулт асуух хэсэг" ?>
<?php ob_start() ?>
<form method="POST" action="">
<div class="form-group">
    <label for="Title">Асуултын гарчиг:</label>
    <input type="text" class="form-control" name="title" value="<?php echo $form->getTitle() ?>"/>
    <i id='error_message'><?php echo $form->getError('title') ?></i>
</div>
<div class="form-group">
    <label for="Text">Асуулт:</label>
    <textarea rows="12" class="form-control" name="question" cols="100"><?php echo $form->getQuestion() ?></textarea>
    <i id='error_message'><?php echo $form->getError('question') ?></i>
</div>
    <input type="hidden" name="id" value="<?php echo $form->getId() ?>"/></td>
    <br>
      <input type="submit" class="btn btn-primary" value="Илгээх" name="submit">
</form>
<?php $content = ob_get_clean() ?>
<?php include 'layout.php' ?>
