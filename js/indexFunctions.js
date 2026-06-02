const signupBtn = document.getElementById("toRegister");
const loginBtn = document.getElementById("toLogin");

if (signupBtn) {
    signupBtn.addEventListener("click", function() {
        console.log("Sign up button clicked");
        window.location.href = "register.php";
    });
}

if (loginBtn) {
    loginBtn.addEventListener("click", function() {
        console.log("Log in button clicked");
        window.location.href = "login.php";
    });
}
