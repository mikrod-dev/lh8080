import {validatePasswordLogin, validateUsernameLogin, validSubmitLogin} from "./inputFormValidators.js";

document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("form");
    const username = document.getElementById("username");
    const password = document.getElementById("password");
    const usernameFeedback = document.getElementById("username_feedback");
    const passwordFeedback = document.getElementById("password_feedback");

    username.addEventListener("blur", () => validateUsernameLogin(username, usernameFeedback));
    password.addEventListener("blur", () => validatePasswordLogin(password, passwordFeedback));

    form.addEventListener("submit", (e) => {
        validateUsernameLogin(username, usernameFeedback);
        validatePasswordLogin(password, passwordFeedback);

        if (!validSubmitLogin(form)) e.preventDefault();
    });
})