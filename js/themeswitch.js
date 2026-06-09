const changeButton = document.getElementById('theme_switch');
const stateIcon = document.getElementById('theme_icon');
const themeStyle = document.getElementById('theme_state');
const privacyBtn = document.getElementById('privacySetting');
const privacyImg = privacyBtn ? privacyBtn.querySelector('img') : null;

function applyTheme(theme) {
    if (!themeStyle) return;
    if (theme === 'night') {
        themeStyle.href = "../css/nightColors.css";
        if (stateIcon) stateIcon.src = "../images/sun.png";
        if (privacyImg) privacyImg.src = "../images/unlock-night.png";
    } else {
        themeStyle.href = "../css/dayColors.css";
        if (stateIcon) stateIcon.src = "../images/moon.png";
        if (privacyImg) privacyImg.src = "../images/unlock.png";
    }
}

let theme = localStorage.getItem('theme') || 'day';
applyTheme(theme);

function switchTheme() {
    theme = theme === 'night' ? 'day' : 'night';
    localStorage.setItem('theme', theme);
    applyTheme(theme);
}

if (changeButton) {
    changeButton.addEventListener('click', switchTheme);
}