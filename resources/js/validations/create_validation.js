const form = document.getElementById('creation-form');
const user_name = document.getElementById('first_name');
const user_surname = document.getElementById('last_name');
const address_choice = document.getElementById('address');
let address = address_choice.options[address_choice.selectedIndex].value;
// todo specialization validation!!
// const specialization = document.getElementById('password-confirm');

form.addEventListener('submit', (e) => {
    let isValid = false;

    if (!isNaN(user_name.value) || user_name.value.length < 3 || user_name.value.length > 30) {
        alert('Inserire un nome valido.');
    } else if (!isNaN(user_surname.value) || user_surname.value.length < 3 || user_surname.value.length > 30) {
        alert('Inserire un cognome valido.');
    } else if (address == 0) {
        alert('Devi scegliere una citta');
    } else isValid = true;

    if (!isValid) e.preventDefault();
})