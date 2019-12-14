<?php include("App/View/viewElements/header.php") ?>
<body>
    <?php include("App/View/viewElements/navbar.php") ?>
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-info-tab" data-toggle="tab" href="#nav-info" role="tab"
               aria-controls="nav-home" aria-selected="true">Home</a>
            <a class="nav-item nav-link" id="nav-travels-tab" data-toggle="tab" href="#nav-travels" role="tab"
               aria-controls="nav-profile" aria-selected="false">Profile</a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-info" role="tabpanel">
            info
        </div>
        <div class="tab-pane fade" id="nav-travels" role="tabpanel">
            <div class="travel-creation-form-box card" style="width: 90%">
                <div class="card-header">
                    Bought trips
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Image</th>
                                <th scope="col">Start date</th>
                                <th scope="col">End date</th>
                                <th scope="col">Location</th>
                                <th scope="col">Price</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($model["travels"] as $key => $travel): ?>
                            <tr>
                                <td><?=$travel["name"]?></td>
                                <td><img src="images/<?=$travel["image"]?>" alt="" style="width: 200px"></td>
                                <td><?=date("d-m-Y", strtotime($travel["startDate"]))?></td>
                                <td><?=date("d-m-Y", strtotime($travel["endDate"]))?></td>
                                <td><?=$travel["location"]?></td>
                                <td><?=$travel["price"]?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include("App/View/viewElements/footer.php") ?>
