<?php $title="Асуулт асуух хэсэг" ?>

<?php ob_start() ?>
<form method="POST" action="">
    Name<br/>
    <?php echo $form->getError('name') ?>
    <input type="text" name="name" value="<?php echo $form->getName() ?>"/>
    <br/>
    Title<br/>
    <input type="text" name="title" value="<?php echo $form->getTitle() ?>"/>
    <br/>
    Question<br/>
    <textarea name="question"><?php echo $form->getQuestion() ?></textarea>
    <br/>
    <input type="submit"/>
</form>

<form method="POST" action="question_add">
  <table border="0">
    <tr>
        <td align="right">Асуугчийн нэр:</td>
        <td>
          <input type="text" size="105" name="questioner" value="<?php if(isset($_SESSION['questioner'])) echo $_SESSION['questioner']; ?>">
        </td>
    </tr>
    <tr>
        <td align="right">Асуултын гарчиг:</td>
        <td><input type="text" size="105" name="question_title" ></td>
    </tr>
    <tr>
        <td align="right">Асуулт:</td>
        <td>
            <textarea rows="8" name="question" cols="80"></textarea>
        </td>
    </tr>
    </tr>
        <td></td>
        <td>
            <input type="submit" value="Илгээх" name="submit">
        </td>
    </tr>
  </table>
</form>
<?php $content=ob_get_clean() ?>
<?php include 'layout.php' ?>
