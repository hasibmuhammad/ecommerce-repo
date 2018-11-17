
<?php require_once "partials/header.php";?>
    <main role="main" class="login-form">
    <div class="container">
    <?php require_once "partials/_notification.php";?>
        <form class="form-signin" action="/login" method="post">
            <img class="col-3 mx-auto d-block" src="assets/images/bootstrap-solid.svg" alt="" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal text-center">Please sign in</h1>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
            <div class="checkbox mb-3">
                <label>
                <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        </form>
    </div>
    </main>
<?php require_once "partials/footer.php";?>