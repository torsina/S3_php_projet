<?php include("App/View/viewElements/header.php") ?>
<body>
    <?php include("App/View/viewElements/navbar.php") ?>
    <div>
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
                   aria-controls="nav-home" aria-selected="true">Add travel</a>
                <a class="nav-item nav-link active" id="nav-profile-tab" data-toggle="tab" href="#nav-profile"
                   role="tab"
                   aria-controls="nav-profile" aria-selected="false">Edit travel</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade " id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="travel-creation-form-box card">
                    <div class="card-header">
                        Travel creation
                    </div>
                    <div class="card-body">
                        <form id="createForm">
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
                                <input name="add_startDate" data-provide="datepicker" class="form-control"
                                       id="add_startDate"
                                       required>
                            </div>
                            <div class="form-group">
                                <label for="add_endDate">End date</label>
                                <input name="add_endDate" data-provide="datepicker" class="form-control"
                                       id="add_endDate"
                                       required>
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

                            <button class="btn btn-outline-blue" onclick="createTravel()" name="add_travel">Register
                            </button>
                        </form>
                    </div>

                </div>
            </div>
            <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <div class="travel-creation-form-box card" style="display: inline-table; width: 95%">
                    <div class="card-header">
                        Travel Edition
                    </div>
                    <div class="card-body">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Start date</th>
                                    <th scope="col">End date</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Capacity</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($model["travels"] as $key => $travel): ?>
                                    <tr id="editFormUp-<?= $key ?>">
                                        <th scope="row">
                                        </th>
                                        <td><input type="text" name="edit_name"
                                                   value="<?= $travel->getName() ?>" class="form-control" required/>
                                        </td>
                                        <td><input type="file" name="edit_image"
                                                   placeholder="foo"></td>
                                        <td><input name="edit_startDate"
                                                   id="edit_startDate_<?= $key ?>" data-provide="datepicker"
                                                   class="form-control" required></td>
                                        <td><input name="edit_endDate"
                                                   id="edit_endDate_<?= $key ?>" data-provide="datepicker"
                                                   class="form-control" required></td>
                                        <td><input type="number" step="0.01" name="edit_price"
                                                   value="<?= $travel->getPrice() ?>" class="form-control" required/>
                                        </td>
                                        <td><input type="text" name="edit_location"
                                                   value="<?= $travel->getLocation() ?>" class="form-control"/></td>
                                        <td><input type="number" name="edit_capacity"
                                                   value="<?= $travel->getCapacity() ?>" class="form-control"/></td>
                                        <td><input type="text" name="edit_description"
                                                   value="<?= $travel->getDescription() ?>" class="form-control"/></td>
                                        <td><input type="button" name="edit" value="Edit"
                                                   class="form-control" onclick="editTravel('editFormUp-<?= $key ?>')"></td>
                                        <td>
                                            <form id="deleteForm-<?= $travel->getId() ?>">
                                                <input type="hidden" name="id" value="<?= $travel->getId() ?>"/>
                                                <button class="form-control btn-inline-orange" onclick="deleteTravel(this)">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <script type="text/javascript">
                                        $(function () {
                                            $('#edit_startDate_<?=$key?>').datepicker({format: "dd/mm/yyyy"}).datepicker('update', '<?=date("d/m/Y", strtotime($travel->getStartDate()))?>');
                                            $('#edit_endDate_<?=$key?>').datepicker({format: "dd/mm/yyyy"}).datepicker('update', '<?=date("d/m/Y", strtotime($travel->getEndDate()))?>');
                                        });
                                    </script>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </div>
</body>
<?php include("App/View/viewElements/footer.php") ?>
