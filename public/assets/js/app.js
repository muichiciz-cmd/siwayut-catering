// File: public/assets/js/app.js

function formatFileSize(bytes) {
    if (bytes < 1024) return bytes + ' B';
    if (bytes < 1048576) return (bytes / 1024).toFixed(1) + ' KB';
    return (bytes / 1048576).toFixed(1) + ' MB';
}

function getFileTypeLabel(mime) {
    var map = {
        'image/jpeg': 'JPEG',
        'image/png': 'PNG',
        'image/webp': 'WEBP',
        'image/gif': 'GIF',
        'image/svg+xml': 'SVG',
        'application/pdf': 'PDF',
    };
    return map[mime] || mime;
}

function initFileUploadZone(zone) {
    var input = zone.querySelector('.file-upload-input');
    var placeholder = zone.querySelector('.file-upload-placeholder');
    var preview = zone.querySelector('.file-upload-preview');
    var thumb = zone.querySelector('.file-upload-thumb');
    var fileName = zone.querySelector('.file-upload-name');
    var fileMeta = zone.querySelector('.file-upload-meta');
    var errorEl = zone.querySelector('.file-upload-error');
    var removeBtn = zone.querySelector('.file-upload-remove');

    var acceptTypes = (zone.dataset.accept || '').split(',');
    var maxSize = parseInt(zone.dataset.maxSize, 10) || 5242880;

    function resetZone() {
        zone.classList.remove('has-file', 'has-error');
        if (input) input.value = '';
        errorEl.style.display = 'none';
        errorEl.textContent = '';
    }

    function showError(msg) {
        zone.classList.add('has-error');
        zone.classList.remove('has-file');
        errorEl.textContent = msg;
        errorEl.style.display = 'block';
    }

    function validateAndShow(file) {
        zone.classList.remove('has-error');
        errorEl.style.display = 'none';

        var ext = '.' + file.name.split('.').pop().toLowerCase();
        var mimeValid = acceptTypes.length === 0 || acceptTypes.some(function (t) {
            t = t.trim();
            if (t.startsWith('.')) return ext === t.toLowerCase();
            return file.type === t;
        });

        if (!mimeValid) {
            showError('Invalid file type. Accepted: ' + acceptTypes.join(', ').replace(/image\//g, '').toUpperCase());
            return false;
        }

        if (file.size > maxSize) {
            showError('File too large (' + formatFileSize(file.size) + '). Maximum ' + formatFileSize(maxSize) + '.');
            return false;
        }

        zone.classList.add('has-file');
        zone.classList.remove('has-error');

        fileName.textContent = file.name;

        var typeLabel = getFileTypeLabel(file.type) || file.type || 'Unknown';
        fileMeta.innerHTML = '<span>' + typeLabel + '</span><span>' + formatFileSize(file.size) + '</span>';

        if (file.type.startsWith('image/')) {
            thumb.style.display = 'block';
            var reader = new FileReader();
            reader.onload = function (e) {
                thumb.src = e.target.result;
            };
            reader.readAsDataURL(file);
        } else {
            thumb.style.display = 'none';
            thumb.src = '';
        }

        return true;
    }

    function handleFiles(files) {
        if (!files || files.length === 0) return;
        var file = files[0];

        if (validateAndShow(file)) {
            if (input) {
                var dt = new DataTransfer();
                dt.items.add(file);
                input.files = dt.files;
            }
        }
    }

    // Drag events
    zone.addEventListener('dragover', function (e) {
        e.preventDefault();
        e.dataTransfer.dropEffect = 'copy';
        zone.classList.add('drag-over');
    });

    zone.addEventListener('dragleave', function (e) {
        e.preventDefault();
        zone.classList.remove('drag-over');
    });

    zone.addEventListener('drop', function (e) {
        e.preventDefault();
        zone.classList.remove('drag-over');
        if (e.dataTransfer.files && e.dataTransfer.files.length > 0) {
            handleFiles(e.dataTransfer.files);
        }
    });

    // Click to browse
    zone.addEventListener('click', function () {
        if (input) input.click();
    });

    if (input) {
        input.addEventListener('change', function () {
            if (input.files && input.files.length > 0) {
                handleFiles(input.files);
            }
        });
    }

    // Remove button
    if (removeBtn) {
        removeBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            resetZone();
        });
    }
}

document.addEventListener('DOMContentLoaded', function () {
    // Auto-dismiss alerts after 5 seconds
    document.querySelectorAll('.alert').forEach(function (alert) {
        setTimeout(function () {
            alert.style.transition = 'opacity 300ms ease';
            alert.style.opacity = '0';
            setTimeout(function () { alert.remove(); }, 300);
        }, 5000);
    });

    // Confirm delete actions
    document.querySelectorAll('[data-confirm]').forEach(function (el) {
        el.addEventListener('click', function (e) {
            if (!confirm(el.dataset.confirm || 'Are you sure?')) {
                e.preventDefault();
            }
        });
    });

    // Init all file upload zones
    document.querySelectorAll('.file-upload-zone').forEach(initFileUploadZone);
});

// Progressive image loading (blur-up)
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.progressive-img[data-full]').forEach(function (img) {
        var full = new Image();
        full.onload = function () {
            img.src = full.src;
            img.classList.remove('blur-up');
            img.classList.add('loaded');
        };
        full.onerror = function () {
            img.classList.remove('blur-up');
            img.classList.add('loaded');
        };
        full.src = img.getAttribute('data-full');
    });
});

function generateDescription(btn) {
    var form = btn.closest('form');
    if (!form) return;

    var textarea = form.querySelector('#description');
    var name = form.querySelector('#name');
    var category = form.querySelector('#category_id');
    var event = form.querySelector('#event_id');
    var price = form.querySelector('#price');
    var minPortions = form.querySelector('#minimum_portions');
    var csrf = form.querySelector('input[name="_csrf_token"]');

    if (!textarea || !name) return;

    var data = new URLSearchParams();
    data.append('_csrf_token', csrf ? csrf.value : '');
    data.append('name', name.value || '');
    data.append('category', category ? category.options[category.selectedIndex]?.text || '' : '');
    data.append('event', event ? event.options[event.selectedIndex]?.text || '' : '');
    data.append('price', price ? price.value || '' : '');
    data.append('minimum_portions', minPortions ? minPortions.value || '' : '');

    btn.disabled = true;
    btn.textContent = 'Generating...';

    fetch('/menus/generate-description', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: data
    })
    .then(function (res) { return res.json(); })
    .then(function (result) {
        if (result.description) {
            textarea.value = result.description;
        } else {
            alert(result.message || result.error || 'Failed to generate description.');
        }
    })
    .catch(function (err) {
        alert('Error: ' + err.message);
    })
    .finally(function () {
        btn.disabled = false;
        btn.textContent = 'Generate with AI';
    });
}
