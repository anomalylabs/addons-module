(function (window, document) {

    const toggles = Array.prototype.slice.call(
        document.querySelectorAll('[data-toggle="process"]')
    );

    toggles.forEach(function (toggle) {

        toggle.addEventListener('click', function (event) {

            event.preventDefault();

            NProgress.start();

            swal({
                icon: 'info',
                buttons: false,
                closeOnEsc: false,
                closeOnClickOutside: false,
                text: toggle.dataset.message,
            });

            window.location = event.target.href;

            return false;
        });
    });

})(window, document);
