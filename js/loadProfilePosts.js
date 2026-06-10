document.addEventListener("DOMContentLoaded", async () => {
    const container = document.querySelector(".containedPosts");
    if (!container) return;

    container.addEventListener("click", async (e) => {
        const deleteBtn = e.target.closest(".deleteBtn");
        if (!deleteBtn || deleteBtn.disabled) return;

        const postId = deleteBtn.dataset.postId;
        if (!postId) return;

        if (!confirm("Delete this post? This cannot be undone.")) return;

        deleteBtn.disabled = true;

        try {
            const response = await fetch("deletePost.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ post_id: postId })
            });

            const result = await response.json();

            if (result.success) {
                const card = deleteBtn.closest(".card");
                card?.remove();

                if (!container.querySelector(".card")) {
                    container.innerHTML = `<p class="noPosts">You haven't written anything yet. <a href="create.php">Start your journal!</a></p>`;
                }
            } else {
                alert("Error: " + (result.message || "Could not delete the post."));
                deleteBtn.disabled = false;
            }
        } catch (err) {
            console.error("Delete failed:", err);
            alert("Network error. Please try again.");
            deleteBtn.disabled = false;
        }
    });

    try {
        const response = await fetch("get_posts.php?filter=mine");
        if (!response.ok) throw new Error(`Server error: ${response.status}`);

        const posts = await response.json();
        container.innerHTML = "";

        if (posts.length === 0) {
            container.innerHTML = `<p class="noPosts">You haven't written anything yet.</p>`;
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
                <div class="cardFooter">
                    <button type="button" class="deleteBtn" data-post-id="${post.id}" title="Delete post">
                        <img src="../images/trash.png" alt="Delete" class="deleteIcon">
                    </button>
                </div>
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
