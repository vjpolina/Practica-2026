document.addEventListener("DOMContentLoaded", () => {
    const boldBtn = document.getElementById("boldSetting");
    const italicBtn = document.getElementById("italicSetting");
    const underlineBtn = document.getElementById("underlineSetting");
    const privacyBtn = document.getElementById("privacySetting");
    const postBtn = document.getElementById("postBtn");
    const textInput = document.querySelector(".textInput");
    let isPrivate = false;

    function runFormattingCommand(command) {
        if (document.queryCommandSupported && document.queryCommandSupported(command)) {
            document.execCommand(command);
        } else {
            console.warn(`Formatting command not supported: ${command}`);
        }
    }

    if (boldBtn) {
        boldBtn.addEventListener("click", () => runFormattingCommand("bold"));
    }

    if (italicBtn) {
        italicBtn.addEventListener("click", () => runFormattingCommand("italic"));
    }

    if (underlineBtn) {
        underlineBtn.addEventListener("click", () => runFormattingCommand("underline"));
    }

    if (privacyBtn) {
        const privacyImg = privacyBtn.querySelector('img');
        const getTheme = () => localStorage.getItem('theme') || 'day';
        const getLanguage = () => localStorage.getItem('language') === 'ro' ? 'ro' : 'en';

        const translation = {
            en: { private: 'Private post', public: 'Public post' },
            ro: { private: 'Postare privată', public: 'Postare publică' }
        };

        const updatePrivacyIcon = () => {
            const theme = getTheme();
            if (!privacyImg) return;
            privacyImg.src = isPrivate
                ? (theme === 'night' ? '../images/lock-night.png' : '../images/lock.png')
                : (theme === 'night' ? '../images/unlock-night.png' : '../images/unlock.png');
        };

        const updatePrivacyTitle = () => {
            const language = getLanguage();
            privacyBtn.title = isPrivate ? translation[language].private : translation[language].public;
        };

        const initPrivacyIcon = () => {
            updatePrivacyIcon();
            updatePrivacyTitle();
        };

        initPrivacyIcon();

        privacyBtn.addEventListener("click", () => {
            isPrivate = !isPrivate;
            updatePrivacyIcon();
            privacyBtn.title = isPrivate ? 'Private post' : 'Public post';
        });
    }

    const initTextInput = () => {
        if (!textInput) return;
        textInput.contentEditable = "true";
        textInput.setAttribute("tabindex", "0");
        const paragraph = textInput.querySelector("p") || document.createElement("p");
        paragraph.textContent = "";
        if (!textInput.contains(paragraph)) {
            textInput.appendChild(paragraph);
        }
    };

    initTextInput();

    if (textInput) {
        textInput.addEventListener("click", () => textInput.focus());
    }

    if (postBtn && textInput) {
        postBtn.addEventListener("click", async () => {
            const content = textInput.innerHTML.trim();

            if (!content || content === "<p></p>" || content === "<br>") {
                alert("Please write something before posting!");
                return;
            }

            postBtn.disabled = true;
            postBtn.textContent = "Posting…";

            try {
                const response = await fetch("./savePost.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({
                        content: content,
                        is_private: isPrivate
                    })
                });

                const result = await response.json();

                if (result.success) {
                    textInput.innerHTML = "<p></p>";
                    postBtn.textContent = "Posted! ✓";
                    setTimeout(() => {
                        postBtn.textContent = "Post!";
                        postBtn.disabled = false;
                    }, 2000);
                } else {
                    alert("Error: " + (result.message || "Could not save the post."));
                    postBtn.textContent = "Post!";
                    postBtn.disabled = false;
                }
            } catch (err) {
                console.error("Post failed:", err);
                alert("Network error. Please try again.");
                postBtn.textContent = "Post!";
                postBtn.disabled = false;
            }
        });
    }
});