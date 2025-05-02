<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>

<main>
    <div class="container-fluid">
        <div class="row min-vh-100">

            <div class="col-md-5 img-background px-0">
                <div class="container-fluid h-100 d-flex align-items-center justify-content-center">
                    <div class="text-center text-white p-4" style="background-color: rgba(0, 0, 0, 0.5);">
                        <h3 class="display-5 fw-bold">Hello!</h3>
                        <p class="lead">Enter your personal details and start your journey with us.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-7 p-5 d-flex align-items-center justify-content-center">
                <div class="w-100" style="max-width: 500px;">
                    <div class="text-center mb-5">
                        <h1 class="color-1 fw-light display-4">Create Your Account</h1>
                        <small class="text-muted">Already have an account? 
                            <a href="/login" class="text-decoration-none fw-bold">Log in</a>
                        </small>
                    </div>

                    <form action="/register" method="POST">
                        <div class="mb-4">
                            <input type="text" class="form-control rounded-0" name="username" placeholder="Username" required>
                        </div>

                        <div class="mb-4">
                            <input type="email" class="form-control rounded-0" name="email" placeholder="Email" required>
                        </div>

                        <div class="mb-4">
                            <input type="password" class="form-control rounded-0" id="password" name="password" placeholder="Password" required>
                        </div>

                        <div class="mb-4">
                            <input type="password" class="form-control rounded-0" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required oninput="checkPwd()">
                            <small id="passwordValidateHelper" class="text-danger"></small>
                        </div>

                        <ul class="list-unstyled">
                        <?php if (isset($errors['username'])) : ?>
                                <li class="alert alert-danger"><?= $errors['username'] ?></li>
                            <?php endif; ?>
                            <?php if (isset($errors['email'])) : ?>
                                <li class="alert alert-danger"><?= $errors['email'] ?></li>
                            <?php endif; ?>

                            <?php if (isset($errors['password'])) : ?>
                                <li class="alert alert-danger"><?= $errors['password'] ?></li>
                            <?php endif; ?>
                        </ul>

                        <div class="form-check mb-4">
                            <input class="form-check-input rounded-0" type="checkbox" name="termscheck" id="termscheck" required>
                            <label class="form-check-label" for="termscheck">
                                <small>Accept <a href="#" class="text-decoration-none fw-bold">the Terms and Privacy Policy</a></small>
                            </label>
                        </div>

                        <div class="d-grid">
                            <button class="btn btn-dark py-2 rounded-0" type="submit" id="registerBtn">REGISTER</button>
                        </div>


                    </form>
                </div>
            </div>

        </div>
    </div>
</main>

<script>
  function checkPwd() {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    const helper = document.getElementById('passwordValidateHelper');

    if (password !== confirmPassword) {
      helper.textContent = 'Passwords do not match!';
    } else {
      helper.textContent = '';
    }
  }
</script>

<?php require base_path('views/partials/footer.php') ?>