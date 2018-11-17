<?php require_once "partials/header.php";?>
    <main role="main" class="login-form">
    <div class="container">
    <?php require_once "partials/_notification.php";?>
        <form class="form-signin" action="register" method="post" enctype="multipart/form-data">
            <img class="col-3 mx-auto d-block" src="assets/images/bootstrap-solid.svg" alt="" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal text-center">Create Your Account</h1>
            <label for="inputUserName" class="sr-only">UserName</label>
            <input type="text" name="username" id="inputUserName" class="form-control" placeholder="Username" required autofocus>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
            <label for="inputProfilePhoto" class="sr-only">Profile Photo</label>
            <input type="file" name="profilePhoto" id="inputProfilePhoto" class="form-control" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
        </form>
    </div>
    </main>
<?php require_once "partials/footer.php";?>