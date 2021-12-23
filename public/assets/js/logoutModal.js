'use strict';

const logoutButton = document.getElementById('logoutModal');
const csrfToken = document.getElementById('token').content;
const logoutUrl = 'http://laravel.loc/logout';


logoutButton.addEventListener('click' , async () => {
    return await fetch(logoutUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-CSRF-TOKEN': csrfToken
        }
    });
});
