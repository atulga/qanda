<?php $title = 'List of Posts' ?>

<?php ob_start() ?>
<table border="1">
<tr>
    <td colspan="6">Нийт асуултууд</td>
</tr>
<tr>
    <th>№</th><th>Асуултын гарчиг</th><th>Асуугч</th><th>Огноо</th><th>Хариулт
авсан эсэх</th><th>Нийт хариулт</th>
</tr>
    <?php 
        $i = 1;    
        foreach ($posts as $post): ?>
    <tr>
    <td><?php echo $i; ?></td>
        <td> <a href="/qanda/index.php/show?id=<?php echo $post['id'];
?>">
        <?php echo $post['title'] ?>
      </a></td>
    <td><?php echo $post['whoask'] ?></td>
    <td><?php echo $post['createdate'] ?></td>
    <td><?php echo $post['result'] ?></td>
    <td><?php echo $post['hariult_count'] ?></td>
    </tr>
        <?php $i++;?>
    <?php endforeach; ?>
</table>

<hr>
<table border="0">
<form method = "POST" action = "index.php">
<tr>
    <td>Асуугчийн нэр:</td>
    <td><input type="text" size="30" name="Name"></td>
</tr>
<tr>
    <td>Асуултын гарчиг:</td>
    <td><input type="text" size="30" name="title" ></td>
</tr>
<tr>
    <td colspan="2">Асуулт:</td>
</tr>
</tr>
    <td colspan="2"><textarea rows="3" name="question" cols="60"></textarea>
    <input type="submit" value="Илгээх" name="submit"></td>
</tr>
</form>
</table>

<?php $content = ob_get_clean() ?>
    
<?php include 'layout.php' ?>
