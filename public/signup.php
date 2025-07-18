<?php
require_once(__DIR__ . '/../config/php/paths.php');
require_once(SECURITY . 'SessionManager.php');
require_once(HELPERS . 'Sanitizer.php');

use Security\SessionManager;
use Helpers\Sanitizer;

SessionManager::init();


$page_title = 'Signup | lh:8080';
$errors = $_SESSION['signup_errors'] ?? [];
$data = $_SESSION['signup_data'] ?? [];

require_once(PARTIALS . 'header.php');
unset($_SESSION['signup_errors'], $_SESSION['signup_data']);
?>
    <body class="container d-flex flex-column min-vh-100">
<header>
    <?php require_once(PARTIALS . 'nav.public.php'); ?>
</header>

    <main class="d-flex justify-content-center align-items-center flex-grow-1 mt-5">

        <div class="row col-sm-10 col-md-8 col-lg-6 shadow p-3 bg-white rounded">
            <h2 class="text-center">Registrá una cuenta</h2>
            <form id="form" class="row g-3 needs-validation"
                  action="<?php echo HANDLERS ?>signup_handler.php"
                  method="post"
                  novalidate>
                <div class="col-12">
                    <label for="name" class="form-label">¿Cómo querés que te llamemos?</label>
                    <input type="text" id="name"
                           class="form-control <?php echo isset($errors['name']) ? 'is-invalid' : '' ?>"
                           name="name"
                           placeholder="Podés usar tu nombre o apodo"
                           value="<?php echo Sanitizer::output($data['name'] ?? '') ?>"
                           required>
                    <div class="invalid-feedback" id="name_feedback">
                        <?php echo $errors['name'] ?? '' ?>
                    </div>
                </div>
                <div class="col-12">
                    <label for="username" class="form-label">Nombre de usuario</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" id="username"
                               class="form-control <?php echo isset($errors['username']) ? 'is-invalid' : '' ?>"
                               name="username"
                               placeholder="Este será tu usuario para iniciar sesión"
                               value="<?php echo Sanitizer::output($data['username'] ?? '') ?>"
                               aria-describedby="username_feedback inputGroupPrepend"
                               required>
                        <div class="invalid-feedback" id="username_feedback">
                            <?php echo $errors['username'] ?? '' ?>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" id="email"
                           class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : '' ?>"
                           name="email"
                           placeholder="Este es el contacto principal de tu cuenta"
                           value="<?php echo Sanitizer::output($data['email'] ?? '') ?>"
                           required>
                    <div class="invalid-feedback" id="email_feedback">
                        <?php echo $errors['email'] ?? '' ?>
                    </div>
                </div>
                <div class="col-12">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" id="password"
                           class="form-control <?php echo isset($errors['password']) ? 'is-invalid' : '' ?>"
                           name="password"
                           placeholder="Elegí una contraseña segura"
                           required>
                    <div class="invalid-feedback" id="password_feedback">
                        <?php echo $errors['password'] ?? '' ?>
                    </div>
                </div>
                <div class="col-12">
                    <label for="confirm_password" class="form-label">Volvé a ingresar tu contraseña</label>
                    <input type="password" id="confirm_password"
                           class="form-control <?php echo isset($errors['confirm_password']) ? 'is-invalid' : '' ?>"
                           name="confirm_password"
                           placeholder="Es para confirmar"
                           required>
                    <div class="invalid-feedback" id="confirm_password_feedback">
                        <?php echo $errors['confirm_password'] ?? '' ?>
                    </div>
                </div>
                <div class="col-12 mt-5 mb-3">
                    <button type="submit" class="btn btn-primary btn-lg w-100">¡Registrame!</button>
                    <p class="text-end fs-6 fw-light mt-3">¿Ya tenés cuenta? <a href="login.php">¡Iniciá sesión!</a></p>
                </div>
            </form>

        </div>

    </main>

    <script type="module" src="<?php echo JS ?>signup.js"></script>
    </body>
<?php require_once(PARTIALS . 'footer.php'); ?>