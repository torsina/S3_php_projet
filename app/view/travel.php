<?php include("App/View/viewElements/header.php") ?>
<body>
    <?php include("App/View/viewElements/navbar.php") ?>
    <?php
    foreach ($model["data"]["travel"] as $row) : ?>
        <div class="search-result-box">
            <div class="search-result-container">
                <div class="row justify-content-md-center">
                    <div class="col">
                        <img src="images/<?= $row["travel"]["image"] ?>" class="search-result-image">
                    </div>
                    <div class=" col-5">
                        <ul class="search-result-text-list search-result-info-list">
                            <li><h2><?= $row["travel"]["name"] ?></h2></li>
                            <li><?=$row["travel"]["description"]?></li>
                            <li style="margin-top: 1vh;">Location: <?=$row["travel"]["location"]?></li>
                        </ul>
                    </div>
                    <div class="col">
                        <ul class="search-result-text-list search-result-order-list">
                            <li><?= $row["travel"]["price"] ?> €</li>
                            <li>Owned by: <?=$row["displayName"]?></li>
                            <li>
                                <form id="form-<?=$row["travel"]["id"]?>"">
                                    <input type="hidden" name="id" value="<?= $row["travel"]["id"] ?>">
                                    <input name="btnSubmit" type="button" value="Order" onclick="orderTravel(this)">
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    <?php endforeach; ?>


    <table>
        <tr>
            <?php foreach ($model["data"]["columns"] as $column) : ?>
                <td><?= $column ?></td>
            <?php endforeach; ?>
        </tr>
        <?php foreach ($model["data"]["travel"] as $row) : ?>
            <tr>
                <?php foreach ($row["travel"] as $value) : ?>
                    <td><?= $value ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
<?php include("App/View/viewElements/footer.php") ?>
