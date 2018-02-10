(function (window, document) {

    const toggles = Array.from(
        document.querySelectorAll('[data-toggle="composer"]')
    );

    toggles.forEach(function (toggle) {

        toggle.addEventListener('click', function (event) {

            event.preventDefault();

            NProgress.start();

            swal({
                buttons: false,
                closeOnEsc: false,
                closeOnClickOutside: false,
                text: toggle.dataset.message,
            });

            let request = new XMLHttpRequest();

            request.open('GET', event.target.href, true);
            request.setRequestHeader('Content-Type', 'application/json');

            request.send(JSON.stringify({
                _token: CSRF_TOKEN,
            }));

            request.addEventListener('readystatechange', function (event) {

                NProgress.inc();

                if (request.readyState == 4) {
                    NProgress.done();
                }

                if (request.readyState == 4 && request.status == 200) {

                    swal({
                        text: 'Done!',
                        icon: 'success',
                        closeOnEsc: false,
                        closeOnClickOutside: false,
                        buttons: {
                            confirm: {
                                text: 'Reload',
                                closeModal: false,
                            }
                        },
                    }).then((value) => {
                        window.location.reload();
                    });
                }

                if (request.readyState == 4 && request.status == 500) {

                    swal({
                        icon: 'error',
                        closeOnEsc: false,
                        closeOnClickOutside: false,
                        text: 'There was an error.',
                        buttons: {
                            confirm: {
                                closeModal: false,
                            }
                        },
                    }).then((value) => {
                        window.location.reload();
                    });
                }
            }, false);
        });
    });

})(window, document);
