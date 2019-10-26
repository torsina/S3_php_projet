<?php include("views/viewElements/header.php") ?>
<body>
    <?php include("views/viewElements/navbar.php") ?>
    <?php foreach ($model->data as $row) : ?>
        <div class="search-result-box">
            <div class="search-result-container">
                <div class="row justify-content-md-center">
                    <div class="col">
                        <img src="images/<?= $row["image"] ?>" class="search-result-image">
                    </div>
                    <div class=" col-5">
                        <ul class="search-result-text-list search-result-info-list">
                            <li><h2><?= $row["name"] ?></h2></li>
                            <li><?=$row["description"]?></li>
                            <li><?=$row["location"]?></li>
                        </ul>
                    </div>
                    <div class="col">
                        <ul class="search-result-text-list search-result-order-list">
                            <li>PRICE</li>
                            <li>COMMANDER</li>
                        </ul>
                    </div>
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
