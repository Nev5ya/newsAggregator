'use strict';

const checkBox = document.querySelectorAll('.btn-primary');

checkBox.forEach(i => {
    i.addEventListener('change',(e) => {
        const faEl = e.target.nextElementSibling;
        if(e.target.checked) {
            faEl.classList.remove('fa-square');
            faEl.classList.add('fa-check-square');
        } else {
            faEl.classList.add('fa-square');
            faEl.classList.remove('fa-check-square');
        }
    });
})
