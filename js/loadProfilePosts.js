document.addEventListener("DOMContentLoaded", async () => {
    const container = document.querySelector(".containedPosts");

    try {
        const response = await fetch("get_posts.php?filter=mine");
        if (!response.ok) throw new Error(`Server error: ${response.status}`);

        const posts = await response.json();
        container.innerHTML = "";

        if (posts.length === 0) {
            container.innerHTML = `<p class="noPosts">You haven't written anything yet. <a href="create.php">Start your journal!</a></p>`;
            return;
        }

        posts.forEach(post => {
            const card = document.createElement("div");
            card.className = "card";
            card.innerHTML = `
                <div class="cardHeader">
                    <span class="cardDate">${formatDate(post.created_at)}</span>
                    <span class="cardPrivacy">${post.is_private ? "Private" : "Public"}</span>
                </div>
                <div class="cardBody">${post.content}</div>
            `;
            container.appendChild(card);
        });

    } catch (err) {
        console.error("Failed to load posts:", err);
        container.innerHTML = `<p class="noPosts">Could not load your posts. Please try again.</p>`;
    }
});

function formatDate(dateStr) {
    const date = new Date(dateStr.replace(" ", "T"));
    return date.toLocaleString(undefined, {
        year: "numeric", month: "short", day: "numeric",
        hour: "2-digit", minute: "2-digit"
    });
}
