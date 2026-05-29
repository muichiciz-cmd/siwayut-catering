(function () {
    var openModals = [];

    window.openCreateModal = function (id) {
        var el = document.getElementById(id);
        if (!el) return;
        el.classList.remove('hidden');
        openModals.push(id);
        var card = el.firstElementChild.firstElementChild;
        if (card) {
            void card.offsetHeight;
            card.style.transform = 'scale(1) translateY(0)';
            card.style.opacity = '1';
        }
        document.body.style.overflow = 'hidden';
    };

    window.closeCreateModal = function (id) {
        var el = document.getElementById(id);
        if (!el) return;
        var card = el.firstElementChild.firstElementChild;
        if (card) {
            card.style.transform = 'scale(0.95) translateY(10px)';
            card.style.opacity = '0';
        }
        setTimeout(function () {
            el.classList.add('hidden');
            var errors = document.getElementById(id + '-errors');
            if (errors) { errors.classList.add('hidden'); errors.innerHTML = ''; }
        }, 150);
        openModals = openModals.filter(function (i) { return i !== id; });
        if (openModals.length === 0) document.body.style.overflow = '';
    };

    document.addEventListener('click', function (e) {
        if (openModals.length === 0) return;
        var topId = openModals[openModals.length - 1];
        var el = document.getElementById(topId);
        if (el && e.target === el) closeCreateModal(topId);
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && openModals.length > 0) {
            closeCreateModal(openModals[openModals.length - 1]);
        }
    });

    // Attach AJAX submit to all create-modal forms
    document.addEventListener('submit', function (e) {
        var form = e.target;
        var modalEl = form.closest('[id$="-form"]');
        if (!modalEl) return;
        var modalId = modalEl.id.replace('-form', '');
        var container = document.getElementById(modalId);
        if (!container) return;

        e.preventDefault();
        if (form.dataset.submitting) return;
        form.dataset.submitting = '1';

        var submitBtn = form.querySelector('button[type="submit"]');
        var origText = submitBtn ? submitBtn.textContent : '';
        if (submitBtn) { submitBtn.disabled = true; submitBtn.textContent = 'Saving...'; }

        var errorsEl = document.getElementById(modalId + '-errors');

        fetch(form.action, {
            method: 'POST',
            body: new FormData(form),
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
            .then(function (r) { return r.json(); })
            .then(function (data) {
                if (data.success) {
                    closeCreateModal(modalId);
                    if (data.message && window.AppModules && window.AppModules.toast) {
                        AppModules.toast.show(data.message, 'success');
                    }
                    if (window.reloadTable) {
                        window.reloadTable();
                    } else {
                        window.location.reload();
                    }
                } else {
                    // Show validation errors
                    if (errorsEl) {
                        var html = data.message ? '<p class="mb-2 font-medium">' + data.message + '</p>' : '';
                        if (data.errors) {
                            html += '<ul class="list-disc pl-4 space-y-0.5">';
                            for (var key in data.errors) {
                                if (data.errors.hasOwnProperty(key)) {
                                    html += '<li>' + data.errors[key] + '</li>';
                                }
                            }
                            html += '</ul>';
                        }
                        errorsEl.innerHTML = html;
                        errorsEl.classList.remove('hidden');
                    }
                }
            })
            .catch(function (err) {
                if (errorsEl) {
                    errorsEl.innerHTML = '<p>Something went wrong: ' + err.message + '</p>';
                    errorsEl.classList.remove('hidden');
                }
            })
            .finally(function () {
                delete form.dataset.submitting;
                if (submitBtn) { submitBtn.disabled = false; submitBtn.textContent = origText; }
            });
    });
})();
