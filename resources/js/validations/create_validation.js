const form = document.getElementById('creation-form');
const firstName = document.getElementById('first_name');
const fnError = document.getElementById('fn-error');
const lastName = document.getElementById('last_name');
const lnError = document.getElementById('ln-error');
const addressChoice = document.getElementById('address');
const addressError = document.getElementById('address-error');
const specializations = document.querySelectorAll('.form-check-input');
const specBtn = document.getElementById('spec-button');
const specError = document.getElementById('spec-error');

function checkTheBox() {
    var flag = 0;
    for (var i = 0; i < specializations.length; i++) {
        console.log(specializations[i]);
        if (form["specs[]"][i].checked) {
            flag++;
        }
    }
    if (!flag) {

        return false;
    }
    return true;
}
// todo specialization validation!!

form.addEventListener('submit', (e) => {
    let fnValid = true;
    let lnValid = true;
    let addressValid = true;
    let specValid = true;

    if (!isNaN(firstName.value) || firstName.value.length < 3 || firstName.value.length > 30) {
        fnValid = false;
    } if (!isNaN(lastName.value) || lastName.value.length < 3 || lastName.value.length > 30) {
        lnValid = false;
    } if (!addressChoice.value) {
        addressValid = false;
    }if (!checkTheBox()) {
        specValid = false;
    }

    fnValid ? (fnError.className = 'd-none', firstName.classList.remove('border-danger')) : (fnError.className = 'text-danger', firstName.classList.add('border-danger'));
    lnValid ? (lnError.className = 'd-none', lastName.classList.remove('border-danger')) : (lnError.className = 'text-danger', lastName.classList.add('border-danger'));
    addressValid ? (addressError.className = 'd-none', addressChoice.classList.remove('border-danger')) : (addressError.className = 'text-danger', addressChoice.classList.add('border-danger'));
    specValid ? (specError.className = 'd-none', specBtn.classList.remove('border-danger')) : (specError.className = 'text-danger', specBtn.classList.add('border-danger'));

    if (!(fnValid && lnValid && addressValid && specValid)) e.preventDefault();
})