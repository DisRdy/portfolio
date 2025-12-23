import './bootstrap';

document.addEventListener('DOMContentLoaded', function() {
    // === NAVBAR TOGGLE ===
    const navToggle = document.getElementById('navToggle');
    const navMenu = document.getElementById('navMenu');
    
    if (navToggle && navMenu) {
        navToggle.addEventListener('click', function() {
            this.classList.toggle('active');
            navMenu.classList.toggle('active');
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            const isClickInside = navToggle.contains(event.target) || navMenu.contains(event.target);
            
            if (!isClickInside && navMenu.classList.contains('active')) {
                navToggle.classList.remove('active');
                navMenu.classList.remove('active');
            }
        });

        // Close menu when clicking on a link
        const navLinks = navMenu.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                navToggle.classList.remove('active');
                navMenu.classList.remove('active');
            });
        });
    }

    // === TOAST NOTIFICATIONS ===
    const toasts = document.querySelectorAll('.toast');
    toasts.forEach(t => {
        setTimeout(() => {
            t.classList.add('hide');
            setTimeout(() => t.remove(), 500); // Remove from DOM after transition
        }, 5000);
    });

    // === DELETE CONFIRMATION MODAL ===
    const deleteForms = document.querySelectorAll('.delete-form-trigger');
    const modal = document.getElementById('confirmation-modal');
    const cancelBtn = document.getElementById('cancel-delete');
    const confirmForm = document.getElementById('delete-form-confirm');

    if (modal && confirmForm) {
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                // Set action of the confirmation form to match the triggered form
                confirmForm.action = this.action;
                modal.style.display = 'flex';
            });
        });

        if (cancelBtn) {
            cancelBtn.addEventListener('click', function() {
                modal.style.display = 'none';
            });
        }

        // Close when clicking outside
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });
    }
});
