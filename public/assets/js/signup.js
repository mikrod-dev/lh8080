import {
    validateName,
    validateUsername,
    validateEmail,
    validatePassword,
    validateConfirmPassword,
    validSubmit
} from "./inputFormValidators.js";

document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("form");
    const name = document.getElementById("name");
    const username = document.getElementById("username");
    const email = document.getElementById("email");
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirm_password");

    const nameFeedback = document.getElementById("name_feedback");
    const usernameFeedback = document.getElementById("username_feedback");
    const emailFeedback = document.getElementById("email_feedback");
    const passwordFeedback = document.getElementById("password_feedback");
    const confirmPasswordFeedback = document.getElementById("confirm_password_feedback");

    name.addEventListener("input", () => validateName(name, nameFeedback));
    username.addEventListener("input", () => validateUsername(username, usernameFeedback));
    email.addEventListener("input", () => validateEmail(email, emailFeedback));
    password.addEventListener("input", () => {
        validatePassword(password, passwordFeedback);
        validateConfirmPassword(password, confirmPassword, confirmPasswordFeedback);
    });
    confirmPassword.addEventListener("input", () => validateConfirmPassword(password, confirmPassword, confirmPasswordFeedback));

    form.addEventListener("submit", (e) => {
        if (!validSubmit(form)) e.preventDefault();
    });
});