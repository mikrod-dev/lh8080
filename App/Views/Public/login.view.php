<?php
$page_title = 'Login | lh:8080';
require_once(__DIR__ . '/../../../config/php/paths.php');
require_once(__DIR__ . '/../../../bootstrap/autoload.php');

use Security\SessionManager;
use Helpers\Sanitizer;

SessionManager::init();

$errors = SessionManager::get('login_errors') ?? [];
$data = SessionManager::get('login_data') ?? [];

SessionManager::delete( 'login_errors' );
SessionManager::delete( 'login_data' );
require_once(PARTIALS . 'header.php');
?>
    <body class="container d-flex flex-column min-vh-100">
<header>
    <?php require_once(PARTIALS . 'nav.public.php'); ?>
</header>

    <main class="d-flex justify-content-center align-items-center flex-grow-1 mt-5">

        <div class="row col-sm-10 col-md-8 col-lg-6 shadow p-3 bg-white rounded">
            <h2 class="text-center">Iniciá sesión</h2>
            <form id="form" class="row g-3 needs-validation"
                  action="/login"
                  method="post"
                  autocomplete="on"
                  novalidate>
                <div class="col-12">
                    <label for="username" class="form-label">Nombre de usuario</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" id="username"
                               class="form-control <?php echo isset($errors['username']) ? 'is-invalid' : '' ?>"
                               name="username"
                               placeholder="Ingresá tu usuario"
                               value="<?php echo Sanitizer::output($data['username'] ?? '') ?>"
                               autocomplete="username"
                               required>
                        <div class="invalid-feedback" id="username_feedback">
                            <?php echo $errors['username'] ?? '' ?>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" id="password"
                           class="form-control <?php echo isset($errors['password']) ? 'is-invalid' : '' ?>"
                           name="password"
                           placeholder="Tu contraseña segura"
                           value="<?php echo Sanitizer::output($data['password'] ?? '') ?>"
                           autocomplete="current-password"
                           required>
                    <div class="invalid-feedback" id="password_feedback">
                        <?php echo $errors['password'] ?? '' ?>
                    </div>
                </div>
                <div class="col-12 mt-5 mb-3">
                    <button type="submit" class="btn btn-primary btn-lg w-100">¡Iniciar sesión!</button>
                    <p class="text-end fs-6 fw-light mt-3">¿No tenés cuenta? <a href="/signup">¡Registrarme!</a></p>
                </div>
            </form>

        </div>

    </main>

    <script type="module" src="<?php echo JS ?>login.js"></script>
    </body>
<?php require_once(PARTIALS . 'footer.php'); ?>