<?php $title="Асуулт асуух хэсэг" ?>

<?php ob_start() ?>
<form method="POST" action="question_add">
  <table border="0">
    <tr>
        <td>Асуугчийн нэр:</td>
        <td><input type="text" size="105" name="questioner"></td>
    </tr>
    <tr>
        <td>Асуултын гарчиг:</td>
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
