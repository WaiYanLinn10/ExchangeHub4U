<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>

<header class="img-background mb-5" style="height: 300px; background-size: cover; background-position: center; filter: saturate(1.2);">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-7 text-white p-4">
                <h1 class="text-uppercase mb-4 display-4 fw-bold">Welcome Back</h1>
                <p class="lead">Login to access your account and continue your journey.</p>
            </div>
        </div>
    </div>
</header>

<main>
    <div class="container">
        <div class="row justify-content-center mt-5 mb-5">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-5">
                        <h2 class="card-title text-center mb-4 display-6 fw-bold">Login</h2>
                        <form action="/session" method="POST">

                            <div class="mb-4">
                                <label for="email" class="form-label fw-bold">Email address</label>
                                <input id="email"
                                    name="email"
                                    type="email"
                                    autocomplete="email"
                                    required
                                    class="form-control rounded-top"
                                    placeholder="Email address"
                                    value="<?= old('email') ?>">
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label fw-bold">Password</label>
                                <input id="password"
                                    name="password"
                                    type="password"
                                    autocomplete="current-password"
                                    required
                                    class="form-control rounded-bottom"
                                    placeholder="Password">
                            </div>

                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary btn-lg fw-bold">Login</button>
                            </div>

                            <div class="text-center mt-4">
                                <p class="text-muted">Don't have an account? <a href="/register" class="text-decoration-none fw-bold">Register here</a></p>
                            </div>

                            <ul class="list-unstyled">
                                <?php if (isset($errors['email'])) : ?>
                                    <li class="alert alert-danger"><?= $errors['email'] ?></li>
                                <?php endif; ?>

                                <?php if (isset($errors['password'])) : ?>
                                    <li class="alert alert-danger"><?= $errors['password'] ?></li>
                                <?php endif; ?>
                            </ul>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require base_path('views/partials/footer.php') ?>