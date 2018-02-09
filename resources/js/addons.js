(function (window, document) {

    // let request = new XMLHttpRequest();
    //
    // request.open('GET', REQUEST_ROOT_PATH + '/check', true);
    // request.setRequestHeader('Content-Type', 'application/json');
    //
    // let response = request.send(JSON.stringify({
    //     _token: CSRF_TOKEN,
    // }));

    const downloads = Array.from(
        document.querySelectorAll('[data-toggle="download"]')
    );

    downloads.forEach(function (toggle) {

        toggle.addEventListener('click', function (event) {

            event.preventDefault();

            swal({
                text: toggle.dataset.title,
                buttons: false,
            });

            let request = new XMLHttpRequest();

            request.open('GET', event.target.href, true);
            request.setRequestHeader('Content-Type', 'application/json');

            request.send(JSON.stringify({
                _token: CSRF_TOKEN,
            }));

            let interval = setInterval(function () {

                let request = new XMLHttpRequest();

                request.open('GET', REQUEST_ROOT_PATH + '/check', true);
                request.setRequestHeader('Content-Type', 'application/json');

                request.send(JSON.stringify({
                    _token: CSRF_TOKEN,
                }));

                request.addEventListener('readystatechange', function (event) {

                    console.log(request.responseText);

                    if (request.readyState == 4) {

                        if (request.responseText == 'EXIT;') {

                            clearInterval(interval);

                            swal({
                                icon: 'error',
                                text: request.responseText,
                                buttons: {
                                    confirm: true
                                },
                            });

                            return false;
                        }

                        if (request.responseText.length > 1) {
                            swal({
                                text: request.responseText,
                                buttons: false,
                            });
                        }
                    }
                }, false);
            }, 1000);
        });
    });




    const removals = Array.from(
        document.querySelectorAll('[data-toggle="remove"]')
    );

    removals.forEach(function (toggle) {

        toggle.addEventListener('click', function (event) {

            event.preventDefault();

            swal({
                text: toggle.dataset.title,
                buttons: false,
            });

            let request = new XMLHttpRequest();

            request.open('GET', event.target.href, true);
            request.setRequestHeader('Content-Type', 'application/json');

            request.send(JSON.stringify({
                _token: CSRF_TOKEN,
            }));

            let interval = setInterval(function () {

                let request = new XMLHttpRequest();

                request.open('GET', REQUEST_ROOT_PATH + '/check', true);
                request.setRequestHeader('Content-Type', 'application/json');

                request.send(JSON.stringify({
                    _token: CSRF_TOKEN,
                }));

                request.addEventListener('readystatechange', function (event) {

                    if (request.status != 200) {
                        clearInterval(interval);
                    }

                    console.log(request.responseText);

                    if (request.readyState == 4) {

                        if (request.responseText == 'EXIT;') {

                            clearInterval(interval);

                            swal({
                                icon: 'error',
                                text: request.responseText,
                                buttons: {
                                    confirm: true
                                },
                            });

                            return false;
                        }

                        if (request.responseText.length > 1) {
                            swal({
                                text: request.responseText,
                                buttons: false,
                            });
                        }
                    }
                }, false);
            }, 1000);
        });
    });

})(window, document);
