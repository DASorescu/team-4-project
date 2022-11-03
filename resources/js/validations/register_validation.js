const form = document.getElementById('form');
const username = document.getElementById('name');
const userError = document.getElementById('user-error');
const email = document.getElementById('email');
const emailError = document.getElementById('email-error');
const password = document.getElementById('password');
const pwError = document.getElementById('pw-error');
const passwordConfirm = document.getElementById('password-confirm');
const pwCheckError = document.getElementById('pwcheck-error');

form.addEventListener('submit',(e) => {
    let userValid = true;
    let emailValid = true;
    let pwValid = true;
    let pwCheckValid = true;

    if(!isNaN(username.value) || username.value.length < 3 || username.value.length > 30) {
        userValid = false;
    } if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.value))) {
       emailValid = false;
    } if(password.value.length < 8) {
        pwValid = false;
    } if(passwordConfirm.value !== password.value) {
        pwCheckValid = false;
    }

    userValid ? (userError.className = 'd-none', username.classList.remove('border-danger')) : (userError.className = 'text-danger', username.classList.add('border-danger'));
    emailValid ? (emailError.className = 'd-none', email.classList.remove('border-danger')) : (emailError.className = 'text-danger', email.classList.add('border-danger'));
    pwValid ? (pwError.className = 'd-none', password.classList.remove('border-danger')) : (pwError.className = 'text-danger', password.classList.add('border-danger'));
    pwCheckValid ? (pwCheckError.className = 'd-none', passwordConfirm.classList.remove('border-danger')) : (pwCheckError.className = 'text-danger', passwordConfirm.classList.add('border-danger'));

    if(!(userValid && emailValid && pwValid && pwCheckValid)) e.preventDefault();
})
