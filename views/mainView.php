<?php include("views/viewElements/header.php") ?>
<body>
    <?php include("views/viewElements/navbar.php") ?>


    <!-- carousel -->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100 carousel-img-1" src="images/venice.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100 carousel-img-2" src="images/paris_1.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100 carousel-img-3" src="images/new_york_1.jpg" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <!-- search bar -->
    <div class="search-bar">
        <div class="row justify-content-md-center">
            <form class="form-inline search-form" action="/travel">
                <div class="col-md-auto search-form-line">
                    <img src="images/search.svg" class="search-form-icon">
                    <input class="form-control mr-sm-2" type="search" placeholder="Location" aria-label="Location"
                           name="search_location">
                </div>
                <div class="col-md-auto search-form-line">
                    <input class="form-control mr-sm-2" data-provide="datepicker" placeholder="Start"
                           name="search_startDate" aria-label="Search start date">
                    <input class="form-control mr-sm-2" data-provide="datepicker" placeholder="End"
                           name="search_endDate" aria-label="Search end date">
                </div>
                <div class="col-md-auto search-form-line">
                    <input class="form-control mr-sm-2" type="search" placeholder="Number of people"
                           aria-label="Search number of people" name="search_seats">
                    <button class="btn btn-outline-orange my-2 my-sm-0" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>
</body>
<?php include("views/viewElements/footer.php") ?>