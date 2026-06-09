document.addEventListener('DOMContentLoaded', () => {
    const feedbackBtn = document.getElementById('feedbackBtn');
    const modal = document.getElementById('feedbackModal');
    const backdrop = document.getElementById('feedbackBackdrop');
    const closeBtn = document.getElementById('feedbackClose');
    const cancelBtn = document.getElementById('feedbackCancel');
    const feedbackForm = document.getElementById('feedbackForm');
    const feedbackText = document.getElementById('feedbackText');
    const feedbackEmail = document.getElementById('feedbackEmail');
    const feedbackSubmit = document.getElementById('feedbackSubmit');
    const feedbackMessage = document.querySelector('.feedback-message');

    const openModal = () => {
        if (!modal) return;
        modal.classList.remove('hidden');
        modal.setAttribute('aria-hidden', 'false');
        if (feedbackText) feedbackText.focus();
    };

    const closeModal = () => {
        if (!modal) return;
        modal.classList.add('hidden');
        modal.setAttribute('aria-hidden', 'true');
        if (feedbackForm) feedbackForm.reset();
        if (feedbackMessage) {
            feedbackMessage.textContent = '';
            feedbackMessage.classList.remove('error', 'success');
        }
        if (feedbackSubmit) {
            feedbackSubmit.disabled = false;
            feedbackSubmit.textContent = feedbackSubmit.dataset.default || 'Send';
        }
    };

    if (feedbackBtn) {
        feedbackBtn.addEventListener('click', openModal);
    }
    if (closeBtn) {
        closeBtn.addEventListener('click', closeModal);
    }
    if (cancelBtn) {
        cancelBtn.addEventListener('click', closeModal);
    }
    if (backdrop) {
        backdrop.addEventListener('click', closeModal);
    }
    window.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && modal && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });

    if (!feedbackForm) {
        return;
    }

    feedbackForm.addEventListener('submit', async (event) => {
        event.preventDefault();
        if (!feedbackText || !feedbackEmail || !feedbackSubmit || !feedbackMessage) {
            return;
        }

        const feedbackValue = feedbackText.value.trim();
        const emailValue = feedbackEmail.value.trim();

        if (!feedbackValue || feedbackValue.length < 10) {
            feedbackMessage.textContent = 'Please provide at least 10 characters of feedback.';
            feedbackMessage.classList.add('error');
            feedbackText.focus();
            return;
        }

        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(emailValue)) {
            feedbackMessage.textContent = 'Please enter a valid email address.';
            feedbackMessage.classList.add('error');
            feedbackEmail.focus();
            return;
        }

        feedbackSubmit.disabled = true;
        feedbackSubmit.textContent = 'Sending...';
        feedbackMessage.textContent = '';
        feedbackMessage.classList.remove('error', 'success');

        try {
            const response = await fetch('submitFeedback.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    feedback: feedbackValue,
                    email: emailValue
                })
            });

            const result = await response.json();

            if (result.success) {
                feedbackMessage.textContent = 'Thank you! Your feedback was submitted.';
                feedbackMessage.classList.add('success');
                setTimeout(closeModal, 1500);
            } else {
                feedbackMessage.textContent = result.message || 'Could not submit feedback. Please try again.';
                feedbackMessage.classList.add('error');
                feedbackSubmit.disabled = false;
                feedbackSubmit.textContent = feedbackSubmit.dataset.default || 'Send';
            }
        } catch (error) {
            console.error('Feedback submit failed:', error);
            feedbackMessage.textContent = 'Network error. Please try again.';
            feedbackMessage.classList.add('error');
            feedbackSubmit.disabled = false;
            feedbackSubmit.textContent = feedbackSubmit.dataset.default || 'Send';
        }
    });
});