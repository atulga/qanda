<?php $title = "Асуулт асуух хэсэг" ?>
<?php ob_start() ?>
<form method="POST" action="">
<?php if($form->getError('title')) { ?>
<div class="form-group has-error">
    <label for="Title">Асуултын гарчиг:</label>
    <input type="text" class="form-control" name="title" value="<?php echo $form->getTitle() ?>"/>
    <label class="control-label"><?php echo $form->getError('title') ?></label>
</div>
<?php } else { ?>
<div class="form-group">
    <label for="Title">Асуултын гарчиг:</label>
    <input type="text" class="form-control" name="title" value="<?php echo $form->getTitle() ?>"/>
</div>
<?php } ?>
<?php if($form->getError('question')) { ?>
<div class="form-group has-error">
    <label for="Text">Асуулт:</label>
    <textarea rows="12" class="form-control" name="question" cols="100"><?php echo $form->getQuestion() ?></textarea>
    <label class="control-label"><?php echo $form->getError('question') ?></label>
</div>
<?php } else { ?>
<div class="form-group">
    <label for="Text">Асуулт:</label>
    <textarea rows="12" class="form-control" name="question" cols="100"><?php echo $form->getQuestion() ?></textarea>
<?php } ?>
    <input type="hidden" name="id" value="<?php echo $form->getId() ?>"/></td>
    <br>
      <input type="submit" class="btn btn-primary" value="Илгээх" name="submit">
</form>

<?php $content = ob_get_clean() ?>
<?php include 'layout.php' ?>
