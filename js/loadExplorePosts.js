document.addEventListener("DOMContentLoaded", async () => {
    const container = document.querySelector(".cardDisplay");

    try {
        const response = await fetch("get_posts.php?filter=public");
        if (!response.ok) throw new Error(`Server error: ${response.status}`);

        const posts = await response.json();
        container.innerHTML = "";

        if (posts.length === 0) {
            container.innerHTML = `<p class="noPosts">No stories yet. Be the first to share!</p>`;
            return;
        }

        posts.forEach(post => {
            const card = document.createElement("div");
            card.className = "card";
            card.innerHTML = `
                <div class="cardHeader">
                    <span class="cardAuthor"> ${escapeHtml(post.username)}</span>
                    <span class="cardDate">${formatDate(post.created_at)}</span>
                </div>
                <div class="cardBody">${post.content}</div>
            `;
            container.appendChild(card);
        });

    } catch (err) {
        console.error("Failed to load posts:", err);
        container.innerHTML = `<p class="noPosts">Could not load stories. Please try again.</p>`;
    }
});

function formatDate(dateStr) {
    const date = new Date(dateStr.replace(" ", "T"));
    return date.toLocaleString(undefined, {
        year: "numeric", month: "short", day: "numeric",
        hour: "2-digit", minute: "2-digit"
    });
}

function escapeHtml(str) {
    return str.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;");
}
