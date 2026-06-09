document.getElementById("boldSetting").addEventListener("click", () => {
    document.execCommand("bold");
});

document.getElementById("italicSetting").addEventListener("click", () => {
    document.execCommand("italic");
});

document.getElementById("underlineSetting").addEventListener("click", () => {
    document.execCommand("underline");
});

// privacy
let isPrivate = false;
const privacyBtn = document.getElementById("privacySetting");
if (privacyBtn) {
    const privacyImg = privacyBtn.querySelector('img');
    const getTheme = () => localStorage.getItem('theme') || 'day';

    // initialize icon based on current theme
    (function initPrivacyIcon() {
        const theme = getTheme();
        if (privacyImg) {
            privacyImg.src = isPrivate
                ? (theme === 'night' ? '../images/lock-night.png' : '../images/lock.png')
                : (theme === 'night' ? '../images/unlock-night.png' : '../images/unlock.png');
        }
        privacyBtn.title = isPrivate ? 'Private post' : 'Public post';
    })();

    privacyBtn.addEventListener("click", () => {
        isPrivate = !isPrivate;
        const theme = getTheme();
        if (privacyImg) {
            privacyImg.src = isPrivate
                ? (theme === 'night' ? '../images/lock-night.png' : '../images/lock.png')
                : (theme === 'night' ? '../images/unlock-night.png' : '../images/unlock.png');
        }
        privacyBtn.title = isPrivate ? 'Private post' : 'Public post';
    });
}

// edit text
const textInput = document.querySelector(".textInput");
textInput.setAttribute("contenteditable", "true");
textInput.querySelector("p").textContent = "";

// post
document.getElementById("postBtn").addEventListener("click", async () => {
    const content = textInput.innerHTML.trim();

    if (!content || content === "<p></p>" || content === "<br>") {
        alert("Please write something before posting!");
        return;
    }

    const postBtn = document.getElementById("postBtn");
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
            // Clear editor and give feedback
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