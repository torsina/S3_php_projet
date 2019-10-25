<?php include("views/viewElements/header.php") ?>
<body>
    <?php print_r($model)?>
    <?php include("views/viewElements/navbar.php") ?>
    <?php foreach ($model->data as $row) : ?>
        <div class="search-result-box">
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-8">
                        <p>owner: <?=$row["displayName"]?></p>
                    </div>
                    <div class="col-4"><p>oddddwner: <?=$row["displayName"]?></p></div>
                </div>
            </div>

        </div>
    <?php endforeach; ?>




    <table>
        <tr>
            <?php foreach ($model->columns as $column) : ?>
                <td><?= $column ?></td>
            <?php endforeach; ?>
        </tr>
        <?php foreach ($model->data as $row) : ?>
            <tr>
                <?php foreach ($row as $value) : ?>
                    <td><?= $value ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
<?php include("views/viewElements/footer.php") ?>
