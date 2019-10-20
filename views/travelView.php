<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Travel page</title>
    </head>
    <body>
        <p>Travels</p>
        <table>
            <tr>
                <?php foreach($model->columns as $column) :?>
                    <td><?=$column?></td>
                <?php endforeach;?>
            </tr>
            <?php foreach($model->data as $row) :?>
                <tr>
                <?php foreach($row as $value) :?>
                    <td><?=$value?></td>
                <?php endforeach;?>
                </tr>
            <?php endforeach;?>
        </table>
    </body>
</html>