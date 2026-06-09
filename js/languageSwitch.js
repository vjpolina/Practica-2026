document.addEventListener('DOMContentLoaded', () => {
    const languageStorageKey = 'language';
    const storedLanguage = localStorage.getItem(languageStorageKey);
    const currentLanguage = storedLanguage === 'ro' ? 'ro' : 'en';

    const translations = {
        en: {
            languageToggle: 'ENG',
            home: 'Home',
            explore: 'Explore',
            create: 'Create',
            profile: 'Profile',
            createUnlogged: 'Create',
            encouragementText: 'Share your daily story!',
            actionTextSignUp: 'Sign Up',
            actionTextLogin: 'Login',
            signUpSubmit: 'Sign up',
            loginSubmit: 'Log in',
            exploreText: 'Our most recent stories',
            introText: 'Your Journal',
            mottoHome: 'Life is made of memories, treasure every one.',
            greetingPrefix: 'Hello, ',
            contactTitle: 'Contact us:',
            feedbackBtn: 'Submit feedback',
            logOut: 'Log out',
            privatePost: 'Private post',
            publicPost: 'Public post',
            usernamePlaceholder: 'Username',
            emailPlaceholder: 'Youremailhere@example.com',
            passwordPlaceholder: 'Password',
            feedbackTitle: 'Submit feedback',
            feedbackPrompt: 'We value your input. Tell us what you think.',
            feedbackLabel: 'Feedback',
            feedbackEmailLabel: 'Email',
            feedbackSubmit: 'Send',
            feedbackCancel: 'Cancel',
            feedbackFeedbackPlaceholder: 'Describe your feedback',
            feedbackEmailPlaceholder: 'you@example.com',
            addPostAlt: 'Add post'
        },
        ro: {
            languageToggle: 'RO',
            home: 'Acasă',
            explore: 'Explorează',
            create: 'Creează',
            profile: 'Profil',
            createUnlogged: 'Creează',
            encouragementText: 'Împărtășește-ți povestea zilei!',
            actionTextSignUp: 'Înregistrează-te',
            actionTextLogin: 'Autentifică-te',
            signUpSubmit: 'Înscrie-te',
            loginSubmit: 'Autentifică-te',
            exploreText: 'Cele mai recente povești',
            introText: 'Jurnalul tău',
            mottoHome: 'Viața este făcută din amintiri, prețuiește fiecare.',
            greetingPrefix: 'Bună, ',
            contactTitle: 'Contactează-ne:',
            feedbackBtn: 'Trimite feedback',
            logOut: 'Deconectare',
            privatePost: 'Postare privată',
            publicPost: 'Postare publică',
            usernamePlaceholder: 'Nume de utilizator',
            emailPlaceholder: 'Email@exemplu.com',
            passwordPlaceholder: 'Parolă',
            feedbackTitle: 'Trimite feedback',
            feedbackPrompt: 'Apreciem opinia ta. Spune-ne ce crezi.',
            feedbackLabel: 'Feedback',
            feedbackEmailLabel: 'Email',
            feedbackSubmit: 'Trimite',
            feedbackCancel: 'Anulează',
            feedbackFeedbackPlaceholder: 'Descrie feedback-ul tău',
            feedbackEmailPlaceholder: 'tu@exemplu.com',
            addPostAlt: 'Adaugă postare'
        }
    };

    const lang = currentLanguage;
    const translateValue = (key) => translations[lang][key] || translations.en[key] || '';

    const setText = (id, key) => {
        const element = document.getElementById(id);
        if (!element) return;
        element.textContent = translateValue(key);
    };

    const setPlaceholder = (inputName, key) => {
        const input = document.querySelector(`input[name="${inputName}"]`);
        if (!input) return;
        input.placeholder = translateValue(key);
    };

    const setTextareaPlaceholder = (id, key) => {
        const textarea = document.getElementById(id);
        if (!textarea) return;
        textarea.placeholder = translateValue(key);
    };

    const setAltText = (id, key) => {
        const element = document.getElementById(id);
        if (!element) return;
        element.alt = translateValue(key);
    };

    const setLanguageText = () => {
        const languageToggle = document.getElementById('languageToggle');
        if (languageToggle) {
            languageToggle.textContent = translateValue('languageToggle');
        }
    };

    const translateElements = () => {
        document.documentElement.lang = lang;
        setLanguageText();
        setText('home', 'home');
        setText('explore', 'explore');
        setText('create', 'create');
        setText('profile', 'profile');
        setText('createUnlogged', 'createUnlogged');
        setText('encouragementText', 'encouragementText');
        if (document.getElementById('signUpSubmit')) {
            setText('actionText', 'actionTextSignUp');
            setText('signUpSubmit', 'signUpSubmit');
        }
        if (document.getElementById('loginSubmit')) {
            setText('actionText', 'actionTextLogin');
            setText('loginSubmit', 'loginSubmit');
        }
        setText('toLogin', 'loginSubmit');
        setText('toRegister', 'signUpSubmit');
        setText('exploreText', 'exploreText');
        setText('introText', 'introText');
        setText('contactTitle', 'contactTitle');
        setText('feedbackBtn', 'feedbackBtn');
        setText('feedbackTitle', 'feedbackTitle');
        setText('feedbackPrompt', 'feedbackPrompt');
        setText('feedbackLabel', 'feedbackLabel');
        setText('feedbackEmailLabel', 'feedbackEmailLabel');
        setText('feedbackSubmit', 'feedbackSubmit');
        setText('feedbackCancel', 'feedbackCancel');
        setPlaceholder('email', 'feedbackEmailPlaceholder');
        setTextareaPlaceholder('feedbackText', 'feedbackFeedbackPlaceholder');
        setText('logOut', 'logOut');
        setText('logOutProf', 'logOut');
        setText('languageToggle', 'languageToggle');

        const mottoElement = document.getElementById('motto');
        if (mottoElement) {
            const rawText = mottoElement.textContent.trim();
            const greetingMatch = rawText.match(/^(Hello,|Bună,)\s*(.*)$/);
            if (greetingMatch) {
                mottoElement.textContent = translateValue('greetingPrefix') + greetingMatch[2];
            } else {
                mottoElement.textContent = translateValue('mottoHome');
            }
        }

        setPlaceholder('username', 'usernamePlaceholder');
        setPlaceholder('email', 'emailPlaceholder');
        setPlaceholder('psw', 'passwordPlaceholder');

        setAltText('addPost', 'addPostAlt');
    };

    const toggleLanguage = () => {
        const nextLang = lang === 'ro' ? 'en' : 'ro';
        localStorage.setItem(languageStorageKey, nextLang);
        window.location.reload();
    };

    translateElements();

    const languageToggle = document.getElementById('languageToggle');
    if (languageToggle) {
        languageToggle.addEventListener('click', toggleLanguage);
    }
});