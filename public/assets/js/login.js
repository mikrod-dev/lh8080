import {validatePasswordLogin, validateUsernameLogin, validSubmit} from "./inputFormValidators.js";

document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("form");
    const username = document.getElementById("username");
    const password = document.getElementById("password");
    const usernameFeedback = document.getElementById("username_feedback");
    const passwordFeedback = document.getElementById("password_feedback");

    username.addEventListener("input", () => validateUsernameLogin(username, usernameFeedback));
    password.addEventListener("input", () => validatePasswordLogin(password, passwordFeedback));

    form.addEventListener("submit", (e) => {
        if (!validSubmit(form)) e.preventDefault();
    });
})