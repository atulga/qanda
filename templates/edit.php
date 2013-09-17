<?php $title = 'Асуулт засах';
ob_start(); ?>
<a href="/qanda/index.php/show?question_id=
    <?php echo $form->getId() ?>">Буцах</a>
<h2>Асуулт засварлах хэсэг</h2>

<form method="POST" action="">
<?php if($form->getError('title')) { ?>
<div class="form-group has-error">
      <label for="Name">Гарчиг:</label>
        <input type="hidden" name="name" value="<?php echo $form->getName() ?>"/>
        <input type="text" class="form-control1" name="title" value="<?php echo $form->getTitle(); ?>"/>
        <label class="control-label"><?php echo $form->getError('title') ?></label>
</div>
<?php } else { ?>
<div class="form-group">
      <label for="Name">Гарчиг:</label>
        <input type="hidden" name="name" value="<?php echo $form->getName() ?>"/>
        <input type="text" class="form-control1" name="title" value="<?php echo $form->getTitle(); ?>"/>
</div>
<?php } ?>
<?php if($form->getError('question')) { ?>
<div class="form-group has-error">
      <label for="Desc">Асуулт:</label>
        <textarea name="question" class="form-control" cols="40" rows="10" ><?php echo $form->getQuestion(); ?></textarea>
        <label class="control-label"><?php echo $form->getError('question') ?></label>
</div>
<?php } else { ?>
<div class="form-group">
      <label for="Desc">Асуулт:</label>
        <textarea name="question" class="form-control" cols="40" rows="10" ><?php echo $form->getQuestion(); ?></textarea>
</div>
<?php } ?>
<br>
        <input type="hidden" name="id" value="<?php echo $form->getId(); ?>">
        <input type="submit" class="btn btn-primary" name="update" value="Шинэчлэх"/>
</form>

<?php $content = ob_get_clean() ?>
<?php include 'layout.php'?>
