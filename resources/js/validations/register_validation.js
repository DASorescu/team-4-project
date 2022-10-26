const form = document.getElementById('form');
const username = document.getElementById('name');
const email = document.getElementById('email');
const password = document.getElementById('password');
const passwordConfirm = document.getElementById('password-confirm');

form.addEventListener('submit',(e) => {
    let isValid = false;

    if(!isNaN(username.value) || username.value.length < 3 || username.value.length > 30) {
        alert('Inserire un username valido.');
    } else if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.value))) {
       alert('La mail inserita non è valida.');
    } else if(password.value.length < 8) {
        alert('La password deve essere di almeno 8 caratteri.');
    } else if(passwordConfirm.value !== password.value) {
        alert('Le password non corrispondono.');
    } else isValid = true;

    if(!isValid) e.preventDefault();
})