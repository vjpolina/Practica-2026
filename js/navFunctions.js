const signupBtn = document.getElementById("toRegister");
const loginBtn = document.getElementById("toLogin");
const toHome = document.getElementById("home");
const toExplore = document.getElementById("explore");
const toCreate = document.getElementById("create");
const toCreateProf = document.getElementById("addPost");
const toProfile = document.getElementById("profile");

const unloggedCreate = document.getElementById("createUnlogged");

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

if (toHome) {
    toHome.addEventListener("click", function() {
        console.log("Home button clicked");
        window.location.href = "index.php";
    });
}

if (toProfile) {
    toProfile.addEventListener("click", function() {
        console.log("Profile button clicked");
        window.location.href = "profile.php";
    });
}

if (toExplore) {
    toExplore.addEventListener("click", function() {
        console.log("Explore button clicked");
        window.location.href = "explore.php";
    });
}

if (toCreate) {
    toCreate.addEventListener("click", function() {
        console.log("Create button clicked");
        window.location.href = "create.php";
    });
}

if (toCreateProf) {
    toCreateProf.addEventListener("click", function() {
        console.log("Create button clicked");
        window.location.assign("create.php");
    });
}

if (unloggedCreate) {
    unloggedCreate.addEventListener("click", function() {
        console.log("Create button clicked while not logged in");
        window.location.href = "register.php";
    });
}
