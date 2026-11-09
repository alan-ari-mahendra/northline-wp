document.addEventListener('DOMContentLoaded', function () {
    var form = document.getElementById('nl-discovery-form');
    var success = document.getElementById('nl-form-success');
    if (!form || !success) return;

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        form.style.display = 'none';
        success.style.display = 'flex';
    });

    var reset = document.getElementById('nl-form-reset');
    if (reset) {
        reset.addEventListener('click', function () {
            success.style.display = 'none';
            form.style.display = 'flex';
        });
    }
});
