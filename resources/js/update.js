(function (window, document) {

    let title = document.title;

    console.log('Updating repositories...');

    document.title = 'Updating repositories...';

    let request = new XMLHttpRequest();

    request.open('GET', REQUEST_ROOT_PATH + '/admin/addons/repositories/sync', true);
    request.setRequestHeader('Content-Type', 'application/json');

    request.send();

    setTimeout(function () {

        request.abort();

        let checkLog = setInterval(function () {

            let log = new XMLHttpRequest();

            log.open('GET', REQUEST_ROOT_PATH + '/app/' + APPLICATION_REFERENCE + '/process.log', true);
            log.setRequestHeader('Content-Type', 'application/json');

            log.send();

            log.addEventListener('readystatechange', function () {

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

                                    console.log(status.responseText);

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

                                console.log('Done.');

                                document.title = title;

                                return false;
                            }
                        }, false);
                    };

                    checkStatus();
                }
            });
        }, 500);
    }, 2000);

})(window, document);
