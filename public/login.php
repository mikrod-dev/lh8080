<?php
$page_title = 'Login | lh:8080';
require_once(__DIR__ . '/../config/php/config.php');
require_once(LAYOUTS . '/header.php');
?>

    <main class="container d-flex justify-content-center align-items-center flex-grow-1 mt-5">

        <div class="row col-sm-10 col-md-8 col-lg-6 shadow p-3 bg-white rounded">
            <h2 class="text-center">Iniciá sesión</h2>
            <form class="row g-3 needs-validation">
                <div class="col-12">
                    <label for="username" class="form-label">Nombre de usuario</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" class="form-control" id="username"
                               placeholder="Ingresá tu usuario"
                               required>
                        <div class="" id="username_feedback"></div>
                    </div>
                </div>
                <div class="col-12">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password"
                           placeholder="Tu contraseña segura"
                           required>
                    <div class="" id="password_feedback"></div>
                </div>
                <div class="col-12 mt-5 mb-3">
                    <button type="submit" class="btn btn-primary btn-lg w-100">¡Iniciar sesión!</button>
                    <p class="text-end fs-6 fw-light mt-3">¿No tenés cuenta? <a href="signup.php">¡Registrarme!</a></p>
                </div>
            </form>

        </div>

    </main>
    <script type="module" src="<?php echo JS?>login.js"></script>
<?php require_once(LAYOUTS . '/footer.php'); ?>