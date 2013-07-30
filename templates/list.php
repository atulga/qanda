<?php $title = 'Асуултууд' ?>

<?php ob_start() ?>
<table border="1">
<tr>
    <td colspan="6">Нийт асуултууд</td>
</tr>
<tr>
    <th>Асуултын гарчиг</th>
    <th>Асуугч</th>
    <th>Огноо</th>
    <th>Хариулт авсан эсэх</th>
    <th>Нийт хариулт</th>
</tr>
<?php foreach ($questions as $question){ ?>
<tr>
    <td>
        <a href="/qanda/index.php/show?id=<?php echo $question['id']; ?>">
            <?php echo $question['title'] ?>
        </a>
    </td>
    <td><?php echo $question['name'] ?></td>
    <td><?php echo $question['createdate'] ?></td>
    <td align="center">
        <?php echo ($question['result'] == "0" ? "Үгүй" : "Тийм"); ?>
     </td>
    <td align="center"><?php echo $question['hariult_count'] ?></td>
</tr>
<?php } ?>
</table>

<hr/>


<form method = "POST" action = "index.php/question_add">
    <table border="0">
    <tr>
        <td>Асуугчийн нэр:</td>
        <td><input type="text" size="30" name="questioner"></td>
    </tr>
    <tr>
        <td>Асуултын гарчиг:</td>
        <td><input type="text" size="30" name="question_title" ></td>
    </tr>
    <tr>
        <td align="right">Асуулт:</td>
        <td>
            <textarea rows="8" name="question" cols="40"></textarea>
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

<?php $content = ob_get_clean() ?>
    
<?php include 'layout.php' ?>
