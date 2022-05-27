BX.ready(function() {
    let input = document.querySelector('input[name="user_id"]');

    if (input) {
        BX.adjust(input, {
            events: {
                change(e) {
                    let value = e.currentTarget.value;

                    if (value.indexOf(',') === -1 && value.length > 0) {
                        let url = new URL(location.href);
                        value = value.replace('U', '');

                        if (url.searchParams.has('user_id')) {
                            if (value !== url.searchParams.get('user_id')) {
                                url.searchParams.set('user_id', value);
                                location.href = url.href;
                            }
                        } else {
                            location.href += '?user_id=' + value;
                        }
                    }
                }
            }
        })
    } else {
        console.log('Не удалось найти поле пользователя не странице');
    }
})