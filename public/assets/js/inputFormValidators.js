import GENERAL_CONFIG from "./general.js.php" ;
import LANG_CONFIG from "./lang.js.php";

const MIN_NAME_LENGTH = GENERAL_CONFIG['minNameLength'];
const MIN_USERNAME_LENGTH = GENERAL_CONFIG['minUsernameLength'];
const MIN_PASSWORD_LENGTH = GENERAL_CONFIG['minPasswordLength'];


function setValidationClass(input, isValid, showValid = true) {
    input.classList.remove('is-valid', 'is-invalid');

    if (!isValid) {
        input.classList.add('is-invalid');
    } else if (showValid) {
        input.classList.add('is-valid');
    }
}

function setFeedbackClass(feedback, isValid, validMessage, invalidMessage, showValid = true) {
    feedback.classList.remove('valid-feedback', 'invalid-feedback');

    if (!isValid) {
        feedback.classList.add('invalid-feedback');
    } else if (showValid) {
        feedback.classList.add('valid-feedback');
    }
    feedback.innerHTML = isValid ? validMessage : invalidMessage;
}


function isEmpty(input) {
    return input.value.trim().length === 0;
}

// Funciones signup
export function validateName(name, feedback) {
    const isValid = name.value.trim().length >= MIN_NAME_LENGTH;

    setValidationClass(name, isValid);
    setFeedbackClass(feedback, isValid, LANG_CONFIG['valid_input'], LANG_CONFIG['short_name']);
}

export function validateUsername(username, feedback) {
    const isValid = username.value.trim().length >= MIN_USERNAME_LENGTH;

    setValidationClass(username, isValid);
    setFeedbackClass(feedback, isValid, LANG_CONFIG['valid_input'], LANG_CONFIG['short_username']);
}

export function validateEmail(email, feedback) {
    const isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value);

    setValidationClass(email, isValid);
    setFeedbackClass(feedback, isValid, LANG_CONFIG['valid_input'], LANG_CONFIG['invalid_email']);
}

export function validatePassword(password, feedback) {
    const isValid = password.value.length >= MIN_PASSWORD_LENGTH;

    setValidationClass(password, isValid);
    setFeedbackClass(feedback, isValid, LANG_CONFIG['valid_input'], LANG_CONFIG['short_password']);
}

export function validateConfirmPassword(password, confirmPassword, confirmPasswordFeedback) {
    const isValidLength = confirmPassword.value.length >= MIN_PASSWORD_LENGTH;
    const isValidValue = isValidLength && password.value === confirmPassword.value;
    const isValid = isValidLength && isValidValue;

    setValidationClass(confirmPassword, isValid);
    setFeedbackClass(confirmPasswordFeedback, isValid, LANG_CONFIG['valid_input'], LANG_CONFIG['password_mismatch']);

}

export function validSubmitSignup(form) {
    const inputs = Array.from(form.querySelectorAll('input'));

    inputs.forEach(input => {
        if (!input.classList.contains('is-valid')) {
            input.classList.add('is-invalid');
        }
    })

    return inputs.every(input => input.classList.contains('is-valid'));
}

// Funciones login

export function validateUsernameLogin(username, feedback) {
    const isValid = !isEmpty(username);

    setValidationClass(username, isValid, false);
    setFeedbackClass(feedback, isValid, '', LANG_CONFIG['required_username'], false);
}

export function validatePasswordLogin(password, feedback) {
    const isValid = !isEmpty(password);

    setValidationClass(password, isValid, false);
    setFeedbackClass(feedback, isValid, '', LANG_CONFIG['required_password'], false);
}

export function validSubmitLogin(form) {
    const username = form.querySelector('#username');
    const password = form.querySelector('#password');
    const isUsernameFilled = !isEmpty(username);
    const isPasswordFilled = !isEmpty(password);

    if (!isUsernameFilled) {
        username.classList.add('is-invalid');
    }

    if (!isPasswordFilled) {
        password.classList.add('is-invalid');
    }

    return (isUsernameFilled && isPasswordFilled);
}