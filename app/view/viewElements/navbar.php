<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-light my-navbar">
    <a class="navbar-brand my-navbar-brand" href="/">ME.trip</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
            </li>
        </ul>
            <?php if(!isset($_SESSION) || !isset($_SESSION["user"])) : ?>
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Log In
                </a>
                <div class="dropdown-menu dropdown-menu-right login" aria-labelledby="navbarDropdown">
                    <form class="form login-form" action="/login" method="post">
                        <p class="h6">Email</p>
                        <input class="form-control" type="email" name="login" placeholder="email" aria-label="email">
                        <p class="h6">Password</p>
                        <input class="form-control" type="password" name="password" placeholder="password" aria-label="password">
                        <button class="btn btn-outline-blue" type="submit">Log in</button>
                        <a href="/register"><p>Sign up</p></a>
                    </form>
                </div>
            </div>
            <?php else : ?>
                <a class="nav-link" href="/logout" >
                    Log out
                </a>
                <?php if($_SESSION["user"]["permission"] > 0) : ?>
                    <a class="nav-link" href="/admin" >
                        Admin page
                    </a>
                <?php endif; ?>
                <a class="nav-link" href="member" >
                    Member page
                </a>
            <?php endif; ?>
    </div>
</nav>