<?php
$page_title = 'Signup | lh:8080';
require_once(__DIR__ . '/../config/php/config.php');
require_once(LAYOUTS . '/header.php');
?>

    <main class="container d-flex justify-content-center align-items-center flex-grow-1 mt-5">

        <div class="row col-sm-10 col-md-8 col-lg-6 shadow p-3 bg-white rounded">
            <h2 class="text-center">Registrá una cuenta</h2>
            <form class="row g-3">
                <div class="col-12">
                    <label for="name" class="form-label">¿Cómo querés que te llamemos?</label>
                    <input type="text" class="form-control is-invalid" id="name"
                           placeholder="Podés usar tu nombre o apodo"
                           required>
                    <div class="invalid-feedback">
                        Se ve bien!
                    </div>
                </div>
                <div class="col-12">
                    <label for="username" class="form-label">Nombre de usuario</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" class="form-control is-valid" id="username"
                               placeholder="Este será tu usuario para iniciar sesión"
                               aria-describedby="usernameFeedback inputGroupPrepend"
                               required>
                        <div class="valid-feedback" id="usernameFeedback">
                            Se ve bien!
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control" id="email"
                           placeholder="Este es el contacto principal de tu cuenta"
                           required>
                </div>
                <div class="col-12">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password"
                           placeholder="Elegí una contraseña segura"
                           required>
                </div>
                <div class="col-12">
                    <label for="confirm_password" class="form-label">Volvé a ingresar tu contraseña</label>
                    <input type="password" class="form-control" id="confirm_password"
                           placeholder="Es para confirmar"
                           required>
                </div>
                <div class="col-12 mt-5 mb-3">
                    <button type="submit" class="btn btn-primary btn-lg w-100">¡Registrame!</button>
                    <p class="text-end fs-6 fw-light mt-3">¿Ya tenés cuenta? <a href="login.php">¡Iniciá sesión!</a></p>
                </div>
            </form>

        </div>

    </main>

<?php require_once(LAYOUTS . '/footer.php'); ?>