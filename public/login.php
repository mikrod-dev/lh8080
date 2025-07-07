<?php
$page_title = 'Login | lh:8080';
require_once(__DIR__ . '/../config/php/paths.php');
require_once(SECURITY . 'SessionManager.php');
require_once(HELPERS . 'Sanitizer.php');

use Security\SessionManager;
use Helpers\Sanitizer;

SessionManager::init();


$errors = $_SESSION['login_errors'] ?? [];
$data = $_SESSION['login_data'] ?? [];

require_once(LAYOUTS . 'header.php');
unset($_SESSION['login_errors'], $_SESSION['login_data']);
?>

    <main class="container d-flex justify-content-center align-items-center flex-grow-1 mt-5">

        <div class="row col-sm-10 col-md-8 col-lg-6 shadow p-3 bg-white rounded">
            <h2 class="text-center">Iniciá sesión</h2>
            <form id="form" class="row g-3 needs-validation"
                  action="<?php echo HANDLERS ?>login_handler.php"
                  method="post"
                  novalidate>
                <div class="col-12">
                    <label for="username" class="form-label">Nombre de usuario</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" class="form-control" id="username"
                               name="username"
                               placeholder="Ingresá tu usuario"
                               autocomplete="username""
                        value="<?php echo Sanitizer::output($data['username'] ?? '') ?>"
                        required>
                        <div class="invalid-feedback" id="username_feedback">
                            <?php echo $errors['username'] ?? '' ?>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password"
                           name="password"
                           placeholder="Tu contraseña segura"
                           autocomplete="current-password"
                           value="<?php echo Sanitizer::output($data['password'] ?? '') ?>"
                           required>
                    <div class="invalid-feedback" id="password_feedback">
                        <?php echo $errors['password'] ?? '' ?>
                    </div>
                </div>
                <div class="col-12 mt-5 mb-3">
                    <button type="submit" class="btn btn-primary btn-lg w-100">¡Iniciar sesión!</button>
                    <p class="text-end fs-6 fw-light mt-3">¿No tenés cuenta? <a href="signup.php">¡Registrarme!</a></p>
                </div>
            </form>

        </div>

    </main>

    <script type="module" src="<?php echo JS ?>login.js"></script>
<?php require_once(LAYOUTS . 'footer.php'); ?>