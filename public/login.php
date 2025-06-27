<?php
$page_title = 'Login | lh:8080';
require_once(__DIR__ . '/../config/php/config.php');
require_once(LAYOUTS . '/header.php');
?>

    <main class="container d-flex justify-content-center align-items-center flex-grow-1 mt-5">

        <div class="row col-sm-10 col-md-8 col-lg-6 shadow p-3 bg-white rounded">
            <h2 class="text-center">Iniciá sesión</h2>
            <form class="row g-3">
                <div class="col-12">
                    <label for="email" class="form-label">Usuario</label>
                    <input type="email" class="form-control" id="email"
                           placeholder="Tu correo electrónico">
                </div>
                <div class="col-12">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password"
                           placeholder="Tu contraseña segura">
                </div>
                <div class="col-12 mt-5 mb-3">
                    <button type="submit" class="btn btn-primary btn-lg w-100">¡Iniciar sesión!</button>
                    <p class="text-end fs-6 fw-light mt-3">¿No tenés cuenta? <a href="signup.php">¡Registrarme!</a></p>
                </div>
            </form>

        </div>

    </main>

<?php require_once(LAYOUTS . '/footer.php'); ?>