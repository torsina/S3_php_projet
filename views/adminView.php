<?php include("views/viewElements/header.php") ?>
<body>
    <?php include("views/viewElements/navbar.php") ?>
    <div>
        <div class="travel-creation-form-box card">
            <div class="card-header">
                Travel creation
            </div>
            <div class="card-body">
                <form action="/admin" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input name="add_name" type="text" class="form-control" id="name"
                               placeholder="name" required>
                    </div>
                    <div class="form-group">
                        <label for="add_image">Image</label>
                        <input name="add_image" type="file" class="form-control" id="add_image" required>
                    </div>
                    <div class="form-group">
                        <label for="add_description">Description</label>
                        <input name="add_description" type="text" class="form-control" id="add_description"
                               placeholder="description" required>
                    </div>
                    <div class="form-group">
                        <label for="add_startDate">Start date</label>
                        <input name="add_startDate" data-provide="datepicker" class="form-control" id="add_startDate" required>
                    </div>
                    <div class="form-group">
                        <label for="add_endDate">End date</label>
                        <input name="add_endDate" data-provide="datepicker" class="form-control" id="add_endDate" required>
                    </div>
                    <div class="form-group">
                        <label for="add_price">Price</label>
                        <input name="add_price" type="number" class="form-control" id="add_price"
                               placeholder="150" required>
                    </div>
                    <div class="form-group">
                        <label for="add_location">Location</label>
                        <input name="add_location" type="text" class="form-control" id="add_location"
                               placeholder="Paris" required>
                    </div>
                    <div class="form-group">
                        <label for="add_capacity">Capacity</label>
                        <input name="add_capacity" type="number" class="form-control" id="add_capacity"
                               placeholder="75" required>
                    </div>

                    <button class="btn btn-outline-blue" type="submit" name="add_travel">Register</button>
                </form>
            </div>

        </div>
    </div>
</body>
<?php include("views/viewElements/footer.php") ?>
