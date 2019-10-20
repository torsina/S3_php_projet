<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">

        <script src="https://code.jquery.com/jquery-3.4.1.min.js"
                integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
                integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
                crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
                integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
                crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha256-bqVeqGdJ7h/lYPq6xrPv/YGzMEb6dNxlfiTUHSgRCp8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.fr.min.js" integrity="sha256-IRibTuqtDv2uUUN/0iTrhnrvvygNczxRRAbPgCbs+LE=" crossorigin="anonymous"></script>
        <script src="js/main.js"></script>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
              integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
              crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css" integrity="sha256-bLNUHzSMEvxBhoysBE7EXYlIrmo7+n7F4oJra1IgOaM=" crossorigin="anonymous" />
        <link rel="stylesheet" href="css/main.css">

        <title>Main page</title>
    </head>
    <body>
        <!-- navbar -->
        <nav class="navbar navbar-expand-lg navbar-light my-navbar">
            <a class="navbar-brand my-navbar-brand" href="#">ME.trip</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                </ul>
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Log In
                    </a>
                    <div class="dropdown-menu dropdown-menu-right login" aria-labelledby="navbarDropdown">
                        <form class="form login-form">
                            <p class="h6">Email</p>
                            <input class="form-control" type="email" placeholder="email" aria-label="email">
                            <p class="h6">Password</p>
                            <input class="form-control" type="password" placeholder="password" aria-label="password">
                            <button class="btn btn-outline-blue" type="submit">Log in</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>


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
                        <input class="form-control mr-sm-2" type="search" placeholder="Location" aria-label="Location" name="search_location">
                    </div>
                    <div class="col-md-auto search-form-line">
                        <input class="form-control mr-sm-2" data-provide="datepicker" placeholder="Start" name="search_startDate" aria-label="Search start date">
                        <input class="form-control mr-sm-2" data-provide="datepicker" placeholder="End" name="search_endDate" aria-label="Search end date">
                    </div>
                    <div class="col-md-auto search-form-line">
                        <input class="form-control mr-sm-2" type="search" placeholder="Number of people" aria-label="Search number of people" name="search_seats">
                        <button class="btn btn-outline-orange my-2 my-sm-0" type="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
    <footer>
        <div>Icons made by <a href="https://www.flaticon.com/authors/smashicons" title="Smashicons">Smashicons</a> from <a href="https://www.flaticon.com/"             title="Flaticon">www.flaticon.com</a></div>
        <div>Images by https://pixabay.com/</div>
    </footer>
</html>