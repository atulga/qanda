<?php $title = 'Асуулт засах';
ob_start();
?>
<a href="/qanda/index.php/show?question_id=
    <?php echo $form->getId() ?>">Буцах
</a>
<h2>Асуулт засварлах хэсэг</h2>

<form method="POST" action="">
<div class="form-group">
      <label for="Name">Гарчиг:</label>
        <input type="hidden" name="name" value="<?php echo $form->getName() ?>"/>
        <input type="text" class="form-control1" name="title" value="<?php echo $form->getTitle(); ?>"/>
        <i id='error_message'><?php echo $form->getError('title') ?></i>
</div>
<div class="form-group">
      <label for="Desc">Асуулт:</label>
        <textarea name="question" class="form-control" cols="40" rows="10" ><?php echo $form->getDescription(); ?></textarea>
        <i id='error_message'><?php echo $form->getError('title') ?></i>
</div>
<br>
        <input type="hidden" name="id" value="<?php echo $form->getId(); ?>">
        <input type="submit" class="btn btn-primary" name="update" value="Шинэчлэх"/>
</form>

<?php $content = ob_get_clean() ?>
<?php include 'layout.php'?>
