<?php $title = 'Профайл';
ob_start(); ?>
<a href="/qanda/index.php/profile?user_id=
    <?php echo $form->getId(); ?>">Буцах</a>
<h3>Хувийн мэдээлэл засах хэсэг</h3>
<form method="POST" action="">
<?php if($form->getError('nickname')) { ?>
<div class="form-group has-error">
      <label for="Name">Нэр:</label>
      <input type="text" class="form-control1" name="nickname" value="<?php echo $form->getNickname(); ?>"/>
        <label class="control-label"><?php echo $form->getError('nickname') ?></label>
</div>
<?php } else { ?>
<div class="form-group">
      <label for="Name">Нэр:</label>
        <input type="text" class="form-control1" name="nickname" value="<?php echo $form->getNickname(); ?>"/>
</div>
<?php } ?>
<?php if($form->getError('description')) { ?>
<div class="form-group has-error">
      <label for="Desc">Тодорхойлолт:</label>
      <textarea name="description" class="form-control" cols="40" rows="10" ><?php echo $form->getDescription(); ?></textarea>
        <label class="control-label"><?php echo $form->getError('description') ?></label>
</div>
<?php } else { ?>
<div class="form-group">
      <label for="Desc">Тодорхойлолт:</label>
      <textarea name="description" class="form-control" cols="40" rows="10" ><?php echo $form->getDescription(); ?></textarea>
</div>
<?php } ?>
<br>
        <input type="hidden" name="id" value="<?php echo $form->getId(); ?>">
        <input type="submit" class="btn btn-primary" name="update" value="Шинэчлэх"/>
</form>

<?php $content = ob_get_clean() ?>
<?php include 'layout.php'?>
