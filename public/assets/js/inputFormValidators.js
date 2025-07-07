import GENERAL_CONFIG from "./general.js.php" ;
import LANG_CONFIG from "./lang.js.php";

const MIN_NAME_LENGTH = GENERAL_CONFIG['minNameLength'];
const MIN_USERNAME_LENGTH = GENERAL_CONFIG['minUsernameLength'];
const MIN_PASSWORD_LENGTH = GENERAL_CONFIG['minPasswordLength'];

export function validateName(name, feedback) {
    const isValid = name.value.trim().length >= MIN_NAME_LENGTH;
    toggleValidationClass(name, isValid);
    toggleFeedbackClass(
        feedback,
        isValid,
        LANG_CONFIG['valid_input'],
        LANG_CONFIG['short_name']
    );
}

export function validateUsername(username, feedback) {
    const isValid = username.value.trim().length >= MIN_USERNAME_LENGTH;
    toggleValidationClass(username, isValid);
    toggleFeedbackClass(
        feedback,
        isValid,
        LANG_CONFIG['valid_input'],
        LANG_CONFIG['short_username']
    );
}

export function validateEmail(email, feedback) {
    const isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value);
    toggleValidationClass(email, isValid);
    toggleFeedbackClass(
        feedback,
        isValid,
        LANG_CONFIG['valid_input'],
        LANG_CONFIG['invalid_email']
    );
}

export function validatePassword(password, feedback) {
    const isValid = password.value.length >= MIN_PASSWORD_LENGTH;
    toggleValidationClass(password, isValid);
    toggleFeedbackClass(
        feedback,
        isValid,
        LANG_CONFIG['valid_input'],
        LANG_CONFIG['short_password']
    );
}

export function validateConfirmPassword(password, confirmPassword, confirmPasswordFeedback) {
    const isValidLength = confirmPassword.value.length >= MIN_PASSWORD_LENGTH;
    const isValidValue = isValidLength && password.value === confirmPassword.value;
    const isValid = isValidLength && isValidValue;

    toggleValidationClass(confirmPassword, isValid);
    toggleFeedbackClass(
        confirmPasswordFeedback,
        isValid,
        LANG_CONFIG['valid_input'],
        LANG_CONFIG['password_mismatch']
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
        invalidInputLogin(username, feedback, LANG_CONFIG['required_username']);
    } else {
        clearInvalidInputLogin(username, feedback);
    }
}

export function validatePasswordLogin(password, feedback) {
    if (isEmpty(password)) {
        invalidInputLogin(password, feedback, LANG_CONFIG['required_password']);
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

export function clearInput(input, feedback) {
    input.classList.remove('is-valid', 'is-invalid');
    feedback.classList.remove('valid-feedback', 'invalid-feedback');
    feedback.innerHTML = '';
}