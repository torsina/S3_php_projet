<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Travel page</title>
    </head>
    <body>
        <p>Travels</p>
        <table>
        <?php foreach($model->travels as $travel) :?>
            <tr>
                <td><?=$travel->?></td>
            </tr>
        <?php endforeach;?>
        </table>
    </body>
</html>