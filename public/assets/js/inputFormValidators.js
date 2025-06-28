const MIN_INPUT_LENGTH = 3;
const MIN_PASSWORD_LENGTH = 8;

export function validateName(name, feedback) {
    const isValid = name.value.trim().length >= MIN_INPUT_LENGTH;
    toggleValidationClass(name, isValid);
    toggleFeedbackClass(
        feedback,
        isValid,
        '¡Se ve bien!',
        `Los nombres distinguidos tienen mán de ${MIN_INPUT_LENGTH} caracteres`
    );
}

export function validateUsername(username, feedback) {
    const isValid = username.value.trim().length >= MIN_INPUT_LENGTH;
    toggleValidationClass(username, isValid);
    toggleFeedbackClass(
        feedback,
        isValid,
        '¡Se ve bien!',
        `Usá más de ${MIN_INPUT_LENGTH} caracteres para que no te confundan con otros`
    );
}

export function validateEmail(email, feedback) {
    const isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value);
    toggleValidationClass(email, isValid);
    toggleFeedbackClass(
        feedback,
        isValid,
        '¡Se ve bien!',
        'Poné un email válido, por favor'
    );
}

export function validatePassword(password, feedback) {
    const isValid = password.value.length >= MIN_PASSWORD_LENGTH;
    toggleValidationClass(password, isValid);
    toggleFeedbackClass(
        feedback,
        isValid,
        '¡Se ve bien!',
        `¡Esa clave es muy corta! usá más de ${MIN_PASSWORD_LENGTH} caracteres`
    );
}

export function validateConfirmPassword(password, confirmPassword, confirmPasswordFeedback) {
    const isValid = password.value === confirmPassword.value;
    toggleValidationClass(confirmPassword, isValid);
    toggleFeedbackClass(
        confirmPasswordFeedback,
        isValid,
        '¡Se ve bien!',
        'Que no se note cuál es la original... ¡hacelas iguales!'
    );
}

export function validSubmit(form) {
    const inputs = Array.from(form.querySelectorAll('input'));

    inputs.forEach(input => {
        if (!input.classList.contains('is-valid')) {
            input.classList.add('is-invalid');
        }
    })

    return inputs.every(input => input.classList.contains('is-valid'));
}

export function validateUsernameLogin(username, feedback) {
    if (isEmpty(username)) {
        invalidInputLogin(username, feedback, '¡Psst! este campo es necesario');
    } else {
        clearInvalidInputLogin(username, feedback);
    }
}

export function validatePasswordLogin(password, feedback) {
    if (isEmpty(password)) {
        invalidInputLogin(password, feedback, '¡Contraseña es clave!');
    } else {
        clearInvalidInputLogin(password, feedback);
    }
}

function toggleValidationClass(input, isValid) {
    input.classList.remove('is-valid', 'is-invalid');
    input.classList.add(isValid ? 'is-valid' : 'is-invalid');
}

function toggleFeedbackClass(feedback, isValid, validMessage, invalidMessage) {
    feedback.classList.remove('valid-feedback', 'invalid-feedback');
    feedback.classList.add(isValid ? 'valid-feedback' : 'invalid-feedback');
    feedback.innerHTML = isValid ? validMessage : invalidMessage;
}

function isEmpty(input) {
    return input.value.trim() === '';
}

function invalidInputLogin(input, feedback, message) {
    input.classList.remove('is-valid', 'is-invalid');
    input.classList.add('is-invalid');
    feedback.classList.remove('valid-feedback', 'invalid-feedback');
    feedback.classList.add('invalid-feedback');
    feedback.innerHTML = message;
}

function clearInvalidInputLogin(input, feedback) {
    input.classList.remove('is-invalid');
    feedback.classList.remove('invalid-feedback');
    feedback.innerHTML = '';
}