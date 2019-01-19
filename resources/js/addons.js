(function (window, document) {

    const toggles = Array.prototype.slice.call(
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

            request.send();

            /**
             * Check the status periodically.
             * Log to console and when finished
             * cleanup and show resulting message.
             *
             * @type {number}
             */
            let checkStatus = setInterval(function () {

                let status = new XMLHttpRequest();

                status.open('GET', REQUEST_ROOT_PATH + '/app/' + APPLICATION_REFERENCE + '/addons/composer.lock', true);
                status.setRequestHeader('Content-Type', 'application/json');

                status.send();

                status.addEventListener('readystatechange', function (event) {

                    /**
                     * The file has been removed which
                     * means composer has finished up.
                     */
                    if (status.readyState == 4 && status.status == 404) {

                        // Stop recurring.
                        clearInterval(checkStatus);

                        swal({
                            text: 'Done!',
                            icon: 'success',
                            closeOnEsc: false,
                            closeOnClickOutside: false,
                        });

                        setTimeout(function () {
                            window.location.reload();
                        }, 1000);
                    }

                    if (status.readyState == 4 && status.status == 200) {
                        console.log(status.responseText);
                    }
                }, false);

            }, 5000);
        });
    });

})(window, document);
