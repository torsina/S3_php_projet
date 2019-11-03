<?php include("views/viewElements/header.php") ?>
<body>
    <?php include("views/viewElements/navbar.php") ?>
    <div class="register-form-box">
        <form action="/api/login/register" method="post">
            <div class="form-group">
                <label for="firstName">First Name</label>
                <input name="firstName" type="text" class="form-control" id="firstName" placeholder="First Name">
            </div>
            <div class="form-group">
                <label for="lastName">Last Name</label>
                <input name="lastName" type="text" class="form-control" id="lastName" placeholder="Last Name">
            </div><div class="form-group">
                <label for="displayName">Display Name</label>
                <input name="displayName" type="text" class="form-control" id="displayName" placeholder="Display Name">
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input name="email" type="email" class="form-control" id="email" placeholder="name@example.com">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input name="password" type="password" class="form-control" id="password" placeholder="Password">
            </div>
            <button class="btn btn-outline-blue" type="submit">Register</button>
        </form>
    </div>


</body>
<?php include("views/viewElements/footer.php") ?>
