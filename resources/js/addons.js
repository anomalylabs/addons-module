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

            let messages = document.querySelector('.swal-text');

            let request = new XMLHttpRequest();

            request.open('GET', event.target.href, true);
            request.setRequestHeader('Content-Type', 'application/json');

            request.send();

            setTimeout(function () {

                request.abort();

                let checkLog = setInterval(function () {

                    let log = new XMLHttpRequest();

                    log.open('GET', REQUEST_ROOT_PATH + '/app/' + APPLICATION_REFERENCE + '/process.log', true);
                    log.setRequestHeader('Content-Type', 'application/json');

                    log.send();

                    log.addEventListener('readystatechange', function (event) {

                        /**
                         * Start checking the status.
                         */
                        if (log.readyState == 4 && log.status == 200) {

                            // Stop checking.
                            clearInterval(checkLog);

                            /**
                             * Check the status periodically.
                             * Log to console and when finished
                             * cleanup and show resulting message.
                             *
                             * @type {number}
                             */
                            let checkStatus = function () {

                                let status = new XMLHttpRequest();

                                status.open('GET', REQUEST_ROOT_PATH + '/app/' + APPLICATION_REFERENCE + '/process.log', true);
                                status.setRequestHeader('Content-Type', 'application/json');

                                status.send();

                                status.addEventListener('readystatechange', function () {

                                    /**
                                     * Check the status and update messages.
                                     */
                                    if (status.readyState == 4 && status.status == 200) {

                                        if (status.responseText.length != 0) {

                                            messages.innerText = status.responseText;

                                            document.title = status.responseText;
                                        }

                                        setTimeout(function () {
                                            checkStatus();
                                        }, 500);
                                    }

                                    /**
                                     * The file has been removed which
                                     * means composer has finished up.
                                     */
                                    if (status.readyState == 4 && status.status == 404) {

                                        document.title = 'Done!';

                                        swal({
                                            text: 'Done!',
                                            icon: 'success',
                                            closeOnEsc: false,
                                            closeOnClickOutside: false,
                                            buttons: false,
                                        });

                                        setTimeout(function () {
                                            window.location.reload();
                                        }, 1000);
                                    }
                                }, false);
                            };

                            checkStatus();
                        }
                    });
                }, 500);
            }, 2000);
        });
    });



    const prompts = Array.prototype.slice.call(
        document.querySelectorAll('[data-toggle="prompts"]')
    );

    prompts.forEach(function (prompt) {

        prompt.addEventListener('click', function (event) {

            event.preventDefault();

            NProgress.start();

            swal({
                icon: 'info',
                buttons: false,
                closeOnEsc: false,
                closeOnClickOutside: false,
                text: prompt.dataset.message,
            });

            window.location = prompt.href;

            return false;
        });
    });

})(window, document);
